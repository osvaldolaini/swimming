<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'type', 'user_id','teams_configs_id','head_ok','coach_ok'
    ];

    public function getActivityAttribute()
    {
        switch ($this->type) {
            case 1:
                return 'Desenvolvedor';
                break;
            case 2:
                return 'Coordenador';
                break;
            case 3:
                return 'Treinador';
                break;
            case 4:
                return 'Atleta';
                break;
            case 5:
                return 'Visitante';
                break;
        }

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function team():HasOne
    {
        return $this->hasOne(TeamsConfig::class,'id','teams_configs_id');
    }
    public function coachTeam()
    {
        return TeamsConfig::find($this->teams_configs_id);
    }

}
