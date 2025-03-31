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
        Schema::create('power_converters', function (Blueprint $table) {
            $table->ulid('id')->primary(); // 主キー
            $table->foreignUlid('report_id')->constrained('reports')->onDelete('cascade'); // リレーション
            $table->unsignedInteger('index'); // パワコンの番号 (1～10)
            $table->string('photo_path')->nullable(); // 写真パス
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_converters');
    }
};
