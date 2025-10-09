<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    use HasFactory;
    function rel_to_ProductType()
    {
        return $this->belongsTo(ProductType::class, 'asset_type');
    }

    function rel_to_brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    function rel_to_Company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
