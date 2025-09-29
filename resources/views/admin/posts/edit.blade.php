 <x-layouts.admin>

    @push('css')
       <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" /> 
       <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush
    <flux:breadcrumbs class="mb-8" >
    <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="{{route('admin.posts.index')}}" >posts</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="bg-white px-4 py-8 rounded-lg shadow-lg space-y-4">

        <form action="{{route('admin.posts.update', $post)}}"  method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

        <div class="relative mb-5">
        <img  id="imgPreview"   src=" {{ $post->image_path  ?  Storage::url($post->image_path) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1200px-No-Image-Placeholder.svg.png'}}" alt="" class="w-full aspect-video  object-center object-cover">
        <div class="absolute top-8 right-8">
        <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
            Cambiar Imagen
        <input hidden type="file" name="image" accept="image/*" onchange="previewImage(event, '#imgPreview')" >
        </label>

        <div class="bg-white mt-6 px-3.5 rounded-lg ">
            <a href="{{route("prueba", $post)}}">Descargar Imagen</a>
        </div>
        </div>
    </div>
            <div>
            <flux:input label="Title" name="title" value="{{old('title', $post->title)}}"/>
            @if (!$post->is_published)    
            <flux:input label="Slug" name="slug" value="{{old('slug', $post->slug)}}"/>
            @endif
            <label for="">Categoria</label>
            <flux:select name="category_id" placeholder="Selecionar Categoria">
            @foreach ($categories as $category)
            <flux:select.option value="{{ $category->id}}" :selected="$category->id == old('category_id', $post->category_id)">
            {{$category->name}}
            </flux:select.option>
             @endforeach
            </flux:select>

            <flux:textarea label="Resumen" name="excerpt"> {{ old('excerpt', $post->excerpt) }} </flux:textarea>
            <p class="font-medium text-sm m-2">Etiquetas</p>
            <select id="tags" name="tags[]" style="width: 100%" multiple="multiple">
                @foreach ($tags  as $tag)    
                <option value="{{$tag->name}}" @selected(in_array($tag->name,old('tags',$post->tags->pluck('name')->toArray())))>
                    {{$tag->name}}
                </option>
                @endforeach

            </select>
            <div>
                <p class="font-medium text-sm m-2">Cuerpo</p>
                <div id="editor">
                <p>{!! old('concept', $post->concept) !!}</p>
            </div>
            <textarea hidden name="concept" id="concept">
                {{ old('concept', $post->concept) }}
            </textarea>
            </div>

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
            <button type="submit"  class="btn-edit">Guardar</button>
            <button type="button"  class="btn-delete">Eliminar</button>
            </div>
        </form>

        <form action="{{route('admin.posts.destroy', $post)}}" method="post" id="DeleteForm">
            @csrf
            @method('DELETE')
        </form>

    </div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
          const quill = new Quill('#editor', {
    theme: 'snow'
  });

  quill.on('text-change', function(){
    document.querySelector('#concept').value = quill.root.innerHTML;
  })
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
    $('#tags').select2({
        tags:true,
        tokenSeparators: [','],
        
    });

});
</script>

@endpush
</x-layouts.admin>