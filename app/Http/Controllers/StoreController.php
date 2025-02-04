<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\ProductType;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Status;
use App\Models\Supplier;
use App\Models\Company;
use App\Models\issue;
use App\Models\SizeMaseurment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use App\Models\Desktop;
use Illuminate\Support\Facades\DB;



class StoreController extends Controller
{
    function store(Request $request)
    {
        $role = auth()->user()->roles[0];
        
        $search = $request['search'] ?? "";
        if($search != ""){
            $stores = Store::where('products_id', 'LIKE', "%$search")->orwhere('asset_type', 'LIKE', "%$search")
            ->orwhere('brand', 'LIKE', "%$search")
            ->orwhere('vendor', 'LIKE', "%$search")
            ->orwhere('company', 'LIKE', "%$search")
            ->orwhere('checkstatus', 'LIKE', "%$search")
            ->get();
        }
        else{
            $stores = Store::where(function($query) use($role){
                // dd(auth()->user()->roles[0]->hasPermissionTo('view BETTEX'));
                $companies = [];
                
                $role->hasPermissionTo('view BHML INDUSTRIES LTD.') ? array_push($companies, 1) : '';
                $role->hasPermissionTo('view BETTEX') ? array_push($companies, 2) : '';
                $role->hasPermissionTo('view BETTEX PREMIUM') ? array_push($companies, 3) : '';
                
                $query->whereIn('company', $companies);

                return $query;
            })->get();
        }

        
        $all_product_types = ProductType::all();
        $all_departments = Department::all();
        $all_brands = Brand::all();
        $all_SizeMaseurment = SizeMaseurment::all();
        $all_status = Status::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        return view('admin.store.store_list', [
            'stores' => $stores,
            'all_product_types' => $all_product_types,
            'all_departments' => $all_departments,
            'all_brands' => $all_brands,
            'all_SizeMaseurment' => $all_SizeMaseurment,
            'all_status' => $all_status,
            'all_supplier' => $all_supplier,
            'all_company' => $all_company,
            'search'=> $search,

        ]);
    }

    function store_store(Request $request)
    {
        $picture_id = Store::insertGetId([
            'products_id' => $request->products_id,
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
            'currency' => $request->currency,
            'vendor' => $request->vendor,
            'purchase_date' => $request->purchase_date,
            'challan_no' => $request->challan_no,
            'status' => $request->status,
            'location' => $request->location,
            'company' => $request->company,
            'others' => $request->others,
            'checkstatus' => $request->checkstatus,
            'others2' => $request->others2,
            'created_at' => Carbon::now(),

        ]);

        // $asset_picture = $request->picture;
        // $extension = $asset_picture->getClientOriginalExtension();
        // $file_name = $picture_id . '.' . $extension;


        // Image::make($asset_picture)->save(public_path('/uploads/store/' . $file_name));

        // dd($file_name);

        // Store::where('id', $picture_id)->update([
        //     'picture' => $file_name,
        // ]);
        return back();
    }
    //delete start
    function store_delete($stores_id)
    {
        Store::find($stores_id)->delete();
        return back();
    }
    //delete end


    //Edit start

    function store_edit($stores_id)
    {
        $all_product_types = ProductType::all();
        $all_brands = Brand::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        $all_status = Status::all();
        $all_departments = Department::all();
        $all_SizeMaseurment = SizeMaseurment::all();
        $all_store = Store::find($stores_id);
        return view('admin.store.store_edit', [
            'all_store' => $all_store,
            'all_product_types' => $all_product_types,
            'all_brands' => $all_brands,
            'all_supplier' => $all_supplier,
            'all_company' => $all_company,
            'all_status' => $all_status,
            'all_departments' => $all_departments,
            'all_SizeMaseurment' => $all_SizeMaseurment,
        ]);
    }

    //update
    function store_update(Request $request)
    
    {
        if($request->picture==''){
            Store::find($request->stores_id)->update([
                'asset_type'=>$request->asset_type,
                'model'=> $request->model,
                
            ]);
        }
        else{
            Store::find($request->stores_id)->update([
                
            ]);
        }
    }
    //Edit end


    //view start
    function store_view($stores_id)
    {
        $stores_info = Store::find($stores_id);
        return view('admin.store.store_printview', [
            'stores_info' => $stores_info,
        ]);
    }

    //view end


    //issue start...
    function issue()
    {
        $issued_products = DB::select("CALL sp_issued_products()");
        $product_types = ProductType::all();
        $departments = Department::all();
        $designation = designation::all();
        $stores = Store::all();
        $employee = Employee::all();
        return view('admin.store.issue', [
            'issued_products' => $issued_products,
            'stores' => $stores,
            'departments' => $departments,
            'designation' => $designation,
            'product_types' => $product_types,
            'employee' => $employee,
        ]);
    }

    function issue_store(Request $request)
    {
        issue::insertGetId([
            'asset_tag' => $request->asset_tag,
            'asset_type' => $request->asset_type,
            'model' => $request->model,
            'description' => $request->description,
            'emp_id' => $request->emp_id,
            'emp_name' => $request->emp_name,
            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'others' => $request->others,
            'issue_date' => $request->issue_date,
            'return_date' => $request->return_date,
        ]);
        return back();
    }
    //issue end

    //autofill start...
    function search_by_id($store_id)
    {
        $issued_products = Store::find($store_id);
        $issued_products_data =[
            'products_id' => $issued_products->products_id,
            'asset_type' =>$issued_products->rel_to_ProductType->product,
            'model'=>$issued_products->model,
        ];
        $issued_products = Store::find($store_id);
        return response()->json(['data' => $issued_products_data]);
    }
    //autofill end


    //invoice start...
    function invoice($stores_id)
    {
        $stores_info = Store::find($stores_id);
        return view('admin.store.invoice', [
            'stores_info' => $stores_info,
        ]);
    }

    //invoice end.

    //return start...
    function return()
    {
        $return_products = DB::select("CALL sp_return_products()");
        $issue_info = issue::all();
        return view('admin.store.return', [
            'return_products' => $return_products,
            'issue_info' => $issue_info,
        ]);
    }

    function return_update(Request $request)
    {
        // dd($request->all());

        // // issue::find($request->asset_tag)->update([

        // //     'return_date' => $request->return_date,
        // // ]);

        DB::table("issues")
        ->where(['asset_tag' => $request->asset_tag])
        ->update(['return_date' => $request->return_date]);
    }

    //return end.

    //autofill start...
    function return_search_by_id($store_id)
    {
        $return_products = DB::table('stores')->select('id', 'products_id', 'asset_type', 'model')->where('id', $store_id)->first();
        
        return response()->json(['data' => $return_products]);
    }
    //autofill end

    //store search start...

    function store_search(Request $request) {
        $data = $request->input('search');
        $all_product_types = DB::table('stores')->where('products_id', 'LIKE', '%' . $data . '%')
        //->orwhere('asset_type', 'LIKE', '%' . $data . '%')
        ->get();
        
        return view ('admin.store.store_list',  compact('all_product_types'));
    }
    //store search end.



    //History
    function history(){
        $issue_info = issue::all();
        return view('admin.store.history', [
            'issue_info' => $issue_info,
        ]);
    }

}
