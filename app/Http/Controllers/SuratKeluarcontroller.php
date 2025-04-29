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
        $filename = 'surat' . time() . '.docx';
        $phpword = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        try {
            $request->validate([
                'tanggalsurat' => 'required',
                'nomorsurat' => 'required',
                'sifatsurat' => 'required',
                'perihal' => 'required',
                'isisurat' => 'required',
                'haritanggal' => 'required',
                'pukul' => 'required',
                'tempat' => 'required',
                'acara' => 'required',
                'tujuan_surat' => 'required',
                'undangan' => 'required|array',
                'undangan.*' => 'required|string',
                'keterangan' => 'required',
            ]);

            $phpword->setValues([
                'tanggalsurat' => $request->tanggalsurat,
                'nomorsurat' => $request->nomorsurat,
                'sifatsurat' => $request->sifatsurat,
                'perihal' => $request->perihal,
                'isisurat' => $request->isisurat,
                'haritanggal' => $request->haritanggal,
                'pukul' => $request->pukul,
                'tempat' => $request->tempat,
                'acara' => $request->acara,
            ]);

            for ($i = 0; $i < count($request->undangan); $i++) {
                $replacements[] = array('undangan' => $request->undangan[$i]);
            }
            $phpword->cloneBlock('block', 0, true, false, $replacements);
            $filepath = 'storage/surat/' . $filename;
            $phpword->saveAs($filepath);

            Surat::create([
                'judul_surat' => $request->perihal,
                'nomor_surat' => $request->nomorsurat,
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
    public function test(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
