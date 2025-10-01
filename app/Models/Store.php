<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Store extends Model
{
    use HasFactory;
    protected $fillable = ['asset_type', 'model', 'brand_id','description', 'asset_sl_no', 'qty', 'units_id','warrenty', 'durablity', 'cost', 'currency', 'vendor', 'purchase_date', 'challan_no', 'picture', 'status_id', 'location', 'company_id', 'others'];

    function rel_to_ProductType(){
        return $this->belongsTo(ProductType::class, 'asset_type');
    }

    function rel_to_brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    function rel_to_SizeMaseurment(){
        return $this->belongsTo(SizeMaseurment::class, 'units_id');
    }

    function rel_to_Supplier(){
        return $this->belongsTo(Supplier::class, 'vendor');
    }

    function rel_to_Status(){
        return $this->belongsTo(Status::class, 'status_id');
    }

    function rel_to_Company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    function rel_to_Department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    function rel_to_Designation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    }

}
