<?php

namespace App\Http\Controllers;

use App\Models\StatusPesanan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatusPesananController extends Controller
{
    /**
     * Menampilkan daftar status pesanan.
     */
    public function index(): View
    {
        // Ambil semua data status pesanan dengan pagination
        $statusPesanans = StatusPesanan::latest()->paginate(10);
        return view('status_pesanans.index', compact('statusPesanans'));
    }

    /**
     * Menampilkan form untuk membuat status pesanan baru.
     */
    public function create(): View
    {
        return view('status_pesanans.create');
    }

    /**
     * Menyimpan status pesanan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'id_pesanan'     => 'required|numeric',
            'nama_pemesan'   => 'required|min:3',
            'detail_pesanan' => 'required|min:10',
            'status'         => 'required|string',
        ]);

        // Buat data baru di database
        StatusPesanan::create([
            'id_pesanan'     => $request->id_pesanan,
            'nama_pemesan'   => $request->nama_pemesan,
            'detail_pesanan' => $request->detail_pesanan,
            'status'         => $request->status,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('status_pesanans.index')->with('success', 'Status Pesanan Berhasil Disimpan!');
    }

    /**
     * Menampilkan detail status pesanan.
     */
    public function show(string $id): View
    {
        // Ambil data status pesanan berdasarkan ID
        $statusPesanan = StatusPesanan::findOrFail($id);
        return view('status_pesanans.show', compact('statusPesanan'));
    }

    /**
     * Menampilkan form untuk mengedit status pesanan.
     */
    public function edit(string $id): View
    {
        // Ambil data status pesanan berdasarkan ID
        $statusPesanan = StatusPesanan::findOrFail($id);
        return view('status_pesanans.edit', compact('statusPesanan'));
    }

    /**
     * Memperbarui status pesanan di database.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'id_pesanan'     => 'required|numeric',
            'nama_pemesan'   => 'required|min:3',
            'detail_pesanan' => 'required|min:10',
            'status'         => 'required|string',
        ]);

        // Ambil data status pesanan berdasarkan ID
        $statusPesanan = StatusPesanan::findOrFail($id);

        // Update data
        $statusPesanan->update([
            'id_pesanan'     => $request->id_pesanan,
            'nama_pemesan'   => $request->nama_pemesan,
            'detail_pesanan' => $request->detail_pesanan,
            'status'         => $request->status,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('status_pesanans.index')->with('success', 'Status Pesanan Berhasil Diubah!');
    }

    /**
     * Menghapus status pesanan dari database.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Ambil data status pesanan berdasarkan ID
        $statusPesanan = StatusPesanan::findOrFail($id);

        // Hapus data dari database
        $statusPesanan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('status_pesanans.index')->with('success', 'Status Pesanan Berhasil Dihapus!');
    }
}
