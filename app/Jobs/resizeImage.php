<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

use function Livewire\store;

class resizeImage implements ShouldQueue
{
    use Queueable;

    public $image_path;

    /**
     * Create a new job instance.
     */
    public function __construct($image_path)
    {
    $this->image_path = $image_path; 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $upload = Storage::get($this->image_path);

        $extension = pathinfo($this->image_path, PATHINFO_EXTENSION);
            $image = Image::read($upload)
            ->scale(width: 500)                                      
            ->encodeByExtension($extension, quality: 85);
        Storage::put($this->image_path, $image); 
        
        } 
    
}
