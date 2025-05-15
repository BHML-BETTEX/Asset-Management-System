<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventory extends Model
{
    use HasFactory;
   
     function rel_to_ProductType(){
        return $this->belongsTo(ProductType::class, 'asset_type');
    }

        function rel_to_Company(){
        return $this->belongsTo(Company::class, 'company');
    }

     public static function getConsumableSummary()
    {
        return DB::select('CALL sp_consumable_summary()');
    }
}
