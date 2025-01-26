<?php

namespace App\Http\Controllers;

use App\Models\Desktop;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

class DesktopController extends Controller
{
    //
    function desktop(){        
        $product_types = ProductType::all();
        $departments = Department::all();
        $designation = designation::all();
        $desktops = Desktop::all();
        return view('admin.desktop.desktop_list',[
            'product_types'=>$product_types,
            'departments'=>$departments,
            'designation'=>$designation,
            'desktops' =>$desktops,

        ]);
    }

    function desktop_store(Request $request){
        $picture_id= Desktop::insert([
            'products_id'=>$request->products_id,
            'model_no'=>$request->model_no,
            'emp_name'=>$request->emp_name,        
            'issue_date'=>$request->issue_date,
            'created_at'=>Carbon::now()
        ]);
        // $product_picture = $request->picture;
        // $extension = $product_picture->getClientOriginalExtension();
        // $file_name = $picture_id.'.'.$extension;

        // Image::make($product_picture)->save(public_path('uploads/desktop/'.$file_name));

        // Desktop::where('id', $picture_id)->update([
        //     'picture'=>$file_name,


//        ]);

        //update Status
        $value = array('status' =>1);
 //       DB::table('stores')->where('id', $picture_id)->update($value);


        return back();
    }


//view start
    function desktop_view($desktop_id){
        $desktop_info = Desktop::find($desktop_id);
        return view('admin.desktop.view',[
            'desktop_info' => $desktop_info,
        ]);
    }

//view end
}
