<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\DingPassword;

class DingpassExport implements FromView
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
            return view('admin.password.ding_export', [
                'DingPassword' => DingPassword::where('display_name', 'LIKE', "%$this->search")->orwhere('mail_id', 'LIKE', "%$this->search")->orwhere('company', 'LIKE', "%$this->search")->get()
            ]);
        }
        else{
            return view('admin.password.ding_export', [
                'DingPassword' => DingPassword::all()
            ]);
        }
        
    }
}



