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
        Schema::table('managements', function (Blueprint $table) {
            $table->string('instagram_url')->nullable()->after('photo');
            $table->string('linkedin_url')->nullable()->after('photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('managements', function (Blueprint $table) {
            $table->dropColumn(['instagram_url', 'linkedin_url']);
        });
    }
};
