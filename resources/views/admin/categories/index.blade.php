<x-layouts.admin>

    <div class="flex justify-between items-center mb-8">
    <flux:breadcrumbs >
    <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Categories</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <a href="{{route('admin.categories.create')}}" class="btn btn-blue">Nuevo</a>
    </div>
    




<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
            </tr>
        </thead>
        <tbody>


            @foreach ($categories as $category)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$category->id}}
                </th>
                <td class="px-6 py-4">
                    {{$category->name}}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{route("admin.categories.edit", $category)}}"class="btn-edit">Editar</a>
                        
                        <form action="{{route('admin.categories.destroy', $category)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Eliminar</button>
                        </form>
                    </div>
                    
                </td>

        
            </tr>
            @endforeach



        </tbody>
    </table>
</div>

</x-layouts.admin>