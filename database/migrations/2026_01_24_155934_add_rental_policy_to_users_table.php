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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('rental_policy_accepted')->default(false)->after('remember_token');
            $table->timestamp('rental_policy_accepted_at')->nullable()->after('rental_policy_accepted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rental_policy_accepted', 'rental_policy_accepted_at']);
        });
    }
};
