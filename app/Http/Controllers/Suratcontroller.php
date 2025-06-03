<?php

namespace App\Http\Controllers;

use App\Models\GrupTujuanUser;
use App\Models\Penandatangan;
use App\Models\Surat;
use Carbon\Carbon;
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
            'belum_dikirim' => Surat::where('verifikasi', 'belum'),
            'ditolak' => Surat::where('pengirim_id', Auth::id())
                ->where('verifikasi', 'ditolak'),
            'belum_dibaca' => Surat::where('tujuan_id', Auth::id())
                ->where('status', 'baru')
                ->where('verifikasi', 'tertanda'),
            'tindaklanjut' => Surat::where('tujuan_id', Auth::id())
                ->whereNot('status', 'selesai')
                ->where('verifikasi', 'tertanda'),
        ];

        // Only add pengirim_id filter for non-admin users
        if (Auth::user()->role != 'admin') {
            $data['belum_dikirim'] = $data['belum_dikirim']->where('pengirim_id', Auth::id());
        }

        $grupTujuanId = GrupTujuanUser::where('user_id', Auth::id())
            ->pluck('grup_tujuan_id');
        $surat = Surat::where(function ($query) use ($grupTujuanId) {
            $query->where('tujuan_id', Auth::id())
                ->orWhereIn('gruptujuan_id', $grupTujuanId);
        })
            ->where('verifikasi', 'tertanda')
            ->orderBy('created_at', 'desc')
            ->get();

        // Convert query builders to counts
        foreach ($data as $key => $query) {
            $data[$key] = $query->count();
        }


        return view('beranda', compact('surat', 'data'));
    }

    public function pilihsuratkeluar()
    {
        return view('pilihsuratkeluar');
    }

    public function download(String $id)
    {
        $surat = Surat::findOrFail($id)->isi;
        $file = public_path('storage/surat/' . $surat);
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        return response()->download($file, $surat, $headers);
    }

    public function createTemplate(Request $request, $filename, $phpword)
    {
        $request->validate([
            'tanggalsurat' => 'required|date',
            'nomorsurat' => 'required|string',
            'sifatsurat' => 'required|string',
            'jenis_surat' => 'required|string',
            'perihal' => 'required|string',
            'isisurat' => 'required|string',
            'haritanggal_mulai' => 'required|date|after_or_equal:today',
            'haritanggal_selesai' => 'required|date|after_or_equal:haritanggal_mulai',
            'tempat' => 'required|string',
            'acara' => 'required|string',
            'tujuan_id' => 'required|integer',
            'penandatangan_id' => 'required|integer',
            'verifikator_id' => 'required|integer',
            'gruptujuan_id' => 'nullable|integer',
            'undangan' => 'required|array',
            'undangan.*' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $request->tanggalsurat = Carbon::createFromFormat('Y-m-d', $request->tanggalsurat)
            ->locale('id')
            ->translatedFormat('l, d F Y');

        $request->haritanggal_mulai = date_create($request->haritanggal_mulai);
        $request->haritanggal_selesai = date_create($request->haritanggal_selesai);

        $start_date = Carbon::createFromDate($request->haritanggal_mulai)
            ->locale('id')
            ->translatedFormat('d F Y');
        $end_date = Carbon::createFromDate($request->haritanggal_selesai)
            ->locale('id')
            ->translatedFormat('d F Y');

        if ($start_date === $end_date) {
            $haritanggal = $start_date;
            $pukul = date_format($request->haritanggal_mulai, 'H:i');
        } else {
            $haritanggal = $start_date . ' s.d. ' . $end_date;
            $pukul = date_format($request->haritanggal_mulai, 'H:i') . ' - ' . date_format($request->haritanggal_selesai, 'H:i') . ' WITA';
        }

        $phpword->setValues([
            'tanggalsurat' => $request->tanggalsurat,
            'nomorsurat' => $request->nomorsurat,
            'sifatsurat' => $request->sifatsurat,
            'perihal' => $request->perihal,
            'isisurat' => $request->isisurat,
            'haritanggal' => $haritanggal,
            'pukul' => $pukul,
            'tempat' => $request->tempat,
            'acara' => $request->acara,
        ]);

        for ($i = 0; $i < count($request->undangan); $i++) {
            $replacements[] = array('undangan' => $request->undangan[$i]);
        }
        $phpword->cloneBlock('block', 0, true, false, $replacements);
        $filepath = 'storage/surat/' . $filename;
        $phpword->saveAs($filepath);
    }

    public static function createNotaDinas($request, $filename)
    {
        $request->validate([
            'yth' => 'required|string',
            'lampiran' => 'required|string',
            'perihal' => 'required|string',
            'paragraf_1' => 'required|string',
            'paragraf_2' => 'required|string',
        ]);
        try {
            $phpword = new \PhpOffice\PhpWord\TemplateProcessor('NOTADINAS.docx');
            $phpword->setValues([
                'yth' => $request->yth,
                'dari' => Auth::user()->nama,
                'nomor' => $request->nomor_surat,
                'sifat' => $request->sifat_surat,
                'lampiran' => $request->lampiran,
                'perihal' => $request->perihal,
                'paragraf_1' => $request->paragraf_1,
                'paragraf_2' => $request->paragraf_2,
                'jabatan_tertanda' => Penandatangan::findOrFail($request->penandatangan_id)->user->jabatan,
                'nama_tertanda' => Penandatangan::findOrFail($request->penandatangan_id)->user->name,
                'nip_tertanda' => Penandatangan::findOrFail($request->penandatangan_id)->nip,
            ]);
            $filepath = 'storage/surat/' . $filename;
            $phpword->saveAs($filepath);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public static function createSuratPerintah($request, $filename)
    {
        $request->validate([
            'dasar' => 'required|string',
            'hal' => 'required|string',
            'kepada' => 'required|string',
            'untuk' => 'required|string',
        ]);
        try {
            $phpword = new \PhpOffice\PhpWord\TemplateProcessor('SURATTUGAS.docx');
            $phpword->setValues([
                'nomor_naskah' => $request->nomor_surat,
                'dasar' => $request->dasar,
                'hal' => $request->hal,
                'kepada' => $request->kepada,
                'untuk' => $request->untuk,
                'jabatan_tertanda' => Penandatangan::findOrFail($request->penandatangan_id)->user->jabatan,
                'nama_tertanda' => Penandatangan::findOrFail($request->penandatangan_id)->user->name,
                'nip_tertanda' => Penandatangan::findOrFail($request->penandatangan_id)->nip,
                'pangkat_tertanda' => Penandatangan::findOrFail($request->penandatangan_id)->user->golongan,
            ]);
            $filepath = 'storage/surat/' . $filename;
            $phpword->saveAs($filepath);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
