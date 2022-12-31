<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use Uuids;
    use HasFactory;
    use HasApiTokens;

    protected $hidden = ["created_at", "updated_at", "password"];

    protected $fillable = [
        "full_name", "username", "password"
    ];

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
