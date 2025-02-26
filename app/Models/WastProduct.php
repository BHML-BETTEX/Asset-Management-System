<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WastProduct extends Model
{
    use HasFactory;
    protected $fillable = ['asset_tag', 'asset_type', 'model','company', 'description', 'note', 'transfer_date'];

}
