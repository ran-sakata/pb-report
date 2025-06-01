<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RowPhoto extends Model
{
    use HasFactory,HasUlids;

    protected $fillable = [
        'report_id',
        'row_number',
        'photo_path',
        'thumbnail_path',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
