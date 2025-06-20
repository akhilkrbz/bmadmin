<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $table = 'beds';
    protected $fillable = [
        'date_of_bed',
        'no_of_beds',
        'description',
        'created_at',
        'created_by',
    ];
    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
