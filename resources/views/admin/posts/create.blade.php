<x-layouts.admin>
    <flux:breadcrumbs class="mb-8" >
    <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="{{route('admin.posts.index')}}" >posts</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Crear</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div>

        <form action="{{route('admin.posts.store')}}" class="bg-black px-6 py-8 rounded-lg shadow-lg space-y-4" method="POST">
            @csrf

            <flux:input label="Titulo" name="title" id="title" value="{{old('title')}}" oninput="string_to_slug(this.value, '#slug')"/>
            <flux:input label="Slug" name="slug" id="slug" value="{{old('slug')}}"/>

<flux:select name="category_id" placeholder="Selecionar Categoria">
    @foreach ($categories as $category)
        <flux:select.option 
            value="{{ $category->id }}" :selected="$category->id == old('category_id')">
            {{$category->name}}
        </flux:select.option>
    @endforeach
</flux:select>

            <button type="submit"  class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Crear</button>
        </form>

    </div>

</x-layouts.admin>