<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\ProductType;
use Carbon\Carbon;
use App\Exports\EmployeeDataExport;
use App\Imports\EmployeeImport;
use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    //
    function employee(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $employees = Employee::where('emp_id', 'LIKE', "%$search")->orwhere('emp_name', 'LIKE', "%$search")->orwhere('designation_id', 'LIKE', "%$search")->paginate(13);
        } else {
            $employees = Employee::paginate(13);
        }
        $product_types = ProductType::all();
        $departments = Department::all();
        $designation = designation::all();
        $company = Company::all();
        return view('admin.employee.employee_list', [
            'product_types' => $product_types,
            'departments' => $departments,
            'designation' => $designation,
            'employees' => $employees,
            'company'=> $company,
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
            'company' => $request->company,
            'created_at' => Carbon::now(),
        ]);

        if ($request->file('picture')) {
            $imageName = $employee_id . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads/employees/'), $imageName);

            Employee::where('id', $employee_id)->update([
                'picture' => $imageName,
            ]);
        }
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
        if ($request->picture == '') {
            Employee::find($request->employee_id)->update([
                'emp_id' => $request->emp_id,
                'emp_name' => $request->emp_name,
                'join_date' => $request->join_date,
                'phone_number' => $request->phone_number,
                'email' => $request->email,

            ]);
            return back();
        } else {
            $employee = Employee::find($request->employee_id);
            $delete_from = public_path('/uploads/employees/' . $employee->picture);
            if (file_exists($delete_from)) {
                unlink($delete_from);
            }

            $imageName = null;
            if ($request->file('picture')) {
                $imageName = $request->employee_id . '.' . $request->picture->extension();
                $request->picture->move(public_path('uploads/employees/'), $imageName);

                Employee::where('id', $request->employee_id)->update([
                    'picture' => $imageName,
                ]);
            }

            Employee::find($request->employee_id)->update([
                'emp_id' => $request->emp_id,
                'emp_name' => $request->emp_name,
                'join_date' => $request->join_date,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'picture' => $imageName ?? 'default.png',
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
            'email' => $employee->email,
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



    public function export(Request $request)
    {
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


        $Filename = "employee-data.$extension";
        return Excel::download(new EmployeeDataExport, $Filename, $exportFormat);
    }

    function employee_import(){
        return view('admin.employee.employee_import');
    }

    function employee_importexceldata(Request $request){
        $request->validate([
            'import_file'=>[
                'required',
                'file'
            ],
        ]);
        Excel::import(new EmployeeImport, $request->file('import_file'));

        return back()->with('import_data', 'Data Import Successfully');
    }
}
