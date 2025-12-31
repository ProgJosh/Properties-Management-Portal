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
        Schema::create('payment_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            
            // Reminder details
            $table->date('due_date');
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'sent', 'failed', 'acknowledged'])->default('pending');
            
            // Notification channels
            $table->boolean('email_sent')->default(false);
            $table->boolean('sms_sent')->default(false);
            $table->boolean('in_app_sent')->default(false);
            
            // Tracking
            $table->datetime('email_sent_at')->nullable();
            $table->datetime('sms_sent_at')->nullable();
            $table->datetime('in_app_sent_at')->nullable();
            $table->datetime('acknowledged_at')->nullable();
            
            // Error tracking
            $table->text('email_error')->nullable();
            $table->text('sms_error')->nullable();
            $table->text('in_app_error')->nullable();
            
            // Reminder type (reminder before due date or overdue)
            $table->enum('reminder_type', ['advance', 'due_date', 'overdue'])->default('advance');
            $table->integer('days_before_due')->nullable(); // e.g., 5 days before
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('booking_id');
            $table->index('user_id');
            $table->index('status');
            $table->index('due_date');
            $table->index('reminder_type');
        });

        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_reminder_id')->constrained('payment_reminders')->onDelete('cascade');
            $table->enum('channel', ['email', 'sms', 'in_app'])->default('email');
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->text('message')->nullable();
            $table->text('error_message')->nullable();
            $table->string('recipient')->nullable(); // email or phone number
            $table->datetime('sent_at')->nullable();
            
            $table->timestamps();
            
            $table->index('payment_reminder_id');
            $table->index('channel');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('payment_reminders');
    }
};
