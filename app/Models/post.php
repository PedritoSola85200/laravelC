<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'slug', 'image_path', 'excerpt', 'concept', 'is_published',
        'published_at', 'user_id', 'category_id' ];

        protected $casts = [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];

        //RELACIONES
        
        public function category()
        {
            return $this->belongsTo(category::class);
        }

        public function users()
        {
            return $this->belongsTo(User::class);
        }

        public function coments()
        {
            return $this->hasMany(coment::class);
        }

        public function tags()
        {
            return $this->belongsToMany(tag::class);
        }
}
