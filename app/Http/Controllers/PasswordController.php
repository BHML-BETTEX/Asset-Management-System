<?php

namespace App\Http\Controllers;

use App\Models\computer_pass;
use App\Models\mail_pass;
use App\Models\Camera_pass;
use App\Models\Company;
use App\Models\InternetPassword;
use App\Models\DingPassword;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ComputerpassExport;
use App\Exports\MailExport;
use App\Exports\CameraPassExport;
use App\Exports\InternetPassExport;
use App\Exports\DingpassExport;
use Carbon\Carbon;

class PasswordController extends Controller
{

    function computer_pass(Request $request)
    {

        $search = $request['search'] ?? "";
        if ($search != "") {
            $computer_password = computer_pass::where('emp_id', 'LIKE', "%$search")->orwhere('emp_name', 'LIKE', "%$search")->orwhere('asset_tag', 'LIKE', "%$search")->get();
        } else {
            $computer_password = computer_pass::paginate(13);
        }

        $all_company = Company::paginate(13);

        return view('admin.password.computer_pass', [
            'computer_password' => $computer_password,
            'search' => $search,
            'all_company'=>$all_company,

        ]);
    }

    function computer_pass_store(Request $request)
    {
        computer_pass::insert([
            'asset_tag' => $request->asset_tag,
            'emp_id' => $request->emp_id,
            'emp_name' => $request->emp_name,
            'company' => $request->company,
            'password' => $request->password,
            'created_at' => Carbon::now(),
            
        ]);
        return back();
    }

    function computer_pass_delete($id)
    {
        computer_pass::find($id)->delete();
        return back();
    }

    function computer_pass_edit($id){
       $com_pass_info = computer_pass::find($id);
        return view('admin.password.computer_pass_edit',[
            'com_pass_info' => $com_pass_info,
        ]);
    }

    function computer_update(Request $request){
        computer_pass::find($request->id)->update([
            'password' => $request->password,
        ]);

        return redirect()->route('computer_pass');
    }

    //Mail Password Start
    function mail_pass(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $Mail_pass = Mail_pass::where('display_name', 'LIKE', "%$search")->orwhere('mail_address', 'LIKE', "%$search")->orwhere('company', 'LIKE', "%$search")->get();
        } else {
            $Mail_pass = Mail_pass::paginate(13);
        }
        $all_company = Company::paginate(13);

        return view('admin.password.mail_pass', [
            'Mail_pass' => $Mail_pass,
            'search' => $search,
            'all_company' => $all_company,
        ]);
    }

    function mail_pass_store(Request $request)
    {
        Mail_pass::insert([
            'display_name' => $request->display_name,
            'mail_address' => $request->mail_address,
            'password' => $request->password,
            'company' => $request->company,
            'others' => $request->others,
            'others1' => $request->others1,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function mail_pass_delete($mail_id)
    {
        Mail_pass::find($mail_id)->delete();
        return back()->with("delete_mail", "Mail Info deleteed!");
    }

    function mail_pass_edit($mail_id)
    {
        $mail_info = Mail_pass::find($mail_id);
        return view('admin.password.mail_pass_edit', [
            'mail_info' => $mail_info,
        ]);
    }


    function mail_pass_update(Request $request)
    {
        
        Mail_pass::find($request->mail_id)->update([
            
            'display_name' => $request->display_name,
            'mail_address' => $request->mail_address,
            'password' => $request->password,
            'others' => $request->others,

        ]);
        return redirect()->route('mail_pass');
    }
    //mail password end.

    //camera passwor start..

    function camera_pass(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $camera_pass_info = Camera_pass::where('camera_no', 'LIKE', "%$search")->orwhere('company', 'LIKE', "%$search")->orwhere('possition', 'LIKE', "%$search")->paginate(13);
        } else {
            $camera_pass_info = Camera_pass::paginate(13);
        }

        $all_company = Company::all();
        return view('admin.password.camera_pass', [
            'camera_pass_info' => $camera_pass_info,
            'all_company' => $all_company,
            'search' => $search,
        ]);
    }

    function camera_pass_store(Request $request)
    {
        Camera_pass::insert([
            'camera_no' => $request->camera_no,
            'possition' => $request->possition,
            'password' => $request->password,
            'company' => $request->company,
            'others' => $request->others,
            'others1' => $request->others1,
            'others2' => $request->others2,
        ]);
        return back();
    }

    function camera_pass_delete($camera_id)
    {
        Camera_pass::find($camera_id)->delete();
        return back();
    }

    function camera_edit($camera_id)
    {
        $camera_info = Camera_pass::find($camera_id);
        return view('admin.password.camera_edit', [
            'camera_info' => $camera_info,
        ]);
    }

    function camera_update(Request $request)
    {
       //dd($request->all());
        Camera_pass::find($request->camera_id)->update([
            'camera_no' => $request->camera_no,
            'possition' => $request->possition,
            'password' => $request->password,
            'others' => $request->others,
        ]);

        return redirect()->route('camera_pass');
    }

    //camera password end..

    function internet_pass(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $internet_pass_info = InternetPassword::where('internet_name', 'LIKE', "%$search")->orwhere('position', 'LIKE', "%$search")->orwhere('company', 'LIKE', "%$search")->paginate(13);
        } else {
            $internet_pass_info = InternetPassword::paginate(13);
        }

        $all_company = Company::all();
        return view('admin.password.internet_pass', [
            'internet_pass_info' => $internet_pass_info,
            'all_company' => $all_company,
            'search' => $search,
        ]);
    }

    function internet_pass_store(Request $request)
    {
        InternetPassword::insert([
            'internet_name' => $request->internet_name,
            'position' => $request->position,
            'password' => $request->password,
            'company' => $request->company,
            'note' => $request->note,
            'others' => $request->others,
            'others1' => $request->others1,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function internet_pass_delete($internet_id)
    {
        InternetPassword::find($internet_id)->delete();
        return back();
    }

    function internet_edit($internet_id)
    {
        $internet_pass_info = InternetPassword::find($internet_id);
        return view('admin.password.internet_edit', [
            'internet_pass_info' => $internet_pass_info,
        ]);
    }

    function internet_update(Request $request)
    {   
        
        InternetPassword::find($request->internet_id)->update([
            'internet_name' => $request->internet_name,
            'position' => $request->position,
            'password' => $request->password,
            'note' => $request->note,
            'others' => $request->others,
            'others1' => $request->others1,
        ]);
    return redirect()->route('internet_pass');
    }



    //Internet end


    //Ding Start

    function ding_pass(Request $request)
    {

        $search = $request['search'] ?? "";
        if ($search != "") {
            $dingpass_info = DingPassword::where('display_name', 'LIKE', "%$search")->orwhere('mail_id', 'LIKE', "%$search")->orwhere('company', 'LIKE', "%$search")->paginate(13);
        } else {
            $dingpass_info = DingPassword::paginate(13);
        }
        $all_company = Company::all();

        return view('admin.password.ding_pass', [
            'dingpass_info' => $dingpass_info,
            'all_company' => $all_company,
            'search' => $search,
        ]);
    }

    function ding_pass_store(Request $request)
    {
        DingPassword::insert([
            'display_name' => $request->display_name,
            'mail_id' => $request->mail_id,
            'phone' => $request->phone,
            'password' => $request->password,
            'company' => $request->company,
            'note' => $request->note,
            'others' => $request->others,

        ]);
        return back();
    }

    function ding_pass_delete($ding_id)
    {
        DingPassword::find($ding_id)->delete();
        return back();
    }

    function ding_edit($ding_id)
    {
        $dingpass_info = DingPassword::find($ding_id);
        return view('admin.password.ding_edit', [
            'dingpass_info' => $dingpass_info,
        ]);
    }

    function ding_update(Request $request)
    {
        DingPassword::find($request->ding_id)->update([
            'display_name' => $request->display_name,
            'mail_id' => $request->mail_id,
            'phone' => $request->phone,
            'password' => $request->password,
            'note' => $request->note,
        ]);

        return redirect()->route('ding_pass');
    }

    function others_pass()
    {
        return view('admin.password.others_pass');
    }

    public function mail_export(Request $request)
    {
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "mailpass-data.$extension";
        return Excel::download(new MailExport, $Filename, $exportFormat);
    }


    function computer_pass_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "computerpass-data.$extension";
        return Excel::download(new ComputerpassExport, $Filename, $exportFormat);
    }


    function camera_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "camerapass-data.$extension";
        return Excel::download(new CameraPassExport, $Filename, $exportFormat);
    }


    function internet_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "internet-data.$extension";
        return Excel::download(new InternetPassExport, $Filename, $exportFormat);
    }

    function ding_export(Request $request){
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }


        $Filename = "ding-data.$extension";
        return Excel::download(new DingpassExport, $Filename, $exportFormat);
    }
}
