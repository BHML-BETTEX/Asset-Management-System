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
    public function index(Request $request)
    {
        // User role company permission check (same logic as instock_list)
        $role = auth()->user()->roles[0];

        $isAdminManager = in_array($role->name, ['Admin', 'Manager']);

        if ($isAdminManager) {
            $companies = [1, 2, 3, 4];
        } else {
            $companies = [];
            if ($role->hasPermissionTo('view BHML INDUSTRIES LTD.')) $companies[] = 1;
            if ($role->hasPermissionTo('view BETTEX')) $companies[] = 2;
            if ($role->hasPermissionTo('view BETTEX PREMIUM')) $companies[] = 3;
            if ($role->hasPermissionTo('view BETTEX BRIDGE')) $companies[] = 4;
        }

        $query = $isAdminManager ? Store::query() : Store::whereIn('company_id', $companies);

        if ($request->filled('asset_type')) {
            $query->where('asset_type', $request->asset_type);
        }

        $stores = $query->get();

        // counts for dashboard tiles (company filtered; Admin/Manager sees all)
        if ($isAdminManager) {
            $assetCount = Store::count();
            $laptopCount = Store::where('asset_type', 1)->count();
            $desktopCount = Store::where('asset_type', 2)->count();
            $printerCount = Store::where('asset_type', 4)->count();

            $employeeCount = DB::table('employees')->count();
            $userCount = DB::table('users')->count();
        } else {
            $assetCount = Store::whereIn('company_id', $companies)->count();
            $laptopCount = Store::whereIn('company_id', $companies)->where('asset_type', 1)->count();
            $desktopCount = Store::whereIn('company_id', $companies)->where('asset_type', 2)->count();
            $printerCount = Store::whereIn('company_id', $companies)->where('asset_type', 4)->count();

            $employeeCount = DB::table('employees')->whereIn('company', $companies)->count();
            $userCount = DB::table('users')->count();
        }

        if ($isAdminManager) {
            $desktops = DB::select("SELECT * FROM stores WHERE asset_type = 2");
            $laptops = DB::select("SELECT * FROM stores WHERE asset_type = 1");
            $printers = DB::select("SELECT * FROM stores WHERE asset_type = 3");
        } else {
            $desktops = DB::select("SELECT * FROM stores WHERE asset_type = 2 AND company_id IN (" . implode(',', $companies) . ")");
            $laptops = DB::select("SELECT * FROM stores WHERE asset_type = 1 AND company_id IN (" . implode(',', $companies) . ")");
            $printers = DB::select("SELECT * FROM stores WHERE asset_type = 3 AND company_id IN (" . implode(',', $companies) . ")");
        }
        $product_summary_bt = DB::select("CALL sp_product_summary_bt()");
        $product_summary_bhml = DB::select("CALL sp_product_summary_bhml()");
        $product_summary_bp = DB::select("CALL sp_product_summary_bp()");
        $product_summary_bt_ind = DB::select("CALL sp_product_summary_bt_ind()");
        //dd($product_summary_bhml);


        foreach ($product_summary_bt as $product_summary) {
            //dd($product_summary->asset_type);
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units_id);
            //dd($units );

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;
        }

        foreach ($product_summary_bhml as $product_summary) {
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units_id);

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;
        }

        foreach ($product_summary_bp as $product_summary) {
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units_id);

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;
        }

        foreach ($product_summary_bt_ind as $product_summary) {
            $product_type = ProductType::find($product_summary->asset_type);
            $units = SizeMaseurment::find($product_summary->units_id);

            $product_summary->asset_type = $product_type;
            $product_summary->units = $units;
        }



        return view('home', [
            'stores' => $stores,
            'desktops' => $desktops,
            'laptops' => $laptops,
            'printers' => $printers,
            'product_summary_bt' => $product_summary_bt,
            'product_summary_bhml' => $product_summary_bhml,
            'product_summary_bp' => $product_summary_bp,
            'product_summary_bt_ind' => $product_summary_bt_ind,
            'assetCount' => $assetCount,
            'laptopCount' => $laptopCount,
            'desktopCount' => $desktopCount,
            'printerCount' => $printerCount,
            'employeeCount' => $employeeCount,
            'userCount' => $userCount,
        ]);
    }

    public function master()
    {
        return view('master');
    }
}
