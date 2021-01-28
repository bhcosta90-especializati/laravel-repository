<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categoria: ') }}{{ $category->name }}
        </h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">Categorias</a></li>
            <li class="breadcrumb-item active">Detalhe</li>
        </ol>

    </x-slot>

    <div class="card">
        <div class="card-header">{{ __('Categoria: ') }}{{ $category->name }}</div>
        <div class="card-body">
            <p><strong>{{ __('ID') }}: </strong>{{ $category->id }}</p>
            <p><strong>{{ __('Nome') }}: </strong>{{ $category->name }}</p>
            <p><strong>{{ __('URL') }}: </strong>{{ $category->url }}</p>
            <p><strong>{{ __('Descrição') }}: </strong>{{ $category->description }}</p>

            <hr />

            <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">{{ __('Deletar') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
