<?php

namespace App\Http\Controllers\admin;

use App\Events\uploadedImage;
use App\Http\Controllers\Controller;
use App\Jobs\resizeImage;
use App\Models\category;
use App\Models\post;
use App\Models\tag as tags;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\AssignOp\Concat;


class postController extends Controller /* implements HasMiddleware */
{

/*         public static function middleware()
        {
            return[
                 'admin'
                new Middleware('admin', except: ["index", 'create'])
            ];
        }
 */
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

        session()->flash(
            'swal',
            [
                'icon' => 'success',
                '
        title' => 'Post creado',
                'text' => 'Post creado existosamente'
            ]
        );

        $data['user_id'] = auth('web')->id();
        $post = post::create($data);

        return redirect()->route('admin.posts.edit', compact('post'));
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
        $tags = tags::all();

        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        $data = $request->validate([
            "title" => 'required|string|max:255',
            "slug" => [
                Rule::requiredIf(function () use ($post) {
                    return !$post->published_at;
                }),
                'string',
                'max:255',
                'unique:posts,slug,' . $post->id
            ],
            /* "slug" => 'required|string|max:255|unique:posts,slug,' . $post->id, */
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
            'excerpt' => 'required_if:is_published,1|max:255',
            'concept' => 'required_if:is_published,1',
            'is_published' => 'boolean'

        ]);

        if ($request->hasFile('image')) {

            if ($post->image_path) {
                Storage::delete($post->image_path);
            }

            
            $extension = $request->image->extension();
            $nameFile = $post->slug . '.' . $extension;

            while(Storage::exists('posts/' . $nameFile)){

                $nameFile = str_replace('.' . $extension, '-copia.' . $extension, $nameFile);
            }
                    
            /* $data['image_path'] = Storage::putFileAs('posts', $request->image,   $nameFile); */

        $data['image_path'] = Storage::putFileAs('posts' , $request->image, $nameFile ); 

        //resizeImage::dispatch($data['image_path']);
        uploadedImage::dispatch($data['image_path']);
        } 
        
        $post->update($data);

        $tags = [];

        foreach ($request->tags ?? [] as $tag) {
            $tags[] = tags::firstOrCreate(['name' => $tag]);
        }

        $post->tags()->sync($tags);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post actualizado',
            'text' => 'Post actualizado correctamente'
        ]);

        return  redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post eliminado',
            'text' => 'Post eliminado correctamente'
        ]);

        return redirect()->route('admin.posts.index');
    }
}
