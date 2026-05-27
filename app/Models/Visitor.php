<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip',
        'country',
        'city',
        'region',
        'user_agent',
        'referer',
    ];

    // Auto-cast created_at to ISO string for JSON
    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s\Z',
    ];
}
