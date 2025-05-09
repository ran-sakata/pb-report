<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialNote extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'report_id',
        'index',
        'title',
        'photo_path',
        'description',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
