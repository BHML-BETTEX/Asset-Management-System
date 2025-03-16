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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StoreExport;
use App\Exports\TransferExport;
use App\Models\Transfer;
use App\Models\Maintenance;
use App\Exports\MaintenanceExport;
use App\Models\WastProduct;
use App\Exports\WastProductExport;


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
            ->orwhere('asset_sl_no', 'LIKE', "%$search")
            ->paginate(13);
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
            })->paginate(13);
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

    function add_product(){
        $all_product_types = ProductType::all();
        $all_departments = Department::all();
        $all_brands = Brand::all();
        $all_SizeMaseurment = SizeMaseurment::all();
        $all_status = Status::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        return view('admin.store.add_product',[
            'all_product_types' => $all_product_types,
            'all_departments' => $all_departments,
            'all_brands' => $all_brands,
            'all_SizeMaseurment' => $all_SizeMaseurment,
            'all_status' => $all_status,
            'all_supplier' => $all_supplier,
            'all_company' => $all_company,
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

        if ($request->file('picture')) {
            $imageName = $picture_id . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads/store/'), $imageName);

            Store::where('id', $picture_id)->update([
                'picture' => $imageName,
            ]);
        }

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
        if($request->picture ==''){
            Store::find($request->stores_id)->update([
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
                'others2' => $request->others2,
                    
            ]);
            return back();
           }
           else {
            $store = Store::find($request->stores_id);
            $delete_from = public_path('/uploads/store/' . $store->picture);
            if (file_exists($delete_from)) {
                unlink($delete_from);
            }
    
            $imageName = null;
            if ($request->file('picture')) {
                $imageName = $request->stores_id . '.' . $request->picture->extension();
                $request->picture->move(public_path('uploads/store/'), $imageName);
    
                Store::where('id', $request->stores_id)->update([
                    'picture' => $imageName,
                ]);
                return back();
            }
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
            'created_at' => Carbon::now(),

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
            'purchase_date'=>$issued_products->purchase_date,
            'asset_sl_no'=>$issued_products->asset_sl_no,
            'company'=>$issued_products->rel_to_Company->company,

        ];
        $issued_products = Store::find($store_id);
        return response()->json(['data' => $issued_products_data]);
    }

    function store_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "assetlist-data.$extension";
        return Excel::download(new StoreExport, $Filename, $exportFormat);

    }
    //autofill end

    //invoice start...
    function invoice($stores_id)
    {
        $stores_info = Store::find($stores_id);

        $issue_info = DB::table('issues')->select('asset_tag', 'asset_type', 'model', 'emp_id', 'emp_name', 'phone_number', 'email', 'designation_id', 'issue_date')->where('asset_tag', $stores_info->products_id)->first();  

        return view('admin.store.invoice', [
            'stores_info' => $stores_info,
            'issue_info' => $issue_info,
        ]);
    }

    function qr_code($stores_id){
        $qrCode = Store::find($stores_id);
        return view('admin.store.qr_code',[
            'qrCode'=>$qrCode,
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
        DB::table("issues")
        ->where(['asset_tag' => $request->asset_tag])
        ->update(['return_date' => $request->return_date]);

        return back();
    }


    //return end.

    //autofill start...
    function return_search_by_id($store_id)
    {
        $return_products = DB::table('issues')->select('asset_tag', 'asset_type', 'model', 'emp_id', 'emp_name', 'designation_id', 'issue_date')->where('id', $store_id)->first();  
        
        return response()->json(['data' => $return_products]);
    }

    function history_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "history-data.$extension";
        return Excel::download(new StoreExport, $Filename, $exportFormat);
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
    function history(Request $request){
        
        $search = $request['search'] ?? "";
        if($search != ""){
            $issue_info = issue::where('asset_tag', 'LIKE',"%$search" )-> orwhere('asset_type', 'LIKE',"%$search")-> orwhere('emp_id', 'LIKE',"%$search")-> orwhere('emp_name', 'LIKE',"%$search")-> orwhere('emp_name', 'LIKE',"%$search")->paginate(13);
        }
        else{
            $issue_info = issue::paginate(13);
        }
        
        return view('admin.store.history', [
            'issue_info' => $issue_info,
            'search'=> $search,
        ]);
    }

    



    //Transfer Start

    function store_transfer(){
        $issued_products = Store::all();
        $companys = Company::all();
        return view('admin.store.transfer',[
            'issued_products'=>$issued_products,
            'companys'=>$companys,

        ]);
    }

    function transfer_store(Request $request){
        Transfer::insertGetId([
            'asset_tag' => $request->asset_tag,
            'asset_type' => $request->asset_type,
            'model' => $request->model,
            'company' => $request->company,
            'description' => $request->description,
            'note' => $request->note,
            'transfer_date' => $request->transfer_date,
            'oldcompany'=> $request->oldcompany,
            'others'=> $request->others,

        ]);
        return redirect()->route('transfer_list');
    }

    function transfer_list(Request $request){
        $search = $request['search'] ?? "";
        if($search != ""){
            $transer_data = Transfer::where('asset_tag', 'LIKE',"%$search" )-> orwhere('asset_type', 'LIKE',"%$search")->orwhere ('company', 'LIKE',"%$search")->paginate(5);
        }
        else{
            $transer_data = Transfer::paginate(5);
        }
        
        return view('admin.store.transfer.transfer_list',[
            'transer_data' => $transer_data,
            'search' => $search,
        ]);
    }

    function transfer_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "transer-data.$extension";
        return Excel::download(new TransferExport, $Filename, $exportFormat);
    }

    function transfer_edit($id){
        $transfer_data = Transfer::find($id);
        $companys = Company::all();
        return view('admin.store.transfer.transfer_edit',[
            'transfer_data' => $transfer_data,
            'companys'=>$companys,
        ]);
    }

    function transfer_update(Request $request){
        Transfer::find($request->id)->update([
            'company' =>$request->companys,
            'note' => $request->note,
            'transfer_date' => $request->transfer_date,
        ]);

        return redirect()->route('transfer_list');
            
    }

    function transfer_return(){
        $transfer_return = DB::select("CALL sp_transfer_return()");
        return view('admin.store.transfer.transfer_return', [
            'transfer_return' => $transfer_return,
        ]);

    }

    function transfer_return_search_id($id){
        $transfer_data = DB::select("CALL sp_transfer_return()", [$id]);

            $transfer_return_data = [
                'asset_tag' => $transfer_data[0]->asset_tag,
                'asset_type' => $transfer_data[0]->asset_type,
                'oldcompany' => $transfer_data[0]->oldcompany ,
                'company' => $transfer_data[0]->company,
                'transfer_date' => $transfer_data[0]->transfer_date,
            ];
    
            return response()->json(['data' => $transfer_return_data]);
    }

    function transfer_return_update(Request $request){
        DB::table("transfers")
        ->where(['asset_tag' => $request->asset_tag])
        ->update(['return_date' => $request->return_date]);

        return back();
    }

    //transfer end


    //maintenance start...

    function maintenance(){
        $issued_products = Store::all();
        return view('admin.store.maintenance.maintenance',[
            'issued_products'=>$issued_products,
        ]);
    }

    function maintenance_store(Request $request){
        Maintenance::insertGetId([
            'asset_tag' => $request->asset_tag,
            'asset_type' => $request->asset_type,
            'model' => $request->model,
            'purchase_date' => $request->purchase_date,
            'description' => $request->description,
            'strat_date' => $request->strat_date,
            'end_date' => $request->end_date,
            'note' => $request->note,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'vendor' => $request->vendor,
            'others' => $request->others,
            'created_at' => Carbon::now(),

        ]);
        return redirect()->route('maintenance_list');
    }

    function maintenance_list(Request $request){
        $search = $request['search'] ?? "";
        if($search != ""){
            $maintenance_data = Maintenance::where('asset_tag', 'LIKE',"%$search" )-> orwhere('asset_type', 'LIKE',"%$search")->orwhere ('vendor', 'LIKE',"%$search")->paginate(13);
        }
        else{
            $maintenance_data = Maintenance::paginate(13);
        }
        return view('admin.store.maintenance.maintenance_list',[
            'maintenance_data' => $maintenance_data,
            'search'=> $search,
        ]);
    }


    function maintenance_search_id ($store_id)
    {
        $issued_products = Maintenance::find($store_id);
        
        $issued_products_data =[
            'asset_tag' => $issued_products->asset_tag,
            'asset_type' =>$issued_products->asset_type,
            'model'=>$issued_products->model,
            'purchase_date'=>$issued_products->purchase_date,
            'asset_sl_no'=>$issued_products->asset_sl_no,  
        ];
        $issued_products = Maintenance::find($store_id);
        return response()->json(['data' => $issued_products_data]);
    }

    function maintenance_return(){
        $issued_products = DB::select("CALL sp_maintenence_issue_list()");
        $all_supplier = Supplier::all();
        return view('admin.store.maintenance.maintenance_return',[       
            'issued_products'=>$issued_products,
            'all_supplier'=>$all_supplier,
        ]);
    }


    
    function ma_return_update(Request $request){
        DB::table("maintenances")
        ->where('asset_tag', $request->asset_tag)
        ->update([
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'vendor' => $request->vendor,
        ]);

        return redirect()->route('maintenance_list');

    }


    function maintenance_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "maintenance-data.$extension";
        return Excel::download(new MaintenanceExport, $Filename, $exportFormat);
    }

    function maintenance_edit($id){
        $maintenance_data = Maintenance::find($id);
        return view('admin.store.maintenance.maintenance_edit',[
            'maintenance_data'=>$maintenance_data,
        ]);
    }

    function maintenance_update(){
        
    }
    //maintenance end...


    //wastproduct start..
    function wastproduct (){
        $issued_products = Store::all();
        return view('admin.store.wastproduct.wastproduct',[
            'issued_products'=>$issued_products,
        ]);
    }

    function wastproduct_store(Request $request){
    
        WastProduct::insertGetId([
            'asset_tag' => $request->asset_tag,
            'asset_type' => $request->asset_type,
            'model' => $request->model,
            'purchase_date' => $request->purchase_date,
            'description' => $request->description,
            'asset_sl_no' => $request->asset_sl_no,
            'date' => $request->date,
            'note' => $request->note,
            'others' => $request->others,
            'others1' => $request->others1,
            'created_at' => Carbon::now(),

        ]);
        return back();
        //return redirect()->route('admin.store.wastproduct.wastproduct');
    }

    function wastproduct_list(Request $request){
        $search = $request['search'] ?? "";
        if($search != ""){
            $wastproduct = WastProduct::where('asset_tag', 'LIKE',"%$search" )-> orwhere('asset_type', 'LIKE',"%$search")->orwhere ('date', 'LIKE',"%$search")->paginate(13);
        }
        else{
            $wastproduct = WastProduct::paginate(13);
        }      
        return view('admin.store.wastproduct.wastproduct_list',[
            'wastproduct'=>$wastproduct,
            'search'=>$search,
        ]);
    }


    function wastproduct_edit($id){
        $wastproduct = WastProduct::find($id);
        return view('admin.store.wastproduct.wastproduct_edit',[
            'wastproduct'=>$wastproduct,
        ]);
    }
    //wastproduct end..
    function wastproduct_update(Request $request){

        WastProduct::find($request->id)->update([
            'description' => $request->description,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('wastproduct_list');
    }

    function wastproduct_delete($id){
        WastProduct::find($id)->delete();
        return back();
    }

    function wastproduct_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "wastproduct-data.$extension";
        return Excel::download(new WastProductExport, $Filename, $exportFormat);
    }



}
