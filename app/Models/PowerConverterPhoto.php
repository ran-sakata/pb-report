<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerConverterPhoto extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'report_id',
        'photo_path',
        'thumbnail_path',
        'index'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
