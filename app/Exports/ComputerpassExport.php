<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use App\Models\computer_pass;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\FromCollection;

class ComputerpassExport implements FromView,ShouldAutoSize
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
            return view('admin.password.computer_export', [
                'computer_pass' => computer_pass::where('emp_id', 'LIKE', "%$this->search")->orwhere('emp_name', 'LIKE', "%$this->search")->orwhere('asset_tag', 'LIKE', "%$this->search")->get(),
                
            ]);
        }
        else{
            return view('admin.password.computer_export', [
                'computer_pass' => computer_pass::all(),
                
            ]);
        }
        
    }
}
