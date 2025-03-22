<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Transfer;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransferExport implements FromView, ShouldAutoSize
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
            return view('admin.store.transfer.transfer_export', [
                'Transfer' => Transfer::where('asset_tag', 'LIKE', "%$this->search")->orwhere('asset_type', 'LIKE', "%$this->search")->orwhere('company', 'LIKE', "%$this->search")->get(),
            ]);
        }

        else{
            return view('admin.store.transfer.transfer_export', [
                'Transfer' => Transfer::all()
            ]);
        }

    }
}

