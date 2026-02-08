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
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('monthly_rent', 10, 2)->nullable()->after('status');
            $table->date('rent_due_date')->nullable()->after('monthly_rent');
            $table->date('next_payment_date')->nullable()->after('rent_due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['monthly_rent', 'rent_due_date', 'next_payment_date']);
        });
    }
};
