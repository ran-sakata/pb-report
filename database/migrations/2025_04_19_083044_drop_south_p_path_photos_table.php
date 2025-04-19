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
        Schema::dropIfExists('south_path_photos');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('south_path_photos', function (Blueprint $table) {
            $table->ulid('id')->primary(); // 主キー
            $table->foreignUlid('report_id')->constrained('reports')->onDelete('cascade'); // リレーション
            $table->string('photo_path'); // 写真パス
            $table->datetimes();
        });
    }
};
