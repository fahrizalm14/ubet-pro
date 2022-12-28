<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        "title",
        "project_id",
        "day_id",
        "start_time",
        "end_time",
        "is_done"
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
