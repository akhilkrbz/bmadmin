<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';
    protected $fillable = [
        'type_id',
        'date',
        'amount',
        'description',
        'created_at',
        'created_by',
    ];
    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class, 'type_id');
    }
}
