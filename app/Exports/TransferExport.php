<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Transfer;

class TransferExport implements FromView
{
    public function view(): View
    {
        return view('admin.store.transfer.transfer_export', [
            'Transfer' => Transfer::all()
        ]);
    }
}


// <?php

// namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromView;
// use Illuminate\Contracts\View\View;
// use App\Models\Store;

// class StoreExport implements FromView
// {
//     public function view(): View
//     {
//         return view('admin.store.store_export', [
//             'store' => Store::all()
//         ]);
//     }
// }
