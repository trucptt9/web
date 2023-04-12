<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingModel extends Model
{
    use HasFactory;
    protected $table = 'shipping';
    protected $primaryKey = 'shipping_id';
    protected $fillable = [
        'customer_id',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_note'
        
    ];
}
