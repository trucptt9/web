<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model
{
    use HasFactory;
    protected $table = 'coupon';
    protected $primaryKey = 'coupon_id';
    protected $fillable = [
        'coupon_name',
        'coupon_value',
        'coupon_start',
        'coupon_end',
        'coupon_desc'
    ];
}
