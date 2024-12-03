<?php

namespace App\Http\Controllers;

use App\Models\Biodata; 

use Illuminate\View\View;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;

class BiodataController extends Controller
{
    
    public function index() : View
    {
        //get all products
        $biodatas = Biodata::latest()->paginate(10);

        //render view with products
        return view('biodatas.index', compact('biodatas'));
    }

    public function create(): View
    {
    return view('biodatas.create');
    }

/**
 * Store the newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tgl_lahir'     => 'required|date',
            'no_telp'       => 'required|string|max:15',
            'alamat'        => 'required|string',
            'email'         => 'required|email|max:255',
            'jabatan'       => 'required|in:Owner,Barista,Kasir,Koki Snack',
            'foto_profil'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto profil
            'lama_bekerja'  => 'required|date',
        ]);
        
        // Upload image jika ada
        if ($request->hasFile('foto_profil')) {
            $image = $request->file('foto_profil');
            $image->storeAs('public/biodatas', $image->hashName());
        } else {
            $imageName = null; // Atau set nilai default
        }

        // Buat biodata baru
        Biodata::create([
            'foto_profil'     => $image->hashName() ?? null, // Jika ada, simpan nama file; jika tidak, simpan null
            'nama'            => $request->nama,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tgl_lahir'       => $request->tgl_lahir, // Perbaikan: gunakan tgl_lahir dari input
            'no_telp'         => $request->no_telp,
            'alamat'          => $request->alamat,
            'email'           => $request->email,
            'jabatan'         => $request->jabatan,
            'lama_bekerja'    => $request->lama_bekerja,

        ]);

        // Redirect ke index
        return redirect()->route('biodatas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id_biodata): View
    {
        //get product by ID
        $biodata = Biodata::findOrFail($id_biodata);

        //render view with product
        return view('biodatas.show', compact('biodata'));
    }

    public function edit(string $id_biodata): View
    {
        //get product by ID
        $biodata = Biodata::findOrFail($id_biodata);

        //render view with product
        return view('biodatas.edit', compact('biodata'));
    }

    public function update(Request $request, $id_biodata)
{
    // Validasi input
    $request->validate([
        'nama'          => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        'tgl_lahir'     => 'required|date',
        'no_telp'       => 'required|string|max:15',
        'alamat'        => 'required|string',
        'email'         => 'required|email|max:255',
        'jabatan'       => 'required|in:Owner,Barista,Kasir,Koki Snack',
        'foto_profil'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'lama_bekerja'  => 'required|date',
    ]);

    // Temukan biodata berdasarkan ID
    $biodata = Biodata::findOrFail($id_biodata);

    // Cek jika ada file foto profil yang diupload
    if ($request->hasFile('foto_profil')) {
        $image = $request->file('foto_profil');
        $image->storeAs('public/biodatas', $image->hashName());

        // Hapus foto lama jika ada
        Storage::delete('public/biodatas/' . $biodata->foto_profil);

        // Update biodata dengan foto profil baru
        $biodata->update([
            'foto_profil'   => $image->hashName(),
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telp'       => $request->no_telp,
            'alamat'        => $request->alamat,
            'email'         => $request->email,
            'jabatan'       => $request->jabatan,
            'lama_bekerja'  => $request->lama_bekerja,
        ]);
    } else {
        // Update biodata tanpa foto profil baru
        $biodata->update($request->except('foto_profil'));
    }

    return redirect()->route('biodatas.index')->with('success', 'Biodata berhasil diupdate.');
    }

    public function destroy($id_biodata): RedirectResponse
    {
        //get product by ID
        $biodata = Biodata::findOrFail($id_biodata);

        //delete image
        Storage::delete('public/biodatas/'. $biodata->foto_profil);

        //delete product
        $biodata->delete();

        //redirect to index
        return redirect()->route('biodatas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}