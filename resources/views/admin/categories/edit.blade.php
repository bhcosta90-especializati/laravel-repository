<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Categoria: ') }}{{ $category->name }}
        </h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">Categorias</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </x-slot>

    <div class="card">
        <div class="card-header">{{ __('Editar Categoria: ') }}{{ $category->name }}</div>
        <div class="card-body">
            @include('admin.includes.alert')
            <form method="post" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                @include('admin.categories._partials.form')

                <div class="form-group">
                    <button class="btn btn-success">Editar</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
