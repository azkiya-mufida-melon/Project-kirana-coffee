<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\User;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $entries = $request->get('entries', 10);
        $date_search = $request->get('date_search'); // Ambil parameter date_search dari request

        $pesanans = Pesanan::with('user') // Pastikan relasi 'user' dimuat
            ->when($search, function ($query, $search) {
                return $query->where('nama_pemesan', 'like', '%' . $search . '%');
            })
            ->paginate($entries); // Memastikan pagination sesuai dengan jumlah entri

        return view('pesanans.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data menu
        $menus = Menu::all();
        
        // Ambil daftar pegawai
        $users = User::select('username')->get(); // Pastikan Anda mengambil data yang tepat

        return view('pesanans.create', compact('menus', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'id_menu'           => 'required|exists:menus,id_menu',
            'tgl_pesan'         => 'required|date',
            'nama_pemesan'      => 'required|min:3|max:100|string',
            'harga'             => 'required|numeric|min:0',
            'total_pembayaran'  => 'required|numeric|min:0',
            'jumlah_pesanan'    => 'required|integer|min:1',
            'username_pegawai'  => 'required|exists:users,username', // Validasi username pegawai
        ]);
    
        // Ambil data menu
        $menu = Menu::findOrFail($request->id_menu);
    
        // Cek stok
        if ($menu->stok < $request->jumlah_pesanan) {
            return redirect()->back()->withInput($request->except('jumlah_pesanan'))->with('error', 'Stok tidak mencukupi.');
        }
    
        // Simpan data pesanan
        Pesanan::create([
            'id_menu'           => $request->id_menu,
            'tgl_pesan'         => $request->tgl_pesan,
            'nama_pemesan'      => $request->nama_pemesan,
            'harga'             => $menu->harga,
            'total_pembayaran'  => $request->total_pembayaran,
            'jumlah_pesanan'    => $request->jumlah_pesanan,
            'username_pegawai'  => $request->username_pegawai, // Simpan username pegawai
        ]);
    
        // Kurangi stok
        $menu->stok -= $request->jumlah_pesanan;
        $menu->save();
    
        return redirect()->route('pesanans.index')->with('success', 'Data Berhasil Disimpan!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id_pesanan): View
    {
        // Get the order by ID
        $pesanan = Pesanan::findOrFail($id_pesanan);

        return view('pesanans.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_pesanan): View
    {
        // Get the order by ID
        $pesanan = Pesanan::findOrFail($id_pesanan);

        // Get all menus
        $menus = Menu::all(); // Pastikan model Menu ada dan benar

        $users = User::select('username')->get(); // Pastikan Anda mengambil data yang tepat

        return view('pesanans.edit', compact('pesanan', 'menus', 'users'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_pesanan): RedirectResponse
    {
        // Validate form inputs
        $request->validate([
            'id_menu'           => 'required|exists:menus,id_menu',
            'tgl_pesan'         => 'required|date',
            'nama_pemesan'      => 'required|min:3|max:100|string',
            'harga'             => 'required|numeric|min:0',
            'total_pembayaran'  => 'required|numeric|min:0',
            'jumlah_pesanan'    => 'required|integer|min:1',
            'username_pegawai'  => 'required|exists:users,username',
        ]);

        // Get the order by ID
        $pesanan = Pesanan::findOrFail($id_pesanan);

        $menu = Menu::findOrFail($pesanan->id_menu);

        if ($menu->stok < $request->jumlah_pesanan) {
            // Return to the form with an error and keep the form data (except 'jumlah_pesanan')
            return redirect()->back()->withInput($request->except('jumlah_pesanan'))->with('error', 'Stok tidak mencukupi.');
        }

        // Update the order
        $pesanan->update([
            'id_menu'           => $request->id_menu,
            'tgl_pesan'         => $request->tgl_pesan,
            'nama_pemesan'      => $request->nama_pemesan,
            'harga'             => $menu->harga,
            'total_pembayaran'  => $request->total_pembayaran,
            'jumlah_pesanan'    => $request->jumlah_pesanan,
            'username_pegawai'  => $request->username_pegawai,
        ]);

        $menu->stok -= $request->jumlah_pesanan;
        $menu->save(); // Save the updated stock

        // Redirect to the index page with a success message
        return redirect()->route('pesanans.index')->with('success', 'Data Berhasil Diubah!');
        
        dd(session()->all()); // Menampilkan semua session yang ada untuk debugging

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_pesanan): RedirectResponse
    {
        // Get the order by ID
        $pesanan = Pesanan::findOrFail($id_pesanan);

        // Delete the order
        $pesanan->delete();

        // Redirect to the index page with a success message
        return redirect()->route('pesanans.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
