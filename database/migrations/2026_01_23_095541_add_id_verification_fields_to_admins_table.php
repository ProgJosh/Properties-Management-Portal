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
        Schema::table('admins', function (Blueprint $table) {
            $table->string('id_type')->nullable()->after('dob');
            $table->string('id_number')->nullable()->after('id_type');
            $table->string('full_name_on_id')->nullable()->after('id_number');
            $table->date('id_expiry_date')->nullable()->after('full_name_on_id');
            $table->string('id_document')->nullable()->after('id_expiry_date');
            $table->boolean('confirm_id_details')->default(false)->after('id_document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn([
                'id_type',
                'id_number',
                'full_name_on_id',
                'id_expiry_date',
                'id_document',
                'confirm_id_details'
            ]);
        });
    }
};
