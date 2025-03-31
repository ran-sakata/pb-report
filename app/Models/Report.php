<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, HasUlids;

    /**
     * 一括代入可能な属性
     */
    protected $fillable = [
        'reported_at',
        'worked_at',
        'plant_name',
        'property_address',
        'weather',
        'signboard_photo_path',
        'east_path_photo_path',
        'south_path_photo_path',
        // 特記事項
        'special_note_1_title',
        'special_note_1_photo_path',
        'special_note_1_description',
        'special_note_2_title',
        'special_note_2_photo_path',
        'special_note_2_description',
        'special_note_3_title',
        'special_note_3_photo_path',
        'special_note_3_description',
    ];

    public function rowPhotos()
    {
        return $this->hasMany(RowPhoto::class);
    }

    public function eastPathPhotos()
    {
        return $this->hasMany(EastPathPhoto::class);
    }

    public function southPathPhotos()
    {
        return $this->hasMany(SouthPathPhoto::class);
    }

    public function weedingNotes()
    {
        return $this->hasMany(WeedingNote::class);
    }
}
