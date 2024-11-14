<?php

namespace App\Http\Controllers;

use App\Models\Menu;

use App\Models\Pesanan;

use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PesananController extends Controller
{
    
    public function index() : View
    {
        //get all products
        $pesanans = Pesanan::latest()->paginate(10);

        //render view with products
        return view('pesanans.index', compact('pesanans'));
    }

    public function create()
    {
        $menus = Menu::all(); // Ambil semua data menu
        return view('pesanans.create', compact('menus'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'id_menu'               => 'required|exists:menus,id',
            'tgl_pesan'             => 'required|date', // validasi sebagai tanggal
            'nama_pemesan'          => 'required|min:3|max:100|string', // minimal 3 karakter, maksimal 100, harus string
            'harga'                 => 'required|numeric|min:0', // harus angka dan minimal 0
            'total_pembayaran'      => 'required|numeric|min:0', // harus angka dan minimal 0
        ]);        

        $menu = Menu::findOrFail($request->id_menu);

        //create product
        Pesanan::create([
            'id_menu'           => $request->id_menu,
            'tgl_pesan'         => $request->tgl_pesan,
            'nama_pemesan'      => $request->nama_pemesan,
            'harga'             => $request->harga,
            'total_pembayaran'  => $request->total_pembayaran
        ]);

        //redirect to index
        return redirect()->route('pesanans.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id_pesanan): View
    {
        //get product by ID
        $pesanan = Pesanan::findOrFail($id_pesanan);

        //render view with product
        return view('pesanans.show', compact('pesanan'));
    }

    public function edit(string $id_pesanan): View
    {
        //get product by id_pesanan
        $pesanan = Pesanan::findOrFail($id_pesanan);

        //render view with product
        return view('pesanans.edit', compact('pesanan'));
    }

    public function update(Request $request, $id_pesanan): RedirectResponse
{
    // Validasi form
    $request->validate([
        'tgl_pesan'             => 'required|date', 
        'nama_pemesan'          => 'required|min:3|max:100|string', 
        'harga'                 => 'required|numeric|min:0', 
        'total_pembayaran'      => 'required|numeric|min:0', 
    ]);

    // Mendapatkan pesanan berdasarkan ID
    $pesanan = Pesanan::findOrFail($id_pesanan);

    // Update pesanan tanpa gambar
    $pesanan->update([
        'tgl_pesan'         => $request->tgl_pesan,
        'nama_pemesan'      => $request->nama_pemesan,
        'harga'             => $request->harga,
        'total_pembayaran'  => $request->total_pembayaran
    ]);

    // Redirect ke index
    return redirect()->route('pesanans.index')->with(['success' => 'Data Berhasil Diubah!']);
}


    public function destroy($id_pesanan): RedirectResponse
    {
        // Mendapatkan pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id_pesanan);

        // Menghapus pesanan
        $pesanan->delete();

        // Redirect ke index
        return redirect()->route('pesanans.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}