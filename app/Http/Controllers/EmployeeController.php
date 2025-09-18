<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\ProductType;
use App\Models\ConsumableController;
use Carbon\Carbon;
use App\Exports\EmployeeDataExport;
use App\Imports\EmployeeImport;
use App\Models\Company;
use App\Models\consumable_issue;
use App\Models\EmployeeOtherFile;
use App\Models\issue;
use App\Models\Store;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    //
public function employee(Request $request)
{
    $role = auth()->user()->roles[0];
    $search = $request->input('search', '');
    $showAll = $request->input('show_all', false); // Add show_all check

    // Get allowed companies based on role
    $companies = [];
    if ($role->hasPermissionTo('view BHML INDUSTRIES LTD.')) $companies[] = 1;
    if ($role->hasPermissionTo('view BETTEX')) $companies[] = 2;
    if ($role->hasPermissionTo('view BETTEX PREMIUM')) $companies[] = 3;
    if ($role->hasPermissionTo('view BETTEX BRIDGE')) $companies[] = 4;

    // Build base query
    $query = Employee::whereIn('company', $companies);

    // Apply search if present
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('emp_id', 'LIKE', "%{$search}%")
              ->orWhere('emp_name', 'LIKE', "%{$search}%")
              ->orWhere('designation_id', 'LIKE', "%{$search}%");
        });
    }

    // Show all or paginate
    if ($showAll) {
        $employees = $query->get(); // All results
    } else {
        $employees = $query->paginate(13); // Paginated
    }

    $product_types = ProductType::all();
    $departments = Department::all();
    $designation = Designation::all();
    $company = Company::all();

    return view('admin.employee.employee_list', [
        'product_types' => $product_types,
        'departments' => $departments,
        'designation' => $designation,
        'employees' => $employees,
        'company' => $company,
        'search' => $search,
        'showAll' => $showAll,
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
            'others' => $request->others,
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

    //employee delete
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

    //employee update
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

    function employee_import()
    {
        return view('admin.employee.employee_import');
    }

    function employee_importexceldata(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);
        Excel::import(new EmployeeImport, $request->file('import_file'));

        return back()->with('import_data', 'Data Import Successfully');
    }

    //Employee Info
    function employee_info($id)
    {
        $employee = Employee::with(['rel_to_departmet', 'rel_to_designation'])->findOrFail($id);
        return view('admin.employee.employee_info', compact('employee'));
    }


    //Employee Asset Details
function employee_assets(Request $request, $emp_id)
{
    // Get the logged-in user's role
    $role = auth()->user()->roles[0];

    // Get search input
    $search = $request->input('search', '');

    // Find employee by emp_id column
    $employee = Employee::where('emp_id', $emp_id)->firstOrFail();

    // Base query for issues assigned to this employee
    $query = Issue::where('emp_id', $employee->emp_id);

    // Apply search if any
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q
              ->orWhere('asset_tag', 'LIKE', "%{$search}%")
              ->orWhere('asset_type', 'LIKE', "%{$search}%");
        });
    }

    // Paginate or show all (optional)
    $issues = $query->paginate(10); // Or use ->get() for all

    // Send data to view
    $stores = Store::all();
    return view('admin.employee.employee_assets', compact('issues', 'employee', 'stores', 'search'));
}
    //Employee Consumable Details
    function employee_consumable($emp_id)
    {
        $employee = Employee::where('emp_id', $emp_id)->firstOrFail();

        $consumable_issue = consumable_issue::where('emp_id', $employee->emp_id)->get();
        //$stores = Store::all();
        return view('admin.employee.employee_consumable', compact('consumable_issue', 'employee'));
    }

    //Employee File
    function employee_file($emp_id)
    {
        $employee = Employee::where('emp_id', $emp_id)->firstOrFail();
        $employee_file = EmployeeOtherFile::where('employee_id', $employee->id)->get();
        return view('admin.employee.employee_file', compact('employee', 'employee_file'));
    }

    //Employee File Uploads
    public function storeOtherFile(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:8192|mimes:avif,doc,docx,gif,ico,jpeg,jpg,json,key,lic,mov,mp3,mp4,odp,ods,odt,ogg,pdf,png,rar,rtf,svg,txt,wav,webm,webp,xls,xlsx,xml,zip',
            'note' => 'nullable|string|max:255',
        ]);

        $employee = Employee::findOrFail($id);

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $fileName = 'emp_' . $id . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('uploads/employees/others'), $fileName);

            EmployeeOtherFile::create([
                'employee_id' => $id,
                'file' => $fileName,
                'note' => $request->note,
                'created_by' => auth()->id(), // or null if no auth
            ]);

            return back()->with('successs', 'File uploaded successfully.');
        }

        return back()->withErrors(['file' => 'File upload failed.']);
    }

    //employee file delete
    public function employee_file_delete($id)
    {
        EmployeeOtherFile::findOrFail($id)->delete();
        return back()->with('delete_employee', 'File deleted successfully.');
    }
}
