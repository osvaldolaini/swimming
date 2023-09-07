<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Return_;

class Modalities extends Model
{
    use HasFactory;
    public function times()
    {
        return $this->hasMany(Times::class);
    }

}
