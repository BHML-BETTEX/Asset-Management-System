<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\Status;
use App\Models\Color;
use App\Models\Company;
use App\Models\SizeMaseurment;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    function department()
    {
        $all_departments = Department::paginate(13);
        return view('admin.category.department', [
            'all_departments' => $all_departments,
        ]);
    }

    function department_store(Request $request)
    {
        department::insert([
            'department_name' => $request->department_name,
            'created_at' => Carbon::now(),

        ]);
        return back();
    }

    function department_delete($department_id)
    {
        department::find($department_id)->delete();
        return back()->with('delete_department', 'Department delete success');
    }

    function department_edit($department_id)
    {
        $all_departments = Department::find($department_id);
        return view('admin.category.department_edit', [
            'all_departments' => $all_departments,
        ]);
    }

    function department_update(Request $request)
    {
        Department::find($request->department_id)->update([
            'department_name' => $request->department_name,
        ]);
        return redirect('department')->with('category_update', 'Category Update Successfull');
    }



    //designation
    function designation()
    {
        $all_designations = Designation::paginate(13);
        return view('admin.category.designation', [
            'all_designations' => $all_designations,
        ]);
    }

    function designation_store(Request $request)
    {
        designation::insert([
            'designation_name' => $request->designation_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function designation_delete($designation_id)
    {
        designation::find($designation_id)->delete();
        return back()->with('delete_designation', 'Designation delete success');
    }

    function designation_edit($designation_id)
    {
        $designation =  Designation::find($designation_id);
        return view('admin.category.designation_edit', [
            'designation' => $designation,
        ]);
    }

    function designation_update(Request $request)
    {
        Designation::find($request->designation_id)->update([
            'designation_name' => $request->designation_name,
        ]);
        return redirect('designation')->with('designation_update', 'Designation Update Successfull');
    }

    //product Type
    function product_type()
    {
        $all_producttypes = ProductType::paginate(13);
        return view('admin.category.producttype.producttype_list', [
            'all_producttypes' => $all_producttypes,
        ]);
    }

    function product_type_store(Request $request)
    {
        ProductType::insert([
            'product' => $request->product,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function product_type_delete($ProductType_id)
    {
        ProductType::find($ProductType_id)->delete();
        return back()->with('delete_producttype', 'ProductType delete success');
    }

    // Supplier
    function supplier()
    {
        $all_supplier = Supplier::paginate(13);
        return view('admin.category.supplier', [
            'all_supplier' => $all_supplier,
        ]);
    }

    function supplier_store(Request $request)
    {
        Supplier::insert([
            'supplier_name' => $request->supplier_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'web' => $request->web,
            'others1' => $request->others1,
            'others2' => $request->others2,
        ]);
        return back()->with('suppler_add', 'Supplier add successful');
    }

    function supplier_delete($supplier_id)
    {
        Supplier::find($supplier_id)->delete();
        return back()->with('delete_supplier', 'Supplier delete success');
    }



    //brand
    function brand()
    {
        $all_brand = Brand::paginate(13);
        return view('admin.category.brand.brand', [
            'all_brand' => $all_brand,
        ]);
    }

    function brand_store(Request $request)
    {
        Brand::insert([
            'brand_name' => $request->brand_name,
            'others' => $request->others,
        ]);
        return back()->with('');
    }

    function brand_delete($brand_id)
    {
        Brand::find($brand_id)->delete();
        return back()->with('brand_delete', 'brand delete success');
    }

    //status
    function status()
    {
        $all_status = Status::paginate(13);
        return view('admin.category.status.status', [
            'all_status' => $all_status,
        ]);
    }

    function status_store(Request $request)
    {
        Status::insert([
            'status_name' => $request->status_name,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('status_delete', 'status added');
    }

    function status_delete($status_id)
    {
        Status::find($status_id)->delete();
        return back()->with('status_delete', 'status delete success');
    }

    //size_mesurment
    function size_mesurment()
    {
        $all_SizeMaseurment = SizeMaseurment::paginate(13);
        return view('admin.category.size_mesurment.size', [
            'all_SizeMaseurment' => $all_SizeMaseurment,
        ]);
    }

    function size_mesurment_store(Request $request)
    {
        SizeMaseurment::insert([
            'size' => $request->size,
            'description' => $request->description,
        ]);
        return back()->with('size_added', 'Size added');
    }

    function size_mesurment_delete($sizemesurment_id)
    {
        SizeMaseurment::find($sizemesurment_id)->delete();
        return back()->with('size_delete', 'Size delete success');
    }

    //color
    function color()
    {
        $all_color = Color::paginate(13);
        return view('admin.category.color.color', [
            'all_color' => $all_color,
        ]);
    }

    function color_store(Request $request)
    {
        Color::insert([
            'color' => $request->color,
            'description' => $request->description,
        ]);
        return back()->with('color_added', 'color added');
    }

    function color_delete($color_id)
    {
        Color::find($color_id)->delete();
        return back()->with('color_delte', 'Color delete success');
    }

    //company
    function company_list()
    {
        $all_company = Company::paginate(13);
        return view('admin.category.company.company', [
            'all_company' => $all_company,
        ]);
    }

    function company_store(Request $request)
    {
        Company::insert([
            'company' => $request->company,
            'description' => $request->description,
            'location' => $request->location,
        ]);
        return back()->with('company_added', 'Company delete success');
    }

    function company_delete($company_id)
    {
        Company::find($company_id)->delete();
        return back()->with('comapny_delete', 'Company delete success');
    }


    function search_by_id($company_id)
    {
        $company = Company::find($company_id);
        $company_data = [
            'id' => $company->id,
            'company' => $company->company,
            'description' => $company->description,
        ];
        $company = Company::find($company_id);
        return response()->json(['data' => $company_data]);
    }


    //Department Asset
    public function departments_asset($department_id)
    {
        $employees = DB::table('employee_asset_summary')
            ->where('department_id', $department_id)
            ->get();
        
        return view('admin.department_asset', ['employees' => $employees]);
    }
}
