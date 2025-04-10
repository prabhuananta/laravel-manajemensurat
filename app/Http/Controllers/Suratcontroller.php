<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Suratcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'belum_dikirim' => Surat::where('pengirim_id', Auth::id())->where('verifikasi', 'belum')->count(),
            'ditolak' => Surat::where('pengirim_id', Auth::id())->where('verifikasi', 'ditolak')->count(),
            'belum_dibaca' => Surat::where('tujuan_id', Auth::id())->where('status', 'baru')->count(),
            'tindaklanjut' => Surat::where('tujuan_id', Auth::id())->where('status', 'proses')->count(),
        ];

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
        echo "ini create" . $request->judul_surat;
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
