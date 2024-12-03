<?php

namespace App\Http\Controllers;

use App\Models\Menu; 

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
    $search = $request->get('search');
    $entries = $request->get('entries', 10);

    $menus = Menu::when($search, function ($query, $search) {
        return $query->where('nama_menu', 'like', '%' . $search . '%');
    })
    ->paginate($entries); // Memastikan pagination sesuai dengan jumlah entri


    return view('menus.index', compact('menus'));
    }


    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('menus.create');
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
            'gambar_menu'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_menu'         => 'required|min:5',
            'detail_menu'   => 'required',
            'harga'         => 'required|numeric',
            'stok'         => 'required|numeric'
        ]);

        //upload image
        $image = $request->file('gambar_menu');
        $image->storeAs('public/menus', $image->hashName());

        //create product
        Menu::create([
            'gambar_menu'         => $image->hashName(),
            'nama_menu'         => $request->nama_menu,
            'detail_menu'   => $request->detail_menu,
            'harga'         => $request->harga,
            'stok'         => $request->stok
        ]);

        //redirect to index
        return redirect()->route('menus.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id_menu
     * @return View
     */
    public function show(string $id_menu): View
    {
        //get product by ID
        $menu = Menu::findOrFail($id_menu);

        //render view with product
        return view('menus.show', compact('menu'));
    }

    public function edit(string $id_menu): View
    {
        //get product by ID_menu
        $menu = Menu::findOrFail($id_menu);

        //render view with product
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, $id_menu): RedirectResponse
    {
        //validate form
        $request->validate([
            'gambar_menu'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama_menu'         => 'required|min:5',
            'detail_menu'   => 'required|min:10',
            'harga'         => 'required|numeric',
            'stok'         => 'required|numeric'
        ]);

        //get product by ID
        $menu = Menu::findOrFail($id_menu);

        //check if image is uploaded
        if ($request->hasFile('gambar_menu')) {

            //upload new image
            $image = $request->file('gambar_menu');
            $image->storeAs('public/menus', $image->hashName());

            //delete old image
            Storage::delete('public/menus/'.$menu->gambar_menu);

            //update product with new image
            $menu->update([
                'gambar_menu'         => $image->hashName(),
                'nama_menu'         => $request->nama_menu,
                'detail_menu'   => $request->detail_menu,
                'harga'         => $request->harga,
                'stok'         => $request->stok
            ]);

        } else {

            //update product without image
            $menu->update([
                'nama_menu'         => $request->nama_menu,
                'detail_menu'   => $request->detail_menu,
                'harga'         => $request->harga,
                'stok'         => $request->stok
            ]);
        }

        //redirect to index
        return redirect()->route('menus.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id_menu): RedirectResponse
    {
        //get product by ID
        $menu = Menu::findOrFail($id_menu);

        //delete image
        Storage::delete('public/menus/'. $menu->gambar_menu);

        //delete product
        $menu->delete();

        //redirect to index
        return redirect()->route('menus.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
