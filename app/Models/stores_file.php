<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stores_file extends Model
{
    use HasFactory;
    protected $table = 'stores_files';
    protected $fillable = [
        'store_id',
        'file',
        'note',
        'created_by',
    ];
}
