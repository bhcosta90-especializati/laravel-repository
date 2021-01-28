<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Produtos') }}
            <a href="{{route('admin.products.create')}}" class="btn btn-success">Add</a>
        </h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Produtos</li>
        </ol>
    </x-slot>

    <div class="card">
        <div class="card-header">Filtro</div>
        <div class="card-body">
            <form action="{{ route('admin.products.search') }}" class="form form-inline" method="post">
                @csrf
                <input type="text" class="form-control" placeholder="Nome do Produto" name="name"
                       value="{{ $data['name'] ?? '' }}">
                <input type="text" class="form-control" placeholder="URL do Produto" name="url"
                       value="{{ $data['url'] ?? '' }}">
                <input type="text" class="form-control" placeholder="Descrição" name="description"
                       value="{{ $data['description'] ?? '' }}">
                <select class="form-control" name="category_id">
                    <option value="">Categoria</option>
                    @foreach($categories as $key => $rs)
                        <option value="{{$key}}" {{(isset($data['category_id']) ? $data['category_id'] == $key : '') ? 'selected' : ''}}>{{$rs}}</option>
                    @endforeach
                </select>
                <button class="btn btn-success">Pesquisar</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Lista</div>
        <div class="card-body">
            <div class="form-group">
                @include('admin.includes.alert')
                <table class="table table-striped form-group">
                    <thead>
                    <th style="width: 1px">#</th>
                    <th>{{__('Nome')}}</th>
                    <th>{{__('Categoria')}}</th>
                    <th>{{__('Link')}}</th>
                    <th>{{__('Preço')}}</th>
                    <th class="text-right" style="width: 150px">{{__('Ações')}}</th>
                    </thead>
                    <tbody>
                    @foreach($products as $rs)
                        <tr>
                            <td>{{ $rs->id }}</td>
                            <td>{{ $rs->name }}</td>
                            <td>{{ $rs->category ? $rs->category->name : '-' }}</td>
                            <td>{{ $rs->url }}</td>
                            <td>R${{ $rs->price }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.products.edit', $rs->id) }}" class="badge badge-warning">Editar</a>

                                <a href="{{ route('admin.products.show', $rs->id) }}" class="badge badge-secondary">Detalhes</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            {!! $products->appends($data ?? [])->links() !!}
        </div>
    </div>
</x-app-layout>
