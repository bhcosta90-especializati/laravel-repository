<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produto: ') }}{{ $product->name }}
        </h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Produtos</a></li>
            <li class="breadcrumb-item active">Detalhe</li>
        </ol>

    </x-slot>

    <div class="card">
        <div class="card-header">{{ __('Produto: ') }}{{ $product->name }}</div>
        <div class="card-body">
            <p><strong>{{ __('ID') }}: </strong>{{ $product->id }}</p>
            <p><strong>{{ __('Nome') }}: </strong>{{ $product->name }}</p>
            <p><strong>{{ __('Categoria') }}: </strong>{{ $product->category->name }}</p>
            <p><strong>{{ __('URL') }}: </strong>{{ $product->url }}</p>
            <p><strong>{{ __('Descrição') }}: </strong>{{ $product->description }}</p>

            <hr />

            <form action="{{route('admin.products.destroy', $product->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">{{ __('Deletar') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
