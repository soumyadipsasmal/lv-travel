<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $table = 'tours';
    protected $fillable = [
        'cat_id',
        'tour_name',
        'tour_price',
        'tour_start',
        'tour_duration',
        'tour_image',
        'tour_group',
        'tour_place',
        'tour_description',
        'tour_status',
        'created_by',
        'updated_by',
        'created_by_role',
        'updated_by_role',
        'created_by_ip',
        'updated_by_ip',
        'del_flag'
    ];
}
