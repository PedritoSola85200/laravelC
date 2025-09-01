<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
use HasFactory;

    protected $fillable = ['name'];

    //RELACIONES
    public function posts()
    {
        return $this->hasMany(post::class);
    }
}
