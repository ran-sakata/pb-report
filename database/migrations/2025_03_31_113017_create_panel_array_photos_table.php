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
        Schema::create('panel_array_photos', function (Blueprint $table) {
            $table->ulid('id')->primary(); // 主キー
            $table->foreignUlid('report_id')->constrained('reports')->onDelete('cascade'); // リレーション
            $table->string('photo_path')->nullable(); // 写真パス
            $table->datetimes(); // 作成日時と更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_array_photos');
    }
};
