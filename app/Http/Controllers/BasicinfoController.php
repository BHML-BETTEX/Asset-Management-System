<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicinfoController extends Controller
{
    function basic_info(){
        return view('admin/basicinfo/basicinfo');
    }


}
