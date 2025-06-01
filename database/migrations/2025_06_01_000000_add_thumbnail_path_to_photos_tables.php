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
        // row_photos
        Schema::table('row_photos', function (Blueprint $table) {
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });

        // east_path_photos
        Schema::table('east_path_photos', function (Blueprint $table) {
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });

        // power_converters
        Schema::table('power_converters', function (Blueprint $table) {
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });

        // power_converter_photos
        Schema::table('power_converter_photos', function (Blueprint $table) {
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });

        // pipe_putty_photos
        Schema::table('pipe_putty_photos', function (Blueprint $table) {
            $table->integer('index')->nullable()->after('report_id');
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });

        // panel_array_photos
        Schema::table('panel_array_photos', function (Blueprint $table) {
            $table->integer('index')->nullable()->after('report_id');
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });

        // panel_condition_photos
        Schema::table('panel_condition_photos', function (Blueprint $table) {
            $table->integer('index')->nullable()->after('report_id');
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });

        // reports (for signboard)
        Schema::table('reports', function (Blueprint $table) {
            $table->string('signboard_thumbnail_path')->nullable()->after('signboard_photo_path');
            $table->string('inside_junction_box_thumbnail_path')->nullable()->after('inside_junction_box_photo');
            $table->string('junction_box_thumbnail_path')->nullable()->after('junction_box_photo');
        });

        // special_notes (for special note photos)
        Schema::table('special_notes', function (Blueprint $table) {
            $table->string('thumbnail_path')->nullable()->after('photo_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('row_photos', function (Blueprint $table) {
            $table->dropColumn('thumbnail_path');
        });
        Schema::table('east_path_photos', function (Blueprint $table) {
            $table->dropColumn('thumbnail_path');
        });
        Schema::table('power_converters', function (Blueprint $table) {
            $table->dropColumn('thumbnail_path');
        });
        Schema::table('power_converter_photos', function (Blueprint $table) {
            $table->dropColumn('thumbnail_path');
        });
        Schema::table('pipe_putty_photos', function (Blueprint $table) {
            $table->dropColumn('index');
            $table->dropColumn('thumbnail_path');
        });
        Schema::table('panel_array_photos', function (Blueprint $table) {
            $table->dropColumn('index');
            $table->dropColumn('thumbnail_path');
        });
        Schema::table('panel_condition_photos', function (Blueprint $table) {
            $table->dropColumn('index');
            $table->dropColumn('thumbnail_path');
        });
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('signboard_thumbnail_path');
            $table->dropColumn('inside_junction_box_thumbnail_path');
            $table->dropColumn('junction_box_thumbnail_path');
        });
        Schema::table('special_notes', function (Blueprint $table) {
            $table->dropColumn('thumbnail_path');
        });
    }
};
