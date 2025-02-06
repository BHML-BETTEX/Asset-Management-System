<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetPassword extends Model
{
    protected $fillable = ['internet_name', 'position', 'password','note'];
    use HasFactory;
}
