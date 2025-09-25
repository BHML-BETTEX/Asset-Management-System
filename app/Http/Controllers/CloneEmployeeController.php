<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class CloneEmployeeController extends Controller
{
    public function cloneEmployee(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'emp_name' => 'required|string|max:255',
            'emp_id' => 'required|string|unique:employees,emp_id',
            'email' => 'nullable|email|unique:employees,email',
            'phone_number' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'company_id' => 'required|exists:companies,id',
            'join_date' => 'required|date',
            'others' => 'nullable|string',
        ]);

        try {
            // Get the original employee
            $originalEmployee = Employee::findOrFail($id);

            // Create new employee with cloned data
            $newEmployee = new Employee();
            $newEmployee->emp_name = $request->emp_name;
            $newEmployee->emp_id = $request->emp_id;
            $newEmployee->email = $request->email;
            $newEmployee->phone_number = $request->phone_number;
            $newEmployee->department_id = $request->department_id;
            $newEmployee->designation_id = $request->designation_id;
            $newEmployee->company_id = $request->company_id;
            $newEmployee->join_date = $request->join_date;
            $newEmployee->others = $request->others;
            $newEmployee->picture = 'default.png'; // Set default picture
            $newEmployee->save();

            return redirect()->route('employee_info', $newEmployee->id)
                ->with('success', 'Employee cloned successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to clone employee. Please try again.');
        }
    }
}