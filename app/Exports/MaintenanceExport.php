<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Maintenance;

class MaintenanceExport implements FromView
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
                'maintenance' => Maintenance::where('asset_tag', 'LIKE', "%$this->search")->orwhere('asset_type', 'LIKE', "%$this->search")->orwhere('vendor', 'LIKE', "%$this->search")->orwhere('others', 'LIKE', "%$this->search")->get(),
            ]);
        }

        else{
            return view('admin.store.maintenance.maintenance_export', [
                'maintenance' => Maintenance::all(),
                
            ]);
        }

        
    }

}


