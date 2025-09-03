<?php

namespace App\Observers;

use App\Models\post;

class postObserver
{
    public function updating( post $post)
{
    if($post->is_published == 1 && !$post->published_at)
    {
        $post->published_at = now();
    }
 
}
}
