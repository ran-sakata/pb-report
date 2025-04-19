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
        Schema::table('reports', function (Blueprint $table) {
            $table->string('power_converter_status')->default('〇'); // 状態カラムを追加
            $table->string('pipe_putty_status')->default('〇'); // 状態カラムを追加
            $table->string('panel_array_status')->default('〇'); // 状態カラムを追加
            $table->string('panel_condition_status')->default('〇'); // 状態カラムを追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('power_converter_status'); // カラムを削除
            $table->dropColumn('pipe_putty_status'); // カラムを削除
            $table->dropColumn('panel_array_status'); // カラムを削除
            $table->dropColumn('panel_condition_status'); // カラムを削除
        });
    }
};
