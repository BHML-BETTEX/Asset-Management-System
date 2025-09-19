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
use Illuminate\Pagination\LengthAwarePaginator;


class ConsumableController extends Controller
{
    public function productdetails(Request $request)
    {
        $search = $request->input('search', '');
        $productSearch = $request->input('product_search'); // from select dropdown
        $role = auth()->user()->roles->first();

        // Map permissions to company IDs
        $permissionCompanyMap = [
            'view BHML INDUSTRIES LTD.' => 1,
            'view BETTEX' => 2,
            'view BETTEX PREMIUM' => 3,
            'view BETTEX BRIDGE' => 4,
        ];

        $companies = [];
        foreach ($permissionCompanyMap as $permission => $companyId) {
            if ($role->hasPermissionTo($permission)) {
                $companies[] = $companyId;
            }
        }

        // Default query
        $query = productdetails::whereIn('company', $companies);

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('model', 'LIKE', "%$search%")
                    ->orWhere('asset_type', 'LIKE', "%$search%");
            });
        }

        // Apply product type filter (dropdown)
        if (!empty($productSearch)) {
            $query->where('product_type', $productSearch);
            // Make sure your `productdetails` table has `product_type` column (FK)
        }

        // Fetch paginated data
        $productdetails = $query->paginate(13)->appends($request->only(['search', 'product_search']));

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
            'product_search' => $productSearch
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

public function Inventory(Request $request)
{
    $role = auth()->user()->roles->first();
    $productSearch = $request->input('product_search');
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10); // default to 10

    // Map permissions to company IDs
    $permissionCompanyMap = [
        'view BHML INDUSTRIES LTD.' => 1,
        'view BETTEX' => 2,
        'view BETTEX PREMIUM' => 3,
        'view BETTEX BRIDGE' => 4,
    ];

    $allowedCompanyIds = [];
    foreach ($permissionCompanyMap as $permission => $companyId) {
        if ($role->hasPermissionTo($permission)) {
            $allowedCompanyIds[] = $companyId;
        }
    }

    // Stored procedure result
    $results = DB::select('CALL sp_consumable_summary()');

    // Map product type and company names
    $productTypesMap = DB::table('product_types')->pluck('product', 'id');
    $companiesMap = DB::table('companies')->pluck('company', 'id');

    $collection = collect($results)->map(function ($item) use ($productTypesMap, $companiesMap) {
        $item->product_type_name = $productTypesMap[$item->asset_type] ?? 'N/A';
        $item->company_name = $companiesMap[$item->company] ?? 'N/A';
        return $item;
    });

    // Filter by company
    if (!empty($allowedCompanyIds)) {
        $collection = $collection->filter(function ($item) use ($allowedCompanyIds) {
            return in_array($item->company, $allowedCompanyIds);
        });
    }

    // Search filter
    if ($search) {
        $collection = $collection->filter(function ($item) use ($search) {
            return stripos($item->product_type_name, $search) !== false ||
                   stripos($item->model, $search) !== false ||
                   stripos($item->company_name, $search) !== false;
        });
    }

    // Filter by product type
    if ($productSearch) {
        $collection = $collection->filter(function ($item) use ($productSearch) {
            return $item->asset_type == $productSearch;
        });
    }

    // Paginate
    $currentPage = LengthAwarePaginator::resolveCurrentPage(); // ✅ fixed here
    $paginated = new LengthAwarePaginator(
        $collection->forPage($currentPage, $perPage),
        $collection->count(),
        $perPage,
        $currentPage,
        ['path' => url()->current(), 'query' => $request->query()]
    );

    return view('admin.consumable.Inventory', [
        'all_product_types' => \App\Models\ProductType::all(),
        'all_departments' => \App\Models\Department::all(),
        'all_brands' => \App\Models\Brand::all(),
        'SizeMaseurment' => \App\Models\SizeMaseurment::all(),
        'all_status' => \App\Models\Status::all(),
        'all_supplier' => \App\Models\Supplier::all(),
        'all_company' => \App\Models\Company::all(),
        'productdetails' => \App\Models\productdetails::all(),
        'products' => \App\Models\product::all(),
        'product_tem' => [], // You can add this back if needed
        'employee' => \App\Models\Employee::all(),
        'company' => \App\Models\Company::all(),
        'stocks_qty' => $paginated,
        'search' => $search,
        'product_search' => $productSearch,
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


    function consumableIssue(Request $request)
    {
        $role = auth()->user()->roles->first();

        $permissionCompanyMap = [
            'view BHML INDUSTRIES LTD.' => 1,
            'view BETTEX' => 2,
            'view BETTEX PREMIUM' => 3,
            'view BETTEX BRIDGE' => 4,

        ];

        $companies = [];

        foreach ($permissionCompanyMap as $permission => $companyName) {
            if ($role->hasPermissionTo($permission)) {
                $companies[] = $companyName;
            }
        }

        $search = $request->input('search', '');

        if (empty($companies)) {
            $issue_details = collect()->paginate(13);
        } else {
            $query = consumable_issue::whereIn('company', $companies);

            if ($search !== '') {
                $query->where('emp_name', 'LIKE', "%$search%");
            }
            $issue_details = $query->paginate(13)->appends($request->only('search'));
        }

        $all_product_types = ProductType::all();
        $all_departments = Department::all();
        $all_brands = Brand::all();
        $all_SizeMaseurment = SizeMaseurment::all();
        $all_status = Status::all();
        $all_supplier = Supplier::all();
        $all_company = Company::all();
        $productdetails = productdetails::all();
        $employee = Employee::all();

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
            'search' => $search,
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
            'emp_id' => $request->emp_id,
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
