<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    
    public function index() : View
    {
        //get all products
        $transaksis = Transaksi::latest()->paginate(10);

        //render view with products
        return view('transaksis.index', compact('transaksis'));
    }
}
