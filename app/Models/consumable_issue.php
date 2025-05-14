<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consumable_issue extends Model
{
    use HasFactory;
    function rel_to_ProductType(){
        return $this->belongsTo(ProductType::class, 'product_type');
    }
    function rel_to_SizeMaseurment(){
        return $this->belongsTo(SizeMaseurment::class, 'units_id');
    }

    function rel_to_Company(){
        return $this->belongsTo(Company::class, 'company');
    }

    function rel_to_Department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    function rel_to_Employee(){
        return $this->belongsTo(Employee::class, 'emp_id');
    }


}
