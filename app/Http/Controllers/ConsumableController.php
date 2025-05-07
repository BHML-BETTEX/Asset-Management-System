<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Status;
use App\Models\Supplier;
use App\Models\Company;
use App\Models\SizeMaseurment;
use App\Models\Department;
use App\Models\productdetails;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ConsumableController extends Controller
{
    function productdetails()
    {
        $all_product_types = ProductType::all();
        $all_departments = Department::all();
        $all_brands = Brand::all();
        $all_SizeMaseurment = SizeMaseurment::all();
        $all_status = Status::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        $productdetails = productdetails::all();
        return view('admin.consumable.productdetails', [
            'all_product_types' => $all_product_types,
            'all_departments' => $all_departments,
            'all_brands' => $all_brands,
            'all_SizeMaseurment' => $all_SizeMaseurment,
            'all_status' => $all_status,
            'all_supplier' => $all_supplier,
            'all_company' => $all_company,
            'productdetails' => $productdetails,

        ]);
    }
    function productdetails_store(Request $request)
    {
        productdetails::insert([
            'asset_type' => $request->asset_type,
            'model' => $request->model,
            'brand' => $request->brand,
            'description' => $request->description,
            'asset_sl_no' => $request->asset_sl_no,
            'qty' => $request->qty,
            'units' => $request->units,
            'warrenty' => $request->warrenty,
            'durablity' => $request->durablity,
            'cost' => $request->cost,
            'total' => $request->total,
            'currency' => $request->currency,
            'vendor' => $request->vendor,
            'purchase_date' => $request->purchase_date,
            'challan_no' => $request->challan_no,
            'location' => $request->location,
            'company' => $request->company,
            'others' => $request->others,
            'others2' => $request->others2,
            'others3' => $request->others3,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('add_message', 'Product added...!');
    }

    function productdetails_delete($id){
        productdetails:: find($id)->delete();
        return redirect()->back()->with('product_delete', 'Product deleted...!');
    }

    function Inventory() {
        return view('admin.consumable.Inventory');
    }

    function consumableIssue(){
        $all_product_types = ProductType::all();
        $all_departments = Department::all();
        $all_brands = Brand::all();
        $all_SizeMaseurment = SizeMaseurment::all();
        $all_status = Status::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        $productdetails = productdetails::all();
        return view('admin.consumable.consumableIssue',[
            'all_product_types' => $all_product_types,
            'all_departments' => $all_departments,
            'all_brands' => $all_brands,
            'all_SizeMaseurment' => $all_SizeMaseurment,
            'all_status' => $all_status,
            'all_supplier' => $all_supplier,
            'all_company' => $all_company,
            'productdetails' => $productdetails,
        ]);
    }
}
