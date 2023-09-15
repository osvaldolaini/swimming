<?php

namespace App\Models\Model;

use App\Models\TeamsConfig;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsRestriction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','teams_configs_id','team_id','user_id'
    ];
    public function config()
    {
        return $this->belongsTo(TeamsConfig::class);
    }
    public function team()
    {
        return $this->belongsTo(Teams::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
