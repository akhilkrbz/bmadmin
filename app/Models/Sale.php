<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'invoice_no',
        'sale_date',
        'ledger_id',
        'payment_mode',
        'total_amount',
        'description',
        'created_at',
        'created_by',
    ];

    public $timestamps = false;

    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }
}
