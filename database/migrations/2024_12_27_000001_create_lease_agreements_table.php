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
        Schema::create('lease_agreements', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys
            $table->unsignedBigInteger('booking_id')->unique();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('landlord_id');
            $table->unsignedBigInteger('property_id');
            
            // Agreement Details
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('monthly_rent', 12, 2);
            $table->decimal('security_deposit', 12, 2)->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->json('additional_terms')->nullable();
            
            // Signature & Status
            $table->enum('status', ['pending', 'signed_by_tenant', 'signed_by_landlord', 'executed', 'cancelled', 'expired'])->default('pending');
            $table->timestamp('tenant_signed_at')->nullable();
            $table->timestamp('landlord_signed_at')->nullable();
            $table->string('tenant_signature_path')->nullable();
            $table->string('landlord_signature_path')->nullable();
            $table->string('agreement_document_path')->nullable();
            
            // Approval & Notes
            $table->text('tenant_notes')->nullable();
            $table->text('landlord_notes')->nullable();
            $table->timestamp('sent_to_tenant_at')->nullable();
            $table->timestamp('sent_to_landlord_at')->nullable();
            $table->timestamp('executed_at')->nullable();
            
            // Audit
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign key constraints
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('landlord_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            
            // Indexes
            $table->index('booking_id');
            $table->index('tenant_id');
            $table->index('landlord_id');
            $table->index('property_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lease_agreements');
    }
};
