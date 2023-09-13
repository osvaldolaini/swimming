<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Athletes extends Model
{
    use HasFactory;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'active', 'sex', 'name', 'birth', 'nick', 'updated_by',
        'created_by', 'code', 'slug', 'register', 'register_date'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtoupper($value);
        $this->attributes['slug'] = Str::slug($value);
    }
    public function getRealAgeAttribute()
    {
        return Carbon::parse($this->birth)
            ->age;
    }
    public function getAgeAttribute()
    {
        $birth_date = explode('-', $this->birth);

        return Carbon::parse($birth_date[0] . '-01-01')
            ->age;
    }
    public function getSexAbrevAttribute()
    {
        switch ($this->sex) {
            case 'masculino':
                return 'M';
                break;
            case 'feminino':
                return 'F';
                break;
        }
    }


    protected $casts = [
        'birth' => 'datetime:Y-m-d',
        'register_date' => 'datetime:Y-m-d',
    ];

    protected $visible = ['id', 'active', 'sex', 'name'];

    public function times()
    {
        return $this->hasMany(Times::class);
    }
    public function timess()
    {
        return $this->hasMany(Times::class, 'athlete_id', 'id');
    }
}
