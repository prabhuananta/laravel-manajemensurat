<?php

namespace App\Http\Controllers;

use App\Models\GrupTujuan;
use App\Models\Penandatangan;
use App\Models\Surat;
use App\Models\User;
use App\Models\verifikator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SuratKeluarcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = Surat::where('pengirim_id', Auth::id())
            ->where('verifikasi', '!=', 'ditolak')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('daftarsuratkeluar', compact('surat'));
    }

    public function indexverifikasi()
    {
        $surat = Surat::whereHas('verifikator', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('verifikasi', 'belum')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('verifikasisuratkeluar', compact('surat'));
    }
    public function indextandatangan()
    {
        $surat = Surat::whereHas('penandatangan', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('verifikasi', 'sudah')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tandatangansuratkeluar', compact('surat'));
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

    public function tandatangan(Request $request) //TODO
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $surat = Surat::findOrFail($request->id);
            $penandatangan = Penandatangan::with('user')->findOrFail($surat->penandatangan_id);
            $phpword = new \PhpOffice\PhpWord\TemplateProcessor('./storage/surat/' . $surat->isi);
            $phpword->setImageValue('tertanda', [
                'path' => public_path('storage/tanda_tangan/' . $penandatangan->file_tanda_tangan),
                'width' => 300,
                'height' => 100,
                'ratio' => true,
            ]);
            $phpword->saveAs(public_path('storage/surat/' . $surat->isi));

            Surat::where('id', $request->id)->update([
                'verifikasi' => 'tertanda',
            ]);
            return back()->with('success', 'Surat berhasil ditandatangani');
        } catch (\Exception $e) {
            return back()->with('error',  'Surat gagal ditandatangani: ' . $e->getMessage())->withInput();
        }
    }

    public function tolak(Request $request, $id)
    {
        try {
            $request->validate([
                'keterangan' => 'required|string',
            ]);

            Surat::where('id', $id)->update([
                'verifikasi' => 'ditolak',
                'keterangan' => $request->keterangan,
            ]);
            return back()->with('success', 'Surat berhasil ditolak');
        } catch (\Exception $e) {
            return back()->with('error',  'Surat gagal ditolak: ' . $e->getMessage())->withInput();
        }
    }

    public function indexditolak()
    {
        if (Auth::user()->role === 'admin') {
            $surat = Surat::where('verifikasi', '=', 'ditolak')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $surat = Surat::where('pengirim_id', Auth::id())
                ->where('verifikasi', '=', 'ditolak')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('tolaksuratkeluar', compact('surat'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function createsuratperintah(Request $request)
    {
        $penerima = User::where('id', '!=', Auth::id())->get();
        $grupTujuan = GrupTujuan::all();
        $verifikator = verifikator::all();
        $penandatangan = Penandatangan::all();
        return view('formsurat-suratperintah', compact('penerima', 'grupTujuan', 'verifikator', 'penandatangan'));
    }
    public function createnotadinas(Request $request)
    {
        $penerima = User::where('id', '!=', Auth::id())->get();
        $grupTujuan = GrupTujuan::all();
        $verifikator = verifikator::all();
        $penandatangan = Penandatangan::all();
        return view('formsurat-notadinas', compact('penerima', 'grupTujuan', 'verifikator', 'penandatangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tujuan_id' => 'required|integer',
            'gruptujuan_id' => 'required|integer',
            'verifikator_id' => 'required|integer',
            'penandatangan_id' => 'required|integer',
            'nomor_surat' => 'required|string',
            'sifat_surat' => 'required|string',
            'keterangan' => 'required|string',
            'judul_surat' => 'required|string',
        ]);
        $filename = 'surat' . time() . '.docx';
        try {
            if ($request->jenis_surat === 'SURAT PERINTAH') {
                Suratcontroller::createSuratPerintah($request, $filename);
            } else if ($request->jenis_surat === 'NOTA DINAS') {
                Suratcontroller::createNotaDinas($request, $filename);
            }

            Surat::create([
                'sifat_surat' => $request->sifat_surat,
                'jenis_surat' => $request->jenis_surat,
                'judul_surat' => $request->judul_surat,
                'nomor_surat' => $request->nomor_surat,
                'isi' => $filename,
                'pengirim_id' => Auth::id(),
                'tujuan_id' => $request->tujuan_id,
                'verifikator_id' => $request->verifikator_id,
                'penandatangan_id' => $request->penandatangan_id,
                'gruptujuan_id' => $request->gruptujuan_id,
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
}
