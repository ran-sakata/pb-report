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
        'junction_box_photo',
        'inside_junction_box_photo',
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
        return $this->hasMany(EastPathPhoto::class);
    }

    public function southPathPhotos()
    {
        return $this->hasMany(SouthPathPhoto::class);
    }

    public function powerConverterOverviewPhotos()
    {
        return $this->hasMany(PowerConverterOverviewPhoto::class);
    }

    public function pipePuttyPhotos()
    {
        return $this->hasMany(PipePuttyPhoto::class);
    }

    public function panelArrayPhotos()
    {
        return $this->hasMany(PanelArrayPhoto::class);
    }

    public function panelConditionPhotos()
    {
        return $this->hasMany(PanelConditionPhoto::class);
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
