<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera_pass extends Model
{
    protected $fillable = ['camera_no', 'possition', 'password','others', 'others1', 'others2'];
    use HasFactory;
}
