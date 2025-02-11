<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public function view(): View
    {
        return view('admin.users.export', [
            'users' => User::all()
        ]);
    }
}
