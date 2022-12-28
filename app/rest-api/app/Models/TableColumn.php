<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableColumn extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        "name",
        "length",
        "project_table_id",
        "column_type_id",
        "is_primary",
        "alias"
    ];
}
