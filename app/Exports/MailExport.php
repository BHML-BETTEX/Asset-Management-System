<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Mail_pass;

class MailExport implements FromView
{
    public function view(): View
    {
        return view('admin.password.mail_export', [
            'mail_pass' => Mail_pass::all()
        ]);
    }
}
