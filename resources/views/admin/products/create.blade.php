<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Produto') }}
        </h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Produtos</a></li>
            <li class="breadcrumb-item active">Cadastro</li>
        </ol>

    </x-slot>

    <div class="card">
        <div class="card-header">Cadastrar Produto</div>
        <div class="card-body">
            @include('admin.includes.alert')
            <form method="post" action="{{ route('admin.products.store') }}">
                @csrf
                @include('admin.products._partials.form')
                <div class="form-group">
                    <button class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
