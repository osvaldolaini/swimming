<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'team_photo_path', 'name', 'birth', 'nick', 'code', 'slug'
    ];

}
