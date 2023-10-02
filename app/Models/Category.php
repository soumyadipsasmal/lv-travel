<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'catname',
        'catslug',
        'catimage',
        'created_by',
        'updated_by',
        'created_by_role',
        'updated_by_role',
        'created_by_ip',
        'updated_by_ip',
        'del_flag'
    ];
}
