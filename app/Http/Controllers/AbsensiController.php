<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $karyawanId = auth()->id();
        $tanggal = Carbon::now()->toDateString();

        // Temukan absensi untuk hari ini berdasarkan id_karyawan dan tanggal
        $absensi = Absensi::where('id_karyawan', $karyawanId)
                         ->where('tanggal', $tanggal)
                         ->first();

        return view('absensis.index', compact('absensi'));
    }

    public function store(Request $request)
    {
        $karyawanId = auth()->id();
        $tanggal = Carbon::now()->toDateString();

        // Temukan atau buat absensi untuk hari ini
        $absensi = Absensi::firstOrCreate(
            ['id_karyawan' => $karyawanId, 'tanggal' => $tanggal],
            ['jam_datang' => Carbon::now()->toTimeString()]
        );

        // Jika tombol 'pulang' ditekan dan belum ada jam pulang
        if ($request->action === 'pulang' && empty($absensi->jam_pulang)) {
            $absensi->update([
                'jam_pulang' => Carbon::now()->toTimeString(),
                'durasi_kerja' => Carbon::parse($absensi->jam_datang)->diff(Carbon::now())->format('%H:%I:%S'),
            ]);
        }

        return redirect()->route('absensis.index')->with('success', 'Absensi berhasil diperbarui!');
    }
}
