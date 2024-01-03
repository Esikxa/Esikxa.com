<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayoutOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','menu_id','value','type'
    ];
}