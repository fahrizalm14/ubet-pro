<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        "name",
        "description",
        "user_id"
    ];

    protected $hidden = ["user_id", "created_at", "updated_at"];

    public function projectTable()
    {
        return $this->hasMany(ProjectTable::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
