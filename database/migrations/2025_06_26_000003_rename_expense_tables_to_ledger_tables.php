<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('expense_types', 'ledger_types');
        Schema::rename('expenses', 'ledgers');
    }

    public function down(): void
    {
        Schema::rename('ledger_types', 'expense_types');
        Schema::rename('ledgers', 'expenses');
    }
};
