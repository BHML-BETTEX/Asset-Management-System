<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\SizeMaseurment;
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
        $stores = Store::all();
        $product_summary_bt = DB::select("CALL sp_product_summary_bt()");
        $product_summary_bhml = DB::select("CALL sp_product_summary_bhml()");
        $product_summary_bp = DB::select("CALL sp_product_summary_bp()");
        $product_summary_bt_ind = DB::select("CALL sp_product_summary_bt_ind()");
        // //dd($product_summary_bhml);


        foreach ($product_summary_bt as $product_summary) {
            //dd($product_summary->asset_type);
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units);
            //dd($units );

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;
        }

        foreach ($product_summary_bhml as $product_summary) {
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units);

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;
        }

        foreach ($product_summary_bp as $product_summary) {
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units);

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;

        }

        foreach ($product_summary_bt_ind as $product_summary) {
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units);

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;

        }

        

        return view('home', [
            'stores' => $stores,
            'product_summary_bt' => $product_summary_bt,
            'product_summary_bhml' => $product_summary_bhml,
            'product_summary_bp' => $product_summary_bp,
            'product_summary_bt_ind' => $product_summary_bt_ind,

        ]);
    }

    public function master()
    {
        return view('master');
    }
}
