<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    protected $table = 'expense_types';
    protected $fillable = [
        'type',
        'title',
        'status',
    ];
    public $timestamps = false;
}
