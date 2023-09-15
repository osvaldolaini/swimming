<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'type', 'user_id',
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
}
