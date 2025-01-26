<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\DB;



class EmployeeController extends Controller
{
    //
    function employee(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""){
            $employees = Employee::where('emp_id', 'LIKE',"%$search" )-> orwhere('emp_name', 'LIKE',"%$search")->orwhere ('designation_id', 'LIKE',"%$search")->get();
        }
        else{
            $employees = Employee::all();
        }
        $product_types = ProductType::all();
        $departments = Department::all();
        $designation = designation::all();
        return view('admin.employee.employee_list', [
            'product_types' => $product_types,
            'departments' => $departments,
            'designation' => $designation,
            'employees' => $employees,
            'search' => $search,
        ]);
    }
    function employee_store(Request $request)
    {
        $employee_id = Employee::insertGetId([
            'emp_id' => $request->emp_id,
            'emp_name' => $request->emp_name,
            'department_id' => $request->department_id,
            'designation_id' => $request->designation_id,
            'join_date' => $request->join_date,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'created_at' => Carbon::now(),
        ]);
        $picture_id = $request->picture;
        $extension = $picture_id->getClientOriginalExtension();
        $file_name = $employee_id . '.' . $extension;
        Image::make($picture_id)->save(public_path('uploads/employees/' . $file_name));
        Employee::where('id', $employee_id)->update([
            'picture' => $file_name,
        ]);
        return back();
    }

    function employee_delete($employee_id)
    {
        Employee::find($employee_id)->delete();
        return back()->with('delete_employee', 'Employee delete success');
    }

    function employee_edit($employee_id)
    {
        $departments = Department::all();
        $designation = designation::all();
        $employees_info = Employee::find($employee_id);
        return view('admin.employee.employee_edit', [
            'employees_info' => $employees_info,
            'departments' => $departments,
            'designation' => $designation,
        ]);
    }

    function employee_update(Request $request)
    {
       if($request->picture ==''){
        Employee::find($request->employee_id)->update([
            'emp_id' => $request->emp_id,
            'emp_name' => $request->emp_name,
            'join_date' => $request->join_date,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
        return back();
       }
       else {
        $image = Employee::find($request->employee_id);
        $delete_from = public_path('/uploads/employees/' . $image->picture);
        unlink($delete_from);

        $picture_info = $request->picture;
        $extension = $picture_info->getClientOriginalExtension();
        $file_name = $request->employee_id .'.'.$extension;
        Image::make($picture_info)->save(public_path('uploads/employees/' . $file_name));
        
        Employee::find($request->employee_id)->update([
            'emp_id' => $request->emp_id,
            'emp_name' => $request->emp_name,
            'join_date' => $request->join_date,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'picture'=>$file_name,
        ]);
        return back();
    }
}


    //Edit end

    //autofill start
    function search_by_id($employee_id)
    {
        $employee = Employee::find($employee_id);
        $employee_data = [
            'emp_id' => $employee->emp_id,
            'emp_name' => $employee->emp_name,
            'phone_number' => $employee->phone_number,
            'designation_id' => $employee->rel_to_designation->designation_name,
            'department_id' => $employee->rel_to_departmet->department_name,
            'department_id' => $employee->rel_to_departmet->department_name,
            'phone_number' => $employee->phone_number,
            'email' => $employee-> email,
        ];
        $employee = Employee::find($employee_id);
        return response()->json(['data' => $employee_data]);
    }
    //autofill end


    //List Search
//    function search(Request $request)
//     {
        
//         $data = $request->input('search');
//         $all_employees = DB::table('employees')->where('emp_id', 'LIKE', '%' . $data . '%')
//         ->orwhere('emp_name', 'LIKE', '%' . $data . '%')
//         ->get();



//         return view ('employee_list',  compact('all_employees'));
//     }

    



}
