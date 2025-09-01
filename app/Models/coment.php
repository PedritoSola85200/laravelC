<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coment extends Model
{
    protected $fillable = [
        'body'];

    public function posts()
    {
        return $this->belongsTo(post::class);
    }
}
