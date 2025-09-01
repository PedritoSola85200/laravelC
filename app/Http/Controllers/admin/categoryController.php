<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories =  category::orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data =  $request->validate([
        'name' => 'required|string|max:255|unique:categories'
        ]);
        
        category::create($data);
        session()->flash('swal', ['icon' => 'success', 'title' => 'Categoria creada', 'text' => 'Categoria creada existosamente']);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {


        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria actualizada',
            'text' => 'La categoria fue actualizada correctamente'
        ]);
        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {

       $category->delete();

      session()->flash('swal', [
        'icon' => 'success',
        'Title' => 'Categoria Eliminada',
        'text' => 'La categoria fue eliminada exitosamente'
      ]);

      return redirect()->route('admin.categories.index');
    
}
}