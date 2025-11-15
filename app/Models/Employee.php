<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{

    use HasFactory;
    protected $fillable = ['emp_id', 'emp_name', 'department_id', 'designation_id', 'join_date', 'phone_number', 'email', 'others', 'picture', 'status', 'company'];

    function rel_to_departmet()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    function rel_to_designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    function rel_to_companies()
    {
        return $this->belongsTo(Company::class, 'company');
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($employee) {
        if (empty($employee->slug)) {
            $employee->slug = Str::slug($employee->name . '-' . $employee->emp_id);
        }
    });
}
}