<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionalProductsModel extends Model
{
    use HasFactory;
    protected $table = 'promotional_products';
    protected $primaryKey = 'pp_id';
    protected $fillable = [
        'product_id',
        'coupon_id',
        'price_final'
        
    ];
}
