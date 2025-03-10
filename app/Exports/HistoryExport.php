<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\issue;

class HistoryExport implements FromView
{
    public function view(): View
    {
        return view('admin.store.history_export', [
            'issues' => issue::all()
        ]);
    }
}
