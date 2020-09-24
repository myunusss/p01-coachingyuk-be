<?php

namespace App\Models;

class Role extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];
}
