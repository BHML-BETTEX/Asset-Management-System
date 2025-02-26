<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = ['asset_tag', 'asset_type', 'model', 'purchase_date', 'description', 'strat_date', 'end_date', 'note', 'amount', 'currency', 'vendor', 'others'];
}
