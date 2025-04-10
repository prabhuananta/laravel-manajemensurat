<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all()->except(Auth::id());
        return view('daftarpengguna', compact('user'));
    }

    public function indexprofil()
    {
        $user = User::findOrFail(Auth::id());
        return view('profilpengguna', compact('user'));
    }

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
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = User::findOrFail($id);

        return view('editpengguna', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profilpengguna', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
            ]);
            if ($request->password) {
                $request->validate([
                    'password' => 'required|min:8|confirmed',
                ]);
                $data = $request->only(['name', 'email', 'role']);
                $data['password'] = bcrypt($request->password);
            } else {
                $data = $request->only(['name', 'email', 'role']);
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
    public function update(Request $request)
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
}
