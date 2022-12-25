<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        "full_name", "username", "password"
    ];
}
