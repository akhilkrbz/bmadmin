<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $table = 'purchase_items';

    protected $fillable = [
        'purchase_id',
        'item_id',
        'quantity',
        'rate',
        'amount',
    ];

    public $timestamps = false;

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function item()
    {
        return $this->belongsTo(Ledger::class, 'item_id');
    }
}
