<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use App\Models\computer_pass;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\FromCollection;

class ComputerpassExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view('admin.password.computer_export', [
            'computer_pass' => computer_pass::all(),
            
        ]);
    }
}
