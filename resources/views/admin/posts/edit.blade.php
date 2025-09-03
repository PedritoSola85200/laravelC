<x-layouts.admin>

    <flux:breadcrumbs class="mb-8" >
    <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="{{route('admin.posts.index')}}" >posts</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div>

        <form action="{{route('admin.posts.update', $post)}}" class="bg-black px-6 py-8 rounded-lg shadow-lg space-y-4" method="POST">
            @csrf
            @method('PUT')
            <flux:input label="Title" name="title" value="{{old('title', $post->title)}}"/>
            <flux:input label="Slug" name="slug" value="{{old('slug', $post->slug)}}"/>
            <flux:select name="category_id" placeholder="Selecionar Categoria">
            @foreach ($categories as $category)
            <flux:select.option value="{{ $category->id}}" :selected="$category->id == old('category_id', $post->category_id)">
            {{$category->name}}
            </flux:select.option>
             @endforeach
            </flux:select>

            <flux:textarea label="Resumen" name="excerpt"> {{ old('excerpt', $post->excerpt) }} </flux:textarea>
            <flux:textarea label="Cuerpo" rows="16" name="concept"> {{ old('concept', $post->concept) }} </flux:textarea>
            <div>
                <p class="text-sm font-semibold">Estado</p>

                <label >
                <input type="radio" name="is_published" value="0" @checked(old('is_published',$post->is_published) == 0) >
                No publicado
                </label>

                <label >
                <input type="radio" name="is_published" value="1" @checked(old('is_published',$post->is_published) == 1)>
                publicado
                </label>

            </div>
            <button type="submit"  class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Editar</button>
        </form>

    </div>

</x-layouts.admin>