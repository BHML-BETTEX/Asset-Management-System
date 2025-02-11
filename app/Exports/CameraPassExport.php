<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Camera_pass;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class CameraPassExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view('admin.password.camera_export', [
            'Camera_pass' => Camera_pass::all(),
            
        ]);
    }
}
