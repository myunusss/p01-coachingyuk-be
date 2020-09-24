<?php

namespace App\Models;

use App\Helpers\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefaultModel extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'deleted_at'
    ];
}
