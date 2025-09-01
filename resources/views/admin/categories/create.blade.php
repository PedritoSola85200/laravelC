<x-layouts.admin>
    <flux:breadcrumbs class="mb-8" >
    <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="{{route('admin.categories.index')}}" >Categories</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Categories</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div>

        <form action="{{route('admin.categories.store')}}" class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4" method="POST">
            @csrf
            <flux:input label="Categoria" name="name" value="{{old('name')}}"/>
            <button type="submit"  class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Crear</button>
        </form>

    </div>
</x-layouts.admin>