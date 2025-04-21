<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Suratcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = [
                'belum_dikirim' => Surat::where('verifikasi', 'belum')->count(),
                'ditolak' => Surat::where('pengirim_id', Auth::id())->where('verifikasi', 'ditolak')->count(),
                'belum_dibaca' => Surat::where('tujuan_id', Auth::id())->where('status', 'baru')->where('verifikasi', 'sudah')->count(),
                'tindaklanjut' => Surat::where('tujuan_id', Auth::id())->where('status', 'diproses')->count(),
            ];
        } else {  
            $data = [
                'belum_dikirim' => Surat::where('pengirim_id', Auth::id())->where('verifikasi', 'belum')->count(),
                'ditolak' => Surat::where('pengirim_id', Auth::id())->where('verifikasi', 'ditolak')->count(),
                'belum_dibaca' => Surat::where('tujuan_id', Auth::id())->where('status', 'baru')->where('verifikasi', 'sudah')->count(),
                'tindaklanjut' => Surat::where('tujuan_id', Auth::id())->where('status', 'diproses')->count(),
            ];
        }

        $surat = Surat::where('tujuan_id', Auth::id())
            ->where('status', 'diproses')
            ->get();
        return view('beranda', compact('surat', 'data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    public function download(String $id) {
        $suratModel = Surat::findOrFail($id);
        $surat = $suratModel->isi;
        $suratModel->update(['status' => "dibaca"]);

        $file = public_path('storage/surat/'.$suratModel->isi);
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        return response()->download($file, $surat, $headers);
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
        //
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
