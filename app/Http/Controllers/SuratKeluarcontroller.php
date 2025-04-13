<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SuratKeluarcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = Surat::where('pengirim_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();
        return view('daftarsuratkeluar', compact('surat'));
    }

    public function indexverifikasi()
    {
        $surat = Surat::where('verifikasi', 'belum')
            ->orderBy('created_at', 'desc')
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
            return back()->with('success', 'Surat berhasil ditolak');
        } catch (\Exception $e) {
            return back()->with('error',  'Surat gagal ditolak: ' . $e->getMessage())->withInput();
        }
    }

    public function indexditolak()
    {

        $surat = Surat::where('verifikasi', '=', 'ditolak')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('tolaksuratkeluar', compact('surat'));
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
        $filename = 'surat'.time().'.docx';
        $phpword = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        try {
            $request->validate([
                'judul_surat' => 'required',
                'tanggal' => 'required',
                'nomor_surat' => 'required',
                'lampiran_surat' => 'required',
                'perihal_surat' => 'required',
                'isi' => 'required',
                'hari' => 'required',
                'waktu' => 'required',
                'tempat' => 'required',
                'tujuan_surat' => 'required',
            ]);

            $phpword->setValues([
                'judul_surat' => $request->judul_surat,
                'tanggal' => $request->tanggal,
                'nomor_surat' => $request->nomor_surat,
                'lampiran_surat' => $request->lampiran_surat,
                'perihal_surat' => $request->perihal_surat,
                'isi' => $request->isi,
                'hari' => $request->hari,
                'waktu' => $request->waktu,
                'tempat' => $request->tempat,
            ]);
            $filepath = 'storage/surat/' . $filename;
            $phpword->saveAs($filepath);
            
            Surat::create([
                'judul_surat' => $request->judul_surat,
                'nomor_surat' => $request->nomor_surat,
                'isi' => $filename,
                'tujuan_id' => $request->tujuan_surat,
                'pengirim_id' => Auth::id(),
                'status' => 'baru',
                'verifikasi' => 'belum',
                'keterangan' => $request->keterangan,
            ]);
            return back()->with('success', 'Surat berhasil dibuat');
        } catch (\Exception $e) {
            File::delete(public_path($filename));
            return back()->with('error',  'Surat gagal dibuat: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
