<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeDataExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view('admin.employee.export', [
            'employee' => Employee::all(),
            
        ]);
    }
}
