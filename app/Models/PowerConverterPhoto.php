<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerConverterPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'photo_path'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
