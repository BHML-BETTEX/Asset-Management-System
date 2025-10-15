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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function cloneEmployee(Request $request, $id)
    {
        $request->validate([
            'emp_name' => 'required|string|max:255',
            'emp_id' => 'required|string|max:255|unique:employees',
            'email' => 'nullable|email|max:255|unique:employees',
            'phone_number' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'nullable|exists:designations,id',
            'company' => 'required|exists:companies,id',
            'join_date' => 'required|date',
            'others' => 'nullable|string'
        ]);

        try {
            // Find the original employee
            $originalEmployee = Employee::findOrFail($id);

            // Create new employee with validated data
            $newEmployee = new Employee();
            $newEmployee->emp_name = $request->emp_name;
            $newEmployee->emp_id = $request->emp_id;
            $newEmployee->email = $request->email;
            $newEmployee->phone_number = $request->phone_number;
            $newEmployee->department_id = $request->department_id;
            $newEmployee->designation_id = $request->designation_id;
            $newEmployee->company = $request->company;
            $newEmployee->join_date = $request->join_date;
            $newEmployee->others = $request->others;

            // Copy other relevant fields from original employee
            $newEmployee->status = $originalEmployee->status;
            // Save the new employee
            $newEmployee->save();

            return redirect()->route('employee_info', $newEmployee->id)
                ->with('success', 'Employee cloned successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error cloning employee: ' . $e->getMessage());
        }
    }
    //Employee
    public function employee_list(Request $request)
    {
        $role = auth()->user()->roles[0];
        $search = $request->input('search', '');
        $perPage = $request->input('per_page', 10);
        $showAll = $request->input('show_all', false);

        // Get filter parameters
        $departmentFilter = $request->input('department_filter', '');
        $designationFilter = $request->input('designation_filter', '');
        $companyFilter = $request->input('company_filter', '');
        $joinDateFrom = $request->input('join_date_from', '');
        $joinDateTo = $request->input('join_date_to', '');
        $hasPicture = $request->input('has_picture', '');
        $sortBy = $request->input('sort_by', 'emp_id');

        // Get allowed companies based on role
        $companies = [];
        if ($role->hasPermissionTo('view BHML INDUSTRIES LTD.')) $companies[] = 1;
        if ($role->hasPermissionTo('view BETTEX')) $companies[] = 2;
        if ($role->hasPermissionTo('view BETTEX PREMIUM')) $companies[] = 3;
        if ($role->hasPermissionTo('view BETTEX BRIDGE')) $companies[] = 4;

        // Base query with filters
        $query = Employee::whereIn('company', $companies);

        // Apply filters & search (same logic)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('emp_id', 'LIKE', "%{$search}%")
                    ->orWhere('emp_name', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($departmentFilter)) $query->where('department_id', $departmentFilter);
        if (!empty($designationFilter)) $query->where('designation_id', $designationFilter);
        if (!empty($companyFilter)) $query->where('company', $companyFilter);
        if (!empty($joinDateFrom)) $query->whereDate('join_date', '>=', $joinDateFrom);
        if (!empty($joinDateTo)) $query->whereDate('join_date', '<=', $joinDateTo);
        if ($hasPicture === 'yes') {
            $query->whereNotNull('picture')->where('picture', '!=', '')->where('picture', '!=', 'default.png');
        } elseif ($hasPicture === 'no') {
            $query->where(function ($q) {
                $q->whereNull('picture')->orWhere('picture', '')->orWhere('picture', 'default.png');
            });
        }

        // Sorting
        switch ($sortBy) {
            case 'emp_name':
                $query->orderBy('emp_name', 'asc');
                break;
            case 'join_date':
                $query->orderBy('join_date', 'desc');
                break;
            case 'created_at':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('emp_id', 'asc');
                break;
        }

        // 👇 Split into active/inactive
        $activeEmployees = (clone $query)->where('status', 'Active');
        $inactiveEmployees = (clone $query)->where('status', 'In-Active');

        if ($showAll || $perPage === 'all') {
            $employees_active = $activeEmployees->get();
            $employees_inactive = $inactiveEmployees->get();
        } else {
            $employees_active = $activeEmployees->paginate((int)$perPage)->appends($request->all());
            $employees_inactive = $inactiveEmployees->paginate((int)$perPage, ['*'], 'inactive_page')->appends($request->all());
        }

        return view('admin.employee.employee_list', [
            'departments' => Department::all(),
            'designation' => Designation::all(),
            'employees_active' => $employees_active,
            'employees_inactive' => $employees_inactive,
            'company' => Company::all(),
            'search' => $search,
            'perPage' => $perPage,
            'showAll' => $showAll,
        ]);
    }

    public function inactive_list(Request $request)
    {
        $role = auth()->user()->roles[0];
        $search = $request->input('search', '');
        $perPage = $request->input('per_page', 10);
        $showAll = $request->input('show_all', false);

        // Get filter parameters
        $departmentFilter = $request->input('department_filter', '');
        $designationFilter = $request->input('designation_filter', '');
        $companyFilter = $request->input('company_filter', '');
        $joinDateFrom = $request->input('join_date_from', '');
        $joinDateTo = $request->input('join_date_to', '');
        $hasPicture = $request->input('has_picture', '');
        $sortBy = $request->input('sort_by', 'emp_id');

        // Get allowed companies based on role
        $companies = [];
        if ($role->hasPermissionTo('view BHML INDUSTRIES LTD.')) $companies[] = 1;
        if ($role->hasPermissionTo('view BETTEX')) $companies[] = 2;
        if ($role->hasPermissionTo('view BETTEX PREMIUM')) $companies[] = 3;
        if ($role->hasPermissionTo('view BETTEX BRIDGE')) $companies[] = 4;

        // Base query with filters
        $query = Employee::whereIn('company', $companies);

        // Apply filters & search (same logic)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('emp_id', 'LIKE', "%{$search}%")
                    ->orWhere('emp_name', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($departmentFilter)) $query->where('department_id', $departmentFilter);
        if (!empty($designationFilter)) $query->where('designation_id', $designationFilter);
        if (!empty($companyFilter)) $query->where('company', $companyFilter);
        if (!empty($joinDateFrom)) $query->whereDate('join_date', '>=', $joinDateFrom);
        if (!empty($joinDateTo)) $query->whereDate('join_date', '<=', $joinDateTo);
        if ($hasPicture === 'yes') {
            $query->whereNotNull('picture')->where('picture', '!=', '')->where('picture', '!=', 'default.png');
        } elseif ($hasPicture === 'no') {
            $query->where(function ($q) {
                $q->whereNull('picture')->orWhere('picture', '')->orWhere('picture', 'default.png');
            });
        }

        // Sorting
        switch ($sortBy) {
            case 'emp_name':
                $query->orderBy('emp_name', 'asc');
                break;
            case 'join_date':
                $query->orderBy('join_date', 'desc');
                break;
            case 'created_at':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('emp_id', 'asc');
                break;
        }

        // Filter by In Active status
        $employees = $query->where('status', 'inactive');

        if ($showAll || $perPage === 'all') {
            $employees_inactive = $employees->get();
        } else {
            $employees_inactive = $employees->paginate((int)$perPage)->appends($request->all());
        }

        return view('admin.employee.delete_list', [
            'departments' => Department::all(),
            'designation' => Designation::all(),
            'employees_inactive' => $employees_inactive,
            'company' => Company::all(),
            'search' => $search,
            'perPage' => $perPage,
            'showAll' => $showAll,
        ]);
    }

    public function delete_list(Request $request)
    {
        $role = auth()->user()->roles[0];
        $search = $request->input('search', '');
        $perPage = $request->input('per_page', 10);
        $showAll = $request->input('show_all', false);

        // Get filter parameters
        $departmentFilter = $request->input('department_filter', '');
        $designationFilter = $request->input('designation_filter', '');
        $companyFilter = $request->input('company_filter', '');
        $joinDateFrom = $request->input('join_date_from', '');
        $joinDateTo = $request->input('join_date_to', '');
        $hasPicture = $request->input('has_picture', '');
        $sortBy = $request->input('sort_by', 'emp_id');

        // Get allowed companies based on role
        $companies = [];
        if ($role->hasPermissionTo('view BHML INDUSTRIES LTD.')) $companies[] = 1;
        if ($role->hasPermissionTo('view BETTEX')) $companies[] = 2;
        if ($role->hasPermissionTo('view BETTEX PREMIUM')) $companies[] = 3;
        if ($role->hasPermissionTo('view BETTEX BRIDGE')) $companies[] = 4;

        // Base query with filters
        $query = Employee::whereIn('company', $companies);

        // Apply filters & search (same logic)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('emp_id', 'LIKE', "%{$search}%")
                    ->orWhere('emp_name', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($departmentFilter)) $query->where('department_id', $departmentFilter);
        if (!empty($designationFilter)) $query->where('designation_id', $designationFilter);
        if (!empty($companyFilter)) $query->where('company', $companyFilter);
        if (!empty($joinDateFrom)) $query->whereDate('join_date', '>=', $joinDateFrom);
        if (!empty($joinDateTo)) $query->whereDate('join_date', '<=', $joinDateTo);
        if ($hasPicture === 'yes') {
            $query->whereNotNull('picture')->where('picture', '!=', '')->where('picture', '!=', 'default.png');
        } elseif ($hasPicture === 'no') {
            $query->where(function ($q) {
                $q->whereNull('picture')->orWhere('picture', '')->orWhere('picture', 'default.png');
            });
        }

        // Sorting
        switch ($sortBy) {
            case 'emp_name':
                $query->orderBy('emp_name', 'asc');
                break;
            case 'join_date':
                $query->orderBy('join_date', 'desc');
                break;
            case 'created_at':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('emp_id', 'asc');
                break;
        }

        // Filter by Delete Active status
        $employees = $query->where('status', 'Delete');

        if ($showAll || $perPage === 'all') {
            $employees_inactive = $employees->get();
        } else {
            $employees_inactive = $employees->paginate((int)$perPage)->appends($request->all());
        }

        return view('admin.employee.delete_list', [
            'departments' => Department::all(),
            'designation' => Designation::all(),
            'employees_inactive' => $employees_inactive,
            'company' => Company::all(),
            'search' => $search,
            'perPage' => $perPage,
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
            'status' => $request->status,
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

    //employee edit
    public function employee_edit($id)
    {
        $employees_info = Employee::findOrFail($id);
        $departments = Department::all();
        $designation = Designation::all();
        $companies = Company::all();

        return view('admin.employee.employee_edit', compact('employees_info', 'departments', 'designation', 'companies'));
    }

    //employee delete
    public function employee_delete($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->status = 'Delete';
            $employee->save();

            return redirect()->back()->with('success', 'Employee status changed to inactive successfully.');
        }

        return redirect()->back()->with('error', 'Employee not found.');
    }


    // employee update
    function employee_update(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);

        // Handle image upload
        $imageName = $employee->picture;

        if ($request->hasFile('picture')) {
            // Delete old image
            $oldPath = public_path('uploads/employees/' . $employee->picture);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload new image
            $imageName = $request->employee_id . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads/employees/'), $imageName);
        }

        // Update employee data
        $employee->update([
            'emp_id' => $request->emp_id,
            'emp_name' => $request->emp_name,
            'join_date' => $request->join_date,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'picture' => $imageName ?? 'default.png',
            'department_id' => $request->department_id,
            'designation_id' => $request->designation_id,
            'company' => $request->company,
            'status' => $request->status,
        ]);

        // Redirect with SweetAlert
        return redirect()
            ->route('employee_list')
            ->with('employee_update', 'Employee updated successfully!');
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
        // Get data for clone modal
        $departments = Department::all();
        $designation = Designation::all();
        $companies = Company::all();
        $totalIssues = Issue::where('emp_id', $employee->emp_id)->count();

        return view('admin.employee.employee_info', compact('employee', 'departments', 'designation', 'companies', 'totalIssues'));
    }


    //Employee Asset Details
    function employee_assets(Request $request, $emp_id)
    {
        $role = auth()->user()->roles[0];
        $search = $request->input('search', '');
        $employee = Employee::where('emp_id', $emp_id)->firstOrFail();
        $query = issue::where('emp_id', $employee->emp_id);
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

    //employee asset pdf download
   public function history_generatePDF(Request $request, $emp_id)
{
    $search = $request->input('search', '');

    // Get the specific employee with relationships
    $employee = Employee::with(['rel_to_departmet', 'rel_to_designation', 'rel_to_companies'])
        ->where('emp_id', $emp_id)->firstOrFail();

    // Search issues based on multiple fields but only for this specific employee
    $issue_info = issue::where('emp_id', $emp_id)
        ->where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('asset_tag', 'LIKE', "%$search%")
                    ->orWhere('asset_type', 'LIKE', "%$search%")
                    ->orWhere('others', 'LIKE', "%$search%");
            }
        })->get();

    // Get store info related to each issue for this employee
    $store_info = Store::whereIn('asset_tag', $issue_info->pluck('asset_tag'))
        ->select('asset_tag', 'asset_type', 'model', 'brand_id', 'description', 'asset_sl_no', 'qty', 'units_id', 'picture')
        ->get();

    // Prepare data for PDF
    $data = [
        'title' => 'Employee Asset History - ' . $employee->emp_name,
        'company' => 'BETTEX HK Ltd',
        'date' => now()->format('Y-m-d'),
        'issue_info' => $issue_info,
        'store_info' => $store_info,
        'employee' => $employee,
    ];

    // Load view and generate PDF
    $pdf = Pdf::loadView('admin.employee.pdf_history', $data)
        ->setPaper('a4', 'portrait');

    // Download or stream PDF with employee-specific filename
    return $pdf->download('employee_assets_' . $employee->emp_id . '.pdf');
}

    //employee selected assets pdf download
   public function history_generatePDF_selected(Request $request, $emp_id)
{
    $search = $request->input('search', '');
    $selected_assets = $request->input('selected_assets', []);

    // Validate that assets are selected
    if (empty($selected_assets)) {
        return redirect()->back()->with('error', 'No assets selected for export.');
    }

    // Get the specific employee with relationships
    $employee = Employee::with(['rel_to_departmet', 'rel_to_designation', 'rel_to_companies'])
        ->where('emp_id', $emp_id)->firstOrFail();

    // Get only selected issues for this specific employee
    $issue_info = issue::where('emp_id', $emp_id)
        ->whereIn('asset_tag', $selected_assets)
        ->where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('asset_tag', 'LIKE', "%$search%")
                    ->orWhere('asset_type', 'LIKE', "%$search%")
                    ->orWhere('others', 'LIKE', "%$search%");
            }
        })->get();

    // Get store info related to selected issues
    $store_info = Store::whereIn('asset_tag', $selected_assets)
        ->select('asset_tag', 'asset_type', 'model', 'brand_id', 'description', 'asset_sl_no', 'qty', 'units_id', 'picture')
        ->get();

    // Prepare data for PDF
    $data = [
        'title' => 'Selected Employee Assets - ' . $employee->emp_name . ' (' . count($selected_assets) . ' items)',
        'company' => 'BETTEX HK Ltd',
        'date' => now()->format('Y-m-d'),
        'issue_info' => $issue_info,
        'store_info' => $store_info,
        'employee' => $employee,
    ];

    // Load view and generate PDF
    $pdf = Pdf::loadView('admin.employee.pdf_history', $data)
        ->setPaper('a4', 'portrait');

    // Download or stream PDF with employee-specific filename
    return $pdf->download('employee_selected_assets_' . $employee->emp_id . '_' . count($selected_assets) . '_items.pdf');
}

    




    //Employee Consumable Details
    function employee_consumable(Request $request, $emp_id)
    {
        $search = $request->input('search', '');
        $employee = Employee::where('emp_id', $emp_id)->firstOrFail();
        $query = consumable_issue::where('emp_id', $employee->emp_id);
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('product_type', 'LIKE', "%{$search}%")
                    ->orWhere('model_id', 'LIKE', "%{$search}%")
                    ->orWhere('emp_id', 'LIKE', "%{$search}%")
                    ->orWhere('company', 'LIKE', "%{$search}%")
                    ->orWhere('emp_name', 'LIKE', "%{$search}%");
            });
        }

        // Paginate results
        $consumable_issue = $query->paginate(13)->appends(['search' => $search]);

        return view('admin.employee.employee_consumable', compact('consumable_issue', 'employee', 'search'));
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
