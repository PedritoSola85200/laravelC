<?php

use App\Models\post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Livewire\Volt\Volt;

use function Laravel\Prompts\alert;

Route::get('/', function () {
    return view('welcome');
})->name('home'); 


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/prueba/{post}', function(post $post){

if( $post->image_path){

    return FacadesStorage::download($post->image_path);
}else{

            session()->flash(
            'swal',
            [
                'icon' => 'error',
                'title' => 'Descargar imagen',
                'text' => 'Debe seleccionar una imagen para Descargar'
            ]
        );

        
return redirect()->route('admin.posts.edit', compact('post'));
}


})->name("prueba");

require __DIR__.'/auth.php';
