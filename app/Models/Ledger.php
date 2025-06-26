<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $table = 'ledgers';
    protected $fillable = [
        'type',
        'title',
        'description',
        'status',
    ];
    public $timestamps = false;
}
