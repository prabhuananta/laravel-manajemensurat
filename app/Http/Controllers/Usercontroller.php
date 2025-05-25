<?php

namespace App\Http\Controllers;

use App\Models\GrupTujuan;
use App\Models\Penandatangan;
use App\Models\User;
use App\Models\verifikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class Usercontroller extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Username atau Password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all()->except(Auth::id());
        return view('daftarpengguna', compact('user'));
    }
    public function indexlogin()
    {
        return view('login');
    }
    public function indexprofil()
    {
        return view('profilpengguna');
    }

    public function indexgruptujuan()
    {
        $datas = GrupTujuan::with('users')->get();
        $user = User::all();
        // dd($datas);
        return view('gruptujuan', compact('datas', 'user'));
    }
    public function indexpenandatangan()
    {
        $user = User::all();
        $datas = Penandatangan::with('user')->get();
        return view('penandatangan', compact('user', 'datas'));
    }
    public function indexverifikator()
    {
        $user = User::all();
        $datas = verifikator::with('user')->get();

        return view('verifikator', compact('user', 'datas'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('editpengguna', compact('user'));
    }

    public function showGrupTujuan($id)
    {
        $datas = GrupTujuan::with('users')->findOrFail($id);
        $user = User::all();
        return view('editgruptujuan', compact('datas', 'user'));
    }
    public function showPenandatangan($id)
    {
        $datas = Penandatangan::with('user')->findOrFail($id);
        $user = User::all();
        return view('editpenandatangan', compact('datas', 'user'));
    }
    public function showVerifikator($id)
    {
        $datas = verifikator::with('user')->findOrFail($id);
        $user = User::all();
        return view('editverifikator', compact('user', 'datas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'jabatan' => 'required',
                'golongan' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);
            $data = $request->only(['name', 'email']);
            $data['password'] = bcrypt($request->password);
            User::create($data);
            return back()->with('success', 'Pengguna baru berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Pengguna baru gagal ditambahkan : ' . $e->getMessage());
        }
    }

    public function creategruptujuan(Request $request)
    {
        try {
            $request->validate([
                'nama_grup' => 'required',
                'keterangan' => 'nullable',
                'user_id' => 'required|array',
                'user_id.*' => 'exists:users,id',
            ]);

            // Create the group
            $grup = GrupTujuan::create([
                'nama_grup' => $request->nama_grup,
                'keterangan' => $request->keterangan
            ]);

            // Attach users to the group (many-to-many relationship)
            $grup->users()->attach($request->user_id);
            return back()->with('success', 'Grup tujuan berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Grup tujuan gagal ditambahkan : ' . $e->getMessage());
        }
    }
    public function createpenandatangan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required',
            'file_tanda_tangan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('file_tanda_tangan');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        try {
            $file->move(public_path('storage/tanda_tangan/'), $filename);

            Penandatangan::create([
                'user_id' => $request->user_id,
                'nip' => $request->nip,
                'file_tanda_tangan' => $filename,
            ]);
            return back()->with('success', 'Penandatangan berhasil ditambahkan');
        } catch (\Exception $e) {
            unlink(public_path("storage/tanda_tangan/{$filename}"));
            return back()->with('error', 'Penandatangan gagal ditambahkan : ' . $e->getMessage());
        }
    }
    public function createverifikator(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);
            verifikator::create([
                'user_id' => $request->user_id,
            ]);
            return back()->with('success', 'Verifikator berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Verifikator gagal ditambahkan : ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(string $id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
                'jabatan' => 'required',
                'golongan' => 'required',
            ]);
            if ($request->password) {
                $request->validate([
                    'password' => 'required|min:8|confirmed',
                ]);
                $data = $request->only(['name', 'email', 'role', 'jabatan']);
                $data['password'] = bcrypt($request->password);
            } else {
                $data = $request->only(['name', 'email', 'role', 'jabatan']);
            }
            $user = User::findOrFail($id);
            $ko = $user->update($data);
            return back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error',  $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfil(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);
            if ($request->password) {
                $request->validate([
                    'password' => 'required|min:8|confirmed',
                ]);
                $data = $request->only(['name', 'email']);
                $data['password'] = bcrypt($request->password);
            } else {
                $data = $request->only(['name', 'email']);
            }
            $user = User::findOrFail(Auth::id());
            $user->update($data);
            return back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Profil gagal diperbarui : ' . $e->getMessage());
        }
    }
    public function updateGruptujuan(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_grup' => 'required',
                'keterangan' => 'nullable',
                'user_id' => 'required|array',
                'user_id.*' => 'exists:users,id',
            ]);

            // Find the group
            $grup = GrupTujuan::findOrFail($id);
            $grup->update([
                'nama_grup' => $request->nama_grup,
                'keterangan' => $request->keterangan
            ]);

            // Sync users to the group (many-to-many relationship)
            $grup->users()->sync($request->user_id);
            return back()->with('success', 'Grup tujuan berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Grup tujuan gagal diperbarui : ' . $e->getMessage());
        }
    }
    public function updatePenandatangan(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required',
            'file_tanda_tangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $tandaTangan = Penandatangan::findOrFail($id);
        $data = [
            'user_id' => $request->user_id,
            'nip' => $request->nip,
        ];

        if ($request->hasFile('file_tanda_tangan')) {
            // Handle new file upload
            $file = $request->file('file_tanda_tangan');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/tanda_tangan/'), $filename);

            // Delete old file if it exists
            if (
                !empty($tandaTangan->file_tanda_tangan) &&
                file_exists(public_path("storage/tanda_tangan/{$tandaTangan->file_tanda_tangan}"))
            ) {
                unlink(public_path("storage/tanda_tangan/{$tandaTangan->file_tanda_tangan}"));
            }

            // Add file to data array to update in database
            $data['file_tanda_tangan'] = $filename;
        }
        try {
            $tandaTangan->update($data);
            return back()->with('success', 'Penandatangan berhasil diperbarui');
        } catch (\Exception $e) {
            unlink(public_path("storage/tanda_tangan/{$tandaTangan->file_tanda_tangan}"));
            return back()->with('error', 'Penandatangan gagal diperbarui : ' . $e->getMessage());
        }
    }
    public function updateVerifikator(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);
            $verifikator = verifikator::findOrFail($id);
            $verifikator->update([
                'user_id' => $request->user_id,
            ]);
            return back()->with('success', 'Verifikator berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Verifikator gagal diperbarui : ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return back()->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Pengguna gagal dihapus : ' . $e->getMessage());
        }
    }
    public function destroygruptujuan(string $id)
    {
        try {
            $grup = GrupTujuan::findOrFail($id);
            $grup->users()->detach(); // Detach all users from the group
            $grup->delete();
            return back()->with('success', 'Grup tujuan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Grup tujuan gagal dihapus : ' . $e->getMessage());
        }
    }

    public function destroypenandatangan(string $id)
    {
        try {
            $tandaTangan = Penandatangan::findOrFail($id);
            // Delete the file if it exists
            if (
                !empty($tandaTangan->file_tanda_tangan) &&
                file_exists(public_path('storage/tanda_tangan/' . $tandaTangan->file_tanda_tangan))
            ) {
                unlink(public_path('storage/tanda_tangan/' . $tandaTangan->file_tanda_tangan));
            }
            $tandaTangan->delete();
            return back()->with('success', 'Penandatangan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Penandatangan gagal dihapus : ' . $e->getMessage());
        }
    }

    public function destroyverifikator(string $id)
    {
        try {
            $verifikator = verifikator::findOrFail($id);
            $verifikator->delete();
            return back()->with('success', 'Verifikator berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Verifikator gagal dihapus : ' . $e->getMessage());
        }
    }
}
