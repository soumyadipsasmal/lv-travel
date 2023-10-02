<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    use HasFactory;
    protected $table = 'booking_details';
    protected $fillable = [
        'bookingid',
        'tourid',
        'tourprice',
        'created_by',
        'updated_by',
        'created_by_role',
        'updated_by_role',
        'created_by_ip',
        'updated_by_ip',
        'del_flag'
    ];
}
