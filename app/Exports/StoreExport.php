<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Store;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StoreExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $search;
    public function __construct($search=null)
    {
        $this->search = $search;
    }

    public function view(): View
    {
        if ($this->search != null){
            return view('admin.store.maintenance.maintenance_export', [
                'maintenance' => Store::where('products_id', 'LIKE', "%$this->search")->orwhere('brand', 'LIKE', "%$this->search")->orwhere('vendor', 'LIKE', "%$this->search")->orwhere('company', 'LIKE', "%$this->search")->orwhere('checkstatus', 'LIKE', "%$this->search")->orwhere('asset_sl_no', 'LIKE', "%$this->search")->orwhere('asset_type', 'LIKE', "%$this->search")->orwhere('asset_type', 'LIKE', "%$this->search")->get(),
            ]);
        }

        else{
            return view('admin.store.store_export', [
                'store' => Store::all(),
            ]);
        }
    }

}


