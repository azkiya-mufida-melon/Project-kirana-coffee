<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar laporan.
     */
    public function index(): View
    {
        // Ambil semua data laporan dengan pagination
        $laporans = Laporan::latest()->paginate(10);
        return view('laporans.index', compact('laporans'));
    }

    /**
     * Menampilkan form untuk membuat laporan baru.
     */
    public function create(): View
    {
        return view('laporans.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'id_pesanan'  => 'required|numeric',
            'tgl_laporan' => 'required|date',
        ]);                                        

        // Buat data baru di database
        Laporan::create([
            'id_pesanan'  => $request->id_pesanan,
            'tgl_laporan' => $request->tgl_laporan,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('laporans.index')->with('success', 'Laporan Berhasil Disimpan!');
    }

    /**
     * Menampilkan detail laporan.
     */
    public function show(string $id): View
    {
        // Ambil data laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);
        return view('laporans.show', compact('laporan'));
    }

    /**
     * Menampilkan form untuk mengedit laporan.
     */
    public function edit(string $id): View
    {
        // Ambil data laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);
        return view('laporans.edit', compact('laporan'));
    }

    /**
     * Memperbarui laporan di database.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'id_pesanan'  => 'required|numeric',
            'tgl_laporan' => 'required|date',
        ]);

        // Ambil data laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Update data
        $laporan->update([
            'id_pesanan'  => $request->id_pesanan,
            'tgl_laporan' => $request->tgl_laporan,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('laporans.index')->with('success', 'Laporan Berhasil Diubah!');
    }

    /**
     * Menghapus laporan dari database.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Ambil data laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Hapus data dari database
        $laporan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('laporans.index')->with('success', 'Laporan Berhasil Dihapus!');
    }
}
