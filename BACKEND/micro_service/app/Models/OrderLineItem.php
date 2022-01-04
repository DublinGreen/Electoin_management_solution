<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLineItem extends Model {
    protected $table = 'order_line_items';

    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'quantity',
        'vendor_id',
        'shipped_at',
        'created_at',
        'updated_at'
    ];
}