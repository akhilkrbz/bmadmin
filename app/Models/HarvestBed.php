<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HarvestBed extends Model
{
    protected $table = 'harvest_beds';
    protected $fillable = [
        'harvest_id',
        'bed_id',
    ];
    public $timestamps = false;

    public function harvest()
    {
        return $this->belongsTo(Harvest::class, 'harvest_id');
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class, 'bed_id');
    }
}
