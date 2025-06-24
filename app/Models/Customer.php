<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'type',
        'name',
        'place',
        'phone',
    ];
    public $timestamps = false;
}
