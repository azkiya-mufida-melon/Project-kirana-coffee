<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    
    public function index() : View
    {
        //get all products
        $transaksis = Transaksi::with('pesanan.menu')->paginate(10);

        //render view with products
        return view('transaksis.index', compact('transaksis'));
    }

    public function create(): View
    {
        return view('transaksis.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'id_pesanan'          => 'required|numeric',
            'tgl_transaksi'       => 'required|date',
            'total_bayar'        => 'required',
            'jumlah_pesanan'     => 'required',
            'metode_pembayaran'   => 'required',
            'status_transaksi'    => 'required',
        ]);

        //create product
        Transaksi::create([
            'id_pesanan'            => $request->id_pesanan,
            'tgl_transaksi'         => $request->tgl_transaksi,
            'total_bayar'           => $request->total_bayar,
            'jumlah_pesanan'        => $request->jumlah_pesanan,
            'metode_pembayaran'     => $request->metode_pembayaran,
            'status_transaksi'      => $request->status_transaksi,
        ]);

        //redirect to index
        return redirect()->route('transaksis.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id_transaksi): View
    {
        //get product by ID
        $transaksi = Transaksi::findOrFail($id_transaksi);

        //render view with product
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit(string $id_transaksi): View
    {
        //get product by ID
        $transaksi = Transaksi::findOrFail($id_transaksi);

        //render view with product
        return view('transaksis.edit', compact('transaksi'));
    }

    public function update(Request $request, $id_transaksi): RedirectResponse
    {
        //validate form
        $request->validate([
            'id_pesanan'          => 'required|numeric',
            'tgl_transaksi'       => 'required|date',
            'total_bayar'         => 'required',
            'jumlah_pesanan'      => 'required',
            'metode_pembayaran'   => 'in:Cash,QRIS',
            'status_transaksi' => 'in:Lunas,Belum Lunas',
        ]);

        //get product by ID
        $transaksi = Transaksi::findOrFail($id_transaksi);

            //update product with new image
            $transaksi->update([
                'id_pesanan'            => $request->id_pesanan,
                'tgl_transaksi'         => $request->tgl_transaksi,
                'total_bayar'           => $request->total_bayar,
                'jumlah_pesanan'        => $request->jumlah_pesanan,
                'metode_pembayaran' => $request->input('metode_pembayaran'),
                'status_transaksi' => $request->input('status_transaksi'),
            ]);

        //redirect to index
        return redirect()->route('transaksis.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id_transaksi): RedirectResponse
    {
        //get product by id_transaksi
        $transaksi = Transaksi::findOrFail($id_transaksi);

        //delete product
        $transaksi->delete();

        //redirect to index
        return redirect()->route('transaksis.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
