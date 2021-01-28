<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produto: ') }}{{ $product->name }}
        </h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Produtos</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </x-slot>

    <div class="card">
        <div class="card-header">{{ __('Editar Produto: ') }}{{ $product->name }}</div>
        <div class="card-body">
            @include('admin.includes.alert')
            <form method="post" action="{{ route('admin.products.update', $product->id) }}">
                @csrf
                @method('PUT')
                @include('admin.products._partials.form')

                <div class="form-group">
                    <button class="btn btn-success">Editar</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
