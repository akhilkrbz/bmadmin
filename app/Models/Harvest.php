<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HarvestBed;

class Harvest extends Model
{
    protected $table = 'harvest';
    protected $fillable = [
        'harvest_date',
        'total_harvest_quantity',
        'description',
        'created_at',
        'created_by',
    ];
    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function beds()
    {
        return $this->hasMany(HarvestBed::class, 'harvest_id');
    }
}
