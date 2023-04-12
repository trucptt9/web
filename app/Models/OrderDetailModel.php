<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $primaryKey = 'orderDetail_id';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_qty'
    ];
}