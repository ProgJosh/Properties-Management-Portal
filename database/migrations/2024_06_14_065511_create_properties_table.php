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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landlord_id');
            $table->string('name');
            $table->string('description');
            $table->string('address');
            $table->string('price');
            $table->tinyInteger('status')->default(1)->comment('0 = Inactive, 1 = Active');
            $table->string('location');
            $table->string('bedroom');
            $table->string('bathroom');
            $table->tinyInteger('garage')->default(0)->comment('0 = no, 1 = yes');
            $table->string('floor');
            $table->integer('accommodation');
            $table->tinyInteger('pet_friendly')->default(0)->comment('0 = no, 1 = yes');
            $table->string('type');
            $table->string('thumbnail');
            $table->string('facility')->nullable();
        
            $table->foreign('landlord_id')->references('id')->on('Admins')->onDelete('cascade');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
