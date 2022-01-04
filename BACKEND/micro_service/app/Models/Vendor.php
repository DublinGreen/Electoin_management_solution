<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model {
    protected $table = 'vendors';

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];
}