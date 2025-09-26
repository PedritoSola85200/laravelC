<?php

namespace App\Listeners;

use App\Events\uploadedImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class resizeImage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(uploadedImage $event): void
    {
                $upload = Storage::get($event->image_path);

        $extension = pathinfo($event->image_path, PATHINFO_EXTENSION);
            $image = Image::read($upload)
            ->scale(width: 500)                                      
            ->encodeByExtension($extension, quality: 85);
        Storage::put($event->image_path, $image); 
        
        } 
    }

