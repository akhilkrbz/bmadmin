<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    use HasFactory;

    protected $table = 'payment_vouchers';

    protected $fillable = [
        'voucher_number',
        'voucher_date',
        'ledger_id',
        'amount',
        'payment_mode',
        'description',
        'created_at',
        'created_by',
    ];

    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ledger()
    {
        return $this->belongsTo(Ledger::class, 'ledger_id');
    }
}
