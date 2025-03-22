<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Camera_pass;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class CameraPassExport implements FromView,ShouldAutoSize
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
            return view('admin.password.camera_export', [
                'Camera_pass' => Camera_pass::where('camera_no', 'LIKE', "%$this->search")->orwhere('company', 'LIKE', "%$this->search")->orwhere('possition', 'LIKE', "%$this->search")->get(),
                
            ]);
        }
        else{
            return view('admin.password.camera_export', [
                'Camera_pass' => Camera_pass::all(),
                
            ]);
        }
        
    }
}
