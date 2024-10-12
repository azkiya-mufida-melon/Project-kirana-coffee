<?php

namespace App\Http\Controllers;

use App\Models\Menu; 

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $menus = Menu::latest()->paginate(10);

        //render view with products
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
            'detail_menu'   => 'required|min:10',
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

}
