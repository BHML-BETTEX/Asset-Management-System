<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productdetails extends Model
{
    use HasFactory;
    function rel_to_ProductType(){
        return $this->belongsTo(ProductType::class, 'asset_type');
    }

    function rel_to_brand(){
        return $this->belongsTo(Brand::class, 'brand');
    }

    function rel_to_SizeMaseurment(){
        return $this->belongsTo(SizeMaseurment::class, 'units');
    }

    function rel_to_Supplier(){
        return $this->belongsTo(Supplier::class, 'vendor');
    }

    function rel_to_Status(){
        return $this->belongsTo(Status::class, 'status');
    }

    function rel_to_Company(){
        return $this->belongsTo(Company::class, 'company');
    }

    function rel_to_Department(){
        return $this->belongsTo(Department::class, 'id');
    }

    function rel_to_product(){
        return $this->belongsTo(product::class, 'model');
    }
}
