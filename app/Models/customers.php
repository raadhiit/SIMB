<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'plate_number',
    ];
}
