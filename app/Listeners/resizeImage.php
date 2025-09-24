<?php

namespace App\Listeners;

use App\Events\uploadedImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
