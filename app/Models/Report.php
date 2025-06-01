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
        'signboard_thumbnail_path',
        'junction_box_photo',
        'junction_box_thumbnail_path',
        'inside_junction_box_photo',
        'junction_box_thumbnail_path',
        'power_converter_status',
        'pipe_putty_status',
        'panel_array_status',
        'panel_condition_status',
    ];

    protected $casts = [
        'reported_at' => 'date',
        'worked_at' => 'date',
    ];

    public function rowPhotos()
    {
        return $this->hasMany(RowPhoto::class);
    }

    public function eastPathPhotos()
    {
        return $this->hasMany(EastPathPhoto::class)->orderBy('row_number');
    }

    public function westPathPhotos()
    {
        return $this->hasMany(WestPathPhoto::class)->orderBy('row_number');
    }

    public function powerConverterPhotos()
    {
        return $this->hasMany(PowerConverterPhoto::class);
    }

    public function pipePuttyPhotos()
    {
        return $this->hasMany(PipePuttyPhoto::class)->orderBy('index');
    }

    public function panelArrayPhotos()
    {
        return $this->hasMany(PanelArrayPhoto::class)->orderBy('index');
    }

    public function panelConditionPhotos()
    {
        return $this->hasMany(PanelConditionPhoto::class)->orderBy('index');
    }
    
    public function powerConverters()
    {
        return $this->hasMany(PowerConverter::class);
    }
    
    public function specialNotes()
    {
        return $this->hasMany(SpecialNote::class);
    }
}
