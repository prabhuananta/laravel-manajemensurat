<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SuratKeluarcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('formsurat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'judul_surat' => 'required',
            'isi_surat' => 'required',
            'tujuan_surat' => 'required',
            'tanggal_surat' => 'required',
        ]);
        Model::create([
            'judul_surat' => $request->judul_surat,
            'isi_surat' => $request->isi_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'tanggal_surat' => $request->tanggal_surat,
        ]);
        return redirect('/dashboard')->with('success', 'Surat berhasil dibuat');
        //todo
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
