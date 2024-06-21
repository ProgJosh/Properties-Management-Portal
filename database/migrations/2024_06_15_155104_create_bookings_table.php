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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Adds foreign key constraint and cascading delete
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Adds foreign key constraint and cascading delete
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('region')->nullable(); // Made nullable as it may not be necessary for all countries
            $table->string('zip_code');

            $table->date('checkin'); // Use date type for date fields
            $table->date('checkout'); // Use date type for date fields
            $table->unsignedTinyInteger('adults'); // Use integer type for number fields
            $table->unsignedTinyInteger('kids')->default(0); // Use integer type for number fields and provide a default value

         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
