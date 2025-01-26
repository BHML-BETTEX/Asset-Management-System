<?php

namespace App\Http\Controllers;

use App\Models\computer_pass;
use App\Models\mail_pass;
use App\Models\Camera_pass;
use App\Models\InternetPassword;
use App\Models\DingPassword;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    function computer_pass(){
        $computer_pass = computer_pass::all();
        return view('admin.password.computer_pass',[
            'computer_pass' => $computer_pass,
        ]);
    }

    function computer_pass_store(Request $request){
         computer_pass::insert([
            'asset_tag'=>$request->asset_tag,
            'emp_id'=>$request->emp_id,
            'emp_name'=>$request->emp_name,
            'password'=>$request->password,
        ]);
        return back();
    }

    function computer_pass_delete($id){
        computer_pass::find($id)->delete();
        return back();
    }

    function mail_pass(){
        $Mail_pass = Mail_pass::all();
        return view('admin.password.mail_pass',[
            'Mail_pass'=> $Mail_pass,
        ]);
    }

    function mail_pass_store(Request $request){
        Mail_pass::insert([
            'display_name'=>$request->display_name,
            'mail_address'=>$request->mail_address,
            'password'=>$request->password,
            'company'=>$request->company,
            'others'=>$request->others,
            'others1'=>$request->others1,
        ]);
        return back();
    }


    function camera_pass(Request $request){
        $camera_pass_info = Camera_pass::all();
        return view('admin.password.camera_pass',[
            'camera_pass_info'=>$camera_pass_info,
        ]);
    }

    function camera_pass_store(Request $request){
        Camera_pass::insert([
            'camera_no'=>$request->camera_no,
            'possition'=>$request->possition,
            'password'=>$request->password,
            'company'=>$request->company,
            'others'=>$request->others,
            'others1'=>$request->others1,
            'others2'=>$request->others2,
        ]);
        return back();
    }

    function camera_pass_delete($camera_id){
        Camera_pass::find($camera_id)->delete();
        return back();
    }

    function internet_pass(){
        $internet_pass_info = InternetPassword::all();
        return view('admin.password.internet_pass',[
            'internet_pass_info'=>$internet_pass_info,
        ]);
    }

    function internet_pass_store(Request $request){
        InternetPassword::insert([
            'internet_name'=>$request->internet_name,
            'position'=>$request->position,
            'password'=>$request->password,
            'company'=>$request->company,
            'note'=>$request->note,
            'others'=>$request->others,
            'others1'=>$request->others1,
        ]);
        return back();
    }

    function internet_pass_delete ($internet_id){
        InternetPassword::find($internet_id)->delete();
        return back();
    }

    function ding_pass(){
        $dingpass_info = DingPassword::all();
        return view('admin.password.ding_pass',[
            'dingpass_info'=>$dingpass_info,
        ]);
    }

    function ding_pass_store(Request $request){
        DingPassword::insert([
            'display_name'=>$request->display_name,
            'mail_id'=>$request->mail_id,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'company'=>$request->company,
            'note'=>$request->note,
            'others'=>$request->others,

        ]);
        return back();
    }

    function ding_pass_delete($ding_id){
        DingPassword::find($ding_id)->delete();
        return back();
    }


    function others_pass(){
        return view('admin.password.others_pass');  
    }
}
