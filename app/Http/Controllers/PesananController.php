<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    
    public function index() : View
    {
        //get all products
        $pesanans = Pesanan::latest()->paginate(10);

        //render view with products
        return view('pesanans.index', compact('pesanans'));
    }

    public function create(): View
    {
        return view('pesanans.create');
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
            'tgl_pesan'             => 'required|date', // validasi sebagai tanggal
            'nama_pemesan'          => 'required|min:3|max:100|string', // minimal 3 karakter, maksimal 100, harus string
            'harga'                 => 'required|numeric|min:0', // harus angka dan minimal 0
            'total_pembayaran'      => 'required|numeric|min:0', // harus angka dan minimal 0
        ]);        

        //create product
        Pesanan::create([
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
}