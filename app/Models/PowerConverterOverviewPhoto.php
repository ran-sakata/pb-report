<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerConverterOverviewPhoto extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'report_id',
        'photo_path',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
