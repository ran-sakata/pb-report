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
        // power_converter_photos
        Schema::table('power_converter_photos', function (Blueprint $table) {
            $table->integer('index')->nullable()->after('report_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('power_converter_photos', function (Blueprint $table) {
            $table->dropColumn('index');
        });
    }
};
