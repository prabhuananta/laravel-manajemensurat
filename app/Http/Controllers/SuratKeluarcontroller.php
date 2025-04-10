<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeluarcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = Surat::where('pengirim_id', Auth::id())->get();
        return view('daftarsuratkeluar', compact('surat'));
    }

    public function indexverifikasi()
    {
        $surat = Surat::where('pengirim_id', Auth::id())
            ->where('verifikasi', 'belum')
            ->get();
        return view('verifikasisuratkeluar', compact('surat'));
    }

    public function verifikasi(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            Surat::where('id', $request->id)->update([
                'verifikasi' => 'sudah',
            ]);
            return back()->with('success', 'Surat berhasil diverifikasi');
        } catch (\Exception $e) {
            return back()->with('error',  'Surat gagal diverifikasi: ' . $e->getMessage())->withInput();
        }
    }
    public function tolak(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            Surat::where('id', $request->id)->update([
                'verifikasi' => 'ditolak',
            ]);
            return back()->with('success', 'Surat berhasil diverifikasi');
        } catch (\Exception $e) {
            return back()->with('error',  'Surat gagal diverifikasi: ' . $e->getMessage())->withInput();
        }
    }

    public function indextandatangan()
    {

        $surat = Surat::where('pengirim_id', '=', Auth::id())
            ->where('verifikasi', '=', 'sudah')
            ->get();
        return view('tandatangansuratkeluar', compact('surat'));
    }

    public function tandatangan(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'tandatangan' => 'required|mimes:pdf,docx,doc|max:2048',
            ]);

            // Store the file and get its path
            $file = $request->file('tandatangan');
            $filePath = $file->storeAs('surat', time() . '_letter.' . $file->getClientOriginalExtension(), 'public');

            Surat::where('id', $request->surat_id)->update([
                'verifikasi' => 'sudah',
                'isi' => $filePath,
            ]);
            return back()->with('success', 'Surat berhasil ditandatangani');
        } catch (\Exception $e) {
            return back()->with('error',  'Surat gagal ditandatangani: ' . $e->getMessage())->withInput();
        }
    }

    public function nomorbaru()
    {
        $nomor = Surat::max('nomor_surat');
        $noUrut = 0;

        if ($nomor && preg_match('/^SK\/\d{3}$/', $nomor)) {
            $noUrut = (int) substr($nomor, 3, 3);
        }

        $noUrut++;
        $char = "SK/";
        return $char . sprintf("%03s", $noUrut);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $penerima = User::where('id', '!=', Auth::id())->get();
        return view('formsurat', compact('penerima'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul_surat' => 'required',
                'isi' => 'required|mimes:pdf,docx,doc|max:2048',
                'tujuan_surat' => 'required',
            ]);

            // Store the file and get its path
            $file = $request->file('isi');
            $filePath = $file->storeAs('surat', time() . '_letter.' . $file->getClientOriginalExtension(), 'public');

            Surat::create([
                'judul_surat' => $request->judul_surat,
                'nomor_surat' => $this->nomorbaru(),
                'isi' => $filePath,
                'tujuan_id' => $request->tujuan_surat,
                'pengirim_id' => Auth::id(),
                'status' => 'baru',
                'verifikasi' => 'belum',
                'keterangan' => $request->keterangan,
            ]);
            return back()->with('success', 'Surat berhasil dibuat');
        } catch (\Exception $e) {
            $file->delete();
            return back()->with('error',  'Surat gagal dibuat: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surat = Surat::findOrFail($id);
        return view('detailsuratkeluar', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
