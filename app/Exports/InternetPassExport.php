<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\InternetPassword;

class InternetPassExport implements FromView
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
        
        if($this->search != null){
            return view('admin.password.internet_export', [
                'internetPassword' => InternetPassword::where('internet_name', 'LIKE', "%$this->search")->orwhere('position', 'LIKE', "%$this->search")->orwhere('company', 'LIKE', "%$this->search")->get()
            ]);
        }

        else{
            return view('admin.password.internet_export', [
                'internetPassword' => InternetPassword::all()
            ]);
        }
        
    }
}


