<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\AssignOp\Concat;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = post::latest('id')->paginate();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => 'required|string|max:255',
            "slug" => 'required|string|max:255|unique:posts,slug',
            'category_id' => 'required|exists:categories,id'

        ]);

        session()->flash('swal', 
        [
        'icon' => 'success', '
        title' => 'Post creado', 
        'text' => 'Post creado existosamente']);
        
      $data['user_id'] = auth('web')->id();
      $post = post::create($data);

        return redirect()->route('admin.posts.edit',compact('post') );
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        
        $categories = category::all();
       
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
            $data = $request->validate([
            "title" => 'required|string|max:255',
            "slug" => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required_if:is_published,1|max:255',
            'concept' => 'required_if:is_published,1',
            'is_published' => 'boolean'

        ]);

        $post->update($data);

         session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post actualizado',
            'text' => 'Post actualizado correctamente'
        ]); 

        return  redirect()->route('admin.posts.edit', $post) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        //
    }
}
