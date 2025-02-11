<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\InternetPassword;

class InternetPassExport implements FromView
{
    public function view(): View
    {
        return view('admin.password.internet_export', [
            'internetPassword' => InternetPassword::all()
        ]);
    }
}


