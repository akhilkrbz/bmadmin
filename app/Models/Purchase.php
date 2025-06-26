<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseItem;
use App\Models\Ledger;
use App\Models\User;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    protected $fillable = [
        'purchase_date',
        'bill_no',
        'supplier_id',
        'payment_mode',
        'total_amount',
        'description',
        'created_at',
        'created_by',
    ];

    public $timestamps = false;

    public function supplier()
    {
        return $this->belongsTo(Ledger::class, 'supplier_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id');
    }
}
