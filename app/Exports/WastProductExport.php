<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\WastProduct;

class WastProductExport implements FromView
{
    public function view(): View
    {
        return view('admin.store.wastproduct.wastproduct_export', [
            'WastProduct' => WastProduct::all()
        ]);
    }
}

