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
        Schema::create('special_notes', function (Blueprint $table) {
            $table->ulid('id')->primary(); // 主キー
            $table->foreignUlid('report_id')->constrained('reports')->onDelete('cascade'); // リレーション
            $table->unsignedInteger('index'); // 特記事項の番号 (1～3)
            $table->string('title')->nullable(); // タイトル
            $table->string('photo_path')->nullable(); // 写真パス
            $table->text('description')->nullable(); // 説明
            $table->datetimes(); // 作成日時と更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_notes');
    }
};
