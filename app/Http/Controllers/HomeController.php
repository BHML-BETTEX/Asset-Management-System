<?php

namespace App\Http\Controllers;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stores =Store::all();
        $product_summary = DB::select("CALL sp_product_summary_bt()");
        $product_summary_bhml = DB::select("CALL sp_product_summary_bhml()");
        $product_summary_bp = DB::select("CALL sp_product_summary_bp()");
        return view('home',[
            'stores' => $stores,
            'product_summary'=> $product_summary,
            'product_summary_bhml'=> $product_summary_bhml,
            'product_summary_bp'=> $product_summary_bp,
        ]);

        
    }

    public function master()
    {
        return view('master');
    }
}
