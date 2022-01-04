<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model {
    protected $table = 'creatives';

    protected $fillable = [
        'id',
        'user_id',
        'image_url',
        'created_at',
        'updated_at'
    ];
}