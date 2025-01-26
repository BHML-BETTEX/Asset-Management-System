<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasFactory;
    protected $fillable = ['emp_id', 'emp_name', 'department_id','designation_id', 'join_date', 'phone_number', 'email','picture'];

    function rel_to_departmet(){
        return $this->belongsTo(Department::class, 'department_id');
    }
    
    function rel_to_designation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
