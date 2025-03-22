<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\issue;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HistoryExport implements FromView, ShouldAutoSize
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
            return view('admin.store.history_export', [
                'issues' => issue::where('asset_tag', 'LIKE', "%$this->search%")->orwhere('asset_type', 'LIKE', "%$this->search%")->orwhere('emp_id', 'LIKE', "%$this->search%")->orwhere('emp_name', 'LIKE', "%$this->search%")->orwhere('emp_name', 'LIKE', "%$this->search%")->orwhere('others', 'LIKE', "%$this->search%")->get(),
            ]);
        }

        else{
            return view('admin.store.history_export', [
                'issues' => issue::all()
            ]);
        }
        
    }
}
