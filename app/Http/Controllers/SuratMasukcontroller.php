<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuratMasukcontroller extends Controller
{
    public function index()
    {
        $surat = Surat::where('tujuan_id', Auth::id())
            ->where('verifikasi', 'tertanda')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('daftarsuratmasuk', compact('surat'));
    }

    public function indexdisposisi()
    {
        $surat = Surat::where('tujuan_id', Auth::id())
            ->whereNot('status', 'selesai')
            ->where('verifikasi', 'tertanda')
            ->orderBy('created_at', 'desc')
            ->get();;

        return view('disposisisuratmasuk', compact('surat'));
    }

    public function show(string $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->update([
            'status' => 'dibaca',
        ]);
        return view('detailsurat', compact('surat'));
    }

    public function proses(string $id)
    {
        try {
            $surat = Surat::findOrFail($id);
            $surat->update([
                'status' => 'diproses',
            ]);
            return redirect('/suratmasuk/daftar')->with('success', 'Berhasil disposisi surat');
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
}
