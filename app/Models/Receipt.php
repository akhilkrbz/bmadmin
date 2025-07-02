<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'receipts';
    protected $fillable = [
        'receipt_number',
        'receipt_date',
        'ledger_id',
        'amount',
        'payment_mode',
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
}
