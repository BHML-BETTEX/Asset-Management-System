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
use App\Models\consumable_issue;
use App\Models\product;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ConsumableController extends Controller
{
    public function productdetails(Request $request)
    {
        $role = auth()->user()->roles->first();

        $permissionCompanyMap = [
            'view BHML INDUSTRIES LTD.' => 1,
            'view BETTEX' => 2,
            'view BETTEX PREMIUM' => 3,
        ];

        $companies = [];

        foreach ($permissionCompanyMap as $permission => $companyName) {
            if ($role->hasPermissionTo($permission)) {
                $companies[] = $companyName;
            }
        }

        $search = $request->input('search', '');

        if (empty($companies)) {
            $productdetails = collect()->paginate(13);
        } else {
            $query = productdetails::whereIn('company', $companies);

            if ($search !== '') {
                $query->where('model', 'LIKE', "%$search%");
            }

            $productdetails = $query->paginate(13)->appends($request->only('search'));
        }

        return view('admin.consumable.productdetails', [
            'all_product_types' => ProductType::all(),
            'all_departments' => Department::all(),
            'all_brands' => Brand::all(),
            'all_SizeMaseurment' => SizeMaseurment::all(),
            'all_status' => Status::all(),
            'all_supplier' => Supplier::all(),
            'all_company' => Company::all(),
            'productdetails' => $productdetails,
            'products' => product::all(),
            'search' => $search,
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

    function productdetails_delete($id)
    {
        productdetails::find($id)->delete();
        return redirect()->back()->with('product_delete', 'Product deleted...!');
    }

    function Inventory()
    {


        $product = DB::select("select asset_type,  model,sum(qty) As In_qty FROM productdetails
     GROUP BY asset_type, model;");
        $product_tem = [];
        foreach ($product as $item) {

            $product_out = DB::select("select model_id, sum(issue_qty) As out_qty FROM consumable_issues where model_id = '$item->model'
    GROUP BY model_id;");
            $item->out = count($product_out) > 0 ? $product_out[0]->out_qty : 0;
            $product_tem[] = $item;
        }

        // Get product types as an associative array: [id => product name]
        $productTypes = DB::table('product_types')->pluck('product', 'id'); // 'product' is the field you want
        $company = DB::table('companies')->pluck('company', 'id'); // 'product' is the field you want
        $results = DB::select('CALL sp_consumable_summary()');

        // Convert array to Laravel Collection to filter
        // Map the product name to each item in the collection
        $collection = collect($results)->map(function ($item) use ($productTypes, $company) {
            $item->product_type_name = $productTypes[$item->asset_type] ?? 'N/A';
            $item->company_name = $company[$item->company] ?? 'N/A';
            return $item;
        });
        $all_product_types = ProductType::all();
        $all_departments = Department::all();
        $all_brands = Brand::all();
        $SizeMaseurment = SizeMaseurment::all();
        $all_status = Status::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        $productdetails = productdetails::all();
        $products = product::all();
        $employee = employee::all();
        $company = Company::all();
        return view('admin.consumable.Inventory', [
            'all_product_types' => $all_product_types,
            'all_departments' => $all_departments,
            'all_brands' => $all_brands,
            'SizeMaseurment' => $SizeMaseurment,
            'all_status' => $all_status,
            'all_supplier' => $all_supplier,
            'all_company' => $all_company,
            'productdetails' => $productdetails,
            'products' => $products,
            'product_tem' => $product_tem,
            'employee' => $employee,
            'company' => $company,
            'stocks_qty' => $collection,
        ]);
    }

    function getStockQty(Request $request)
    {
        $company = $request->company;
        $model = $request->model;

        // Call the stored procedure
        $results = DB::select('CALL sp_consumable_summary()');

        // Convert array to Laravel Collection to filter
        $collection = collect($results);

        // Filter by company and model
        $stocks_qty  = $collection->where('company', $company)
            ->where('model', $model)
            ->first();

        return response()->json(['qty' => $stocks_qty->balance ?? 0]);
    }


    function consumableIssue()
    {
        $role = auth()->user()->roles[0];

        // Get allowed companies based on role
        $companies = [];
        if ($role->hasPermissionTo('view BHML INDUSTRIES LTD.')) array_push($companies, 1);
        if ($role->hasPermissionTo('view BETTEX')) array_push($companies, 2);
        if ($role->hasPermissionTo('view BETTEX PREMIUM')) array_push($companies, 3);



        $all_product_types = ProductType::all();
        $all_departments = Department::all();
        $all_brands = Brand::all();
        $all_SizeMaseurment = SizeMaseurment::all();
        $all_status = Status::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        $productdetails = productdetails::all();
        $employee = Employee::all();
        $issue_details = consumable_issue::all();
        $products = product::all();
        return view('admin.consumable.consumableIssue', [
            'all_product_types' => $all_product_types,
            'all_departments' => $all_departments,
            'all_brands' => $all_brands,
            'all_SizeMaseurment' => $all_SizeMaseurment,
            'all_status' => $all_status,
            'all_supplier' => $all_supplier,
            'all_company' => $all_company,
            'productdetails' => $productdetails,
            'employee' => $employee,
            'issue_details' => $issue_details,
            'products' => $products,

        ]);
    }

    function consumableIssue_store(Request $request)
    {
        consumable_issue::insert([
            'issue_date' => $request->issue_date,
            'product_type' => $request->product_type,
            'model_id' => $request->model_id,
            'issue_qty' => $request->issue_qty,
            'units_id' => $request->units_id,
            'emp_name' => $request->emp_name,
            'department_id' => $request->department_id,
            'company' => $request->company,
            'others' => $request->others,
            'others1' => $request->others1,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('issued_success', 'Product issued...!');
    }

    function consumableIssue_delete($id)
    {
        consumable_issue::find($id)->delete();
        return redirect()->back()->with('item_delete', 'Item deleted...!');
    }

    function product()
    {
        $all_product_types = ProductType::all();
        return view('admin.consumable.product', [
            'all_product_types' => $all_product_types,
        ]);
    }

    function product_store(Request $request)
    {
        product::insert([
            'product_type' => $request->product_type,
            'product_model' => $request->product_model,
            'sefty_stock' => $request->sefty_stock,
            'p_lead_time' => $request->p_lead_time,
            'notes' => $request->notes,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
