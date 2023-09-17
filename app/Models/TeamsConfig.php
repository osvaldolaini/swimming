<?php

namespace App\Models;

use App\Models\Model\Athletes;
use App\Models\Model\Times;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TeamsConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'team_photo_path', 'name', 'birth', 'nick', 'code', 'slug'
    ];

    public function athletes():HasMany
    {
        return $this->hasMany(Athletes::class,'teams_configs_id','id');
    }
    public function head():HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function coachs():HasMany
    {
        return $this->hasMany(UserGroup::class,'teams_configs_id','id');
    }
    public function times():HasMany
    {
        return $this->hasMany(Times::class,'teams_configs_id','id');
    }

}
