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
        Schema::table('east_path_photos', function (Blueprint $table) {
            $table->integer('row_number')->after('report_id')->nullable()->comment('列番号');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('east_path_photos', function (Blueprint $table) {
            $table->dropColumn('row_number');
        });
    }
};
