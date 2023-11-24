<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('book_transactions', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('returned_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_transactions', function (Blueprint $table) {
            $table->dropColumn('due_date');
        });
    }
};
