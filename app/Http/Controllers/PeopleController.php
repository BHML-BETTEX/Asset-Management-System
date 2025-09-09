<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    function pepole(Request $request)
    {
        $product_types = ProductType::all();
        $departments = Department::all();
        $designation = designation::all();
        $employees = Employee::all();
        return view('admin.people.list_all', [
            'product_types' => $product_types,
            'departments' => $departments,
            'designation' => $designation,
            'employees' => $employees,
        ]);
    }

    function people_info($id)
    {
        $employee = Employee::with(['rel_to_departmet', 'rel_to_designation'])->findOrFail($id);
        return view('admin.people.people_info', compact('employee'));
    }
}
