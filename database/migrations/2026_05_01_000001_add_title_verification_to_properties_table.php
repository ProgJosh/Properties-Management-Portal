<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('title_document')->nullable()->after('thumbnail');
            $table->enum('title_verification_status', ['pending', 'approved', 'rejected'])
                  ->default('pending')->after('title_document');
            $table->text('title_rejection_reason')->nullable()->after('title_verification_status');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['title_document', 'title_verification_status', 'title_rejection_reason']);
        });
    }
};
