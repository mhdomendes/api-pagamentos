<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'external_id',
        'idempotency_key',
        'amount',
        'status',
    ];
}