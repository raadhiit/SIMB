<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'service_id',
        'service_date',
        'status',
        'total',
    ];

    public function customer()
    {
        return $this->belongsTo(customers::class);
    }

    public function service()
    {
        return $this->belongsTo(services::class);
    }
}
