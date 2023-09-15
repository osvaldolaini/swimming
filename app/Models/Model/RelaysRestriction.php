<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelaysRestriction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','teams_configs_id','relay_id','user_id'
    ];

    public function config()
    {
        return $this->belongsTo(TeamsConfig::class);
    }
    public function relay()
    {
        return $this->belongsTo(Relays::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
