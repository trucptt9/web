<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    use HasFactory;
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name',
        'brand_desc',
        'brand_status',
        
    ];

   
}
