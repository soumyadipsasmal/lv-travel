<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'orderid',
        'payid',
        'entity',
        'amount',
        'currency',
        'status',
        'created_by',
        'created_by_ip',
    ];
}
