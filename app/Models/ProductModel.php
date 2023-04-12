<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'category_id',
        'brand_id',
        'product_content',
        'product_desc',
        'product_price',
        'product_image',
        'product_status',
        'product_SLtrongkho'
        
    ];
}
