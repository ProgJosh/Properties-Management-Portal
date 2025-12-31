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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            
            // Commission details
            $table->decimal('transaction_amount', 12, 2); // Original payment amount
            $table->decimal('commission_percentage', 5, 2)->default(3); // Commission %
            $table->decimal('commission_amount', 12, 2); // Calculated commission
            $table->decimal('net_amount', 12, 2); // Amount after commission deduction
            
            // Status tracking
            $table->enum('status', ['pending', 'deducted', 'refunded'])->default('pending');
            $table->enum('payment_status', ['successful', 'failed', 'refunded'])->default('successful');
            
            // Reference information
            $table->string('month_year')->nullable(); // For monthly grouping
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for faster queries
            $table->index('admin_id');
            $table->index('payment_id');
            $table->index('status');
            $table->index('month_year');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
