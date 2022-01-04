<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'address_1	',
        'address_2',
        'city',
        'state',
        'postal_code',
        'country',
        'created_at',
        'updated_at'
    ];
}