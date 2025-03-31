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
        Schema::create('reports', function (Blueprint $table) {
            $table->ulid('id')->primary(); // 主キー
            $table->date('reported_at')->nullable(); // 実施報告日
            $table->date('worked_at')->nullable(); // 作業日
            $table->string('plant_name')->nullable(); // 発電所名
            $table->string('property_address')->nullable(); // 物件住所
            $table->string('weather')->nullable(); // 天気（晴れ、曇り、雨）
            $table->string('signboard_photo_path')->nullable(); // 看板写真
            $table->string('junction_box_photo')->nullable(); // 集電箱写真
            $table->string('inside_junction_box_photo')->nullable(); // 集電箱内写真
            $table->datetimes(); // 作成日時、更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
