<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\DingPassword;

class DingpassExport implements FromView
{
    public function view(): View
    {
        return view('admin.password.ding_export', [
            'DingPassword' => DingPassword::all()
        ]);
    }
}



