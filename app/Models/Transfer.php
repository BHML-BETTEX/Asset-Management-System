<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = ['asset_tag', 'asset_type', 'model', 'description', 'asset_sl_no', 'transfer_date','note', 'company',  'oldcompany'];

    
    function rel_to_ProductType(){
        return $this->belongsTo(ProductType::class, 'asset_type');
    }

}
