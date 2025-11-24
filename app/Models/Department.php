<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable  = ['department_name'];

    function rel_to_user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    function rel_to_Company(){
        return $this->belongsTo(Company::class, 'company');
    }

   
}