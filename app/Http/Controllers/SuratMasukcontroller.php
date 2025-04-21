<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuratMasukcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = Surat::where('tujuan_id', Auth::id())
            ->where('verifikasi', 'sudah')
            ->where('status', 'baru')
            ->orWhere('status', 'dibaca')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('daftarsuratmasuk', compact('surat'));
    }

    public function indexdisposisi()
    {
        $surat = Surat::where('tujuan_id', Auth::id())
            ->where('status', 'diproses')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('disposisisuratmasuk', compact('surat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surat = Surat::findOrFail($id);
        return view('detailsurat', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function proses(string $id)
    {
        try {
            $surat = Surat::findOrFail($id);
            $surat->update([
                'status' => 'diproses',
            ]);
            return redirect('/suratmasuk/disposisi')->with('success', 'Surat masuk ke disposisi');
        } catch (\Exception $e) {
            return back()->with('error', 'Disposisi gagal: ' . $e->getMessage());
        }
    }
    public function selesai(string $id)
    {
        try {
            $surat = Surat::findOrFail($id);
            $surat->update([
                'status' => 'selesai',
            ]);
            return redirect('/suratmasuk/disposisi')->with('success', 'Disposisi selesai');
        } catch (\Exception $e) {
            return back()->with('error', 'Disposisi gagal: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
