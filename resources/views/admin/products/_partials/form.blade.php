<div class="form-group">
    <input type="text" value="{{ old('name') ?? $product->name ?? '' }}" name="name" id="name" class="form-control" placeholder="Nome do Produto">
</div>
<div class="form-group">
    <input type="text" value="{{ old('url') ?? $product->url ?? '' }}" name="url" id="url" class="form-control" placeholder="URL do Produto">
</div>
<div class="form-group">
    <select class="form-control" name="category_id">
        <option value="">Categoria</option>
        @foreach($categories as $key => $rs)
            <option value="{{$key}}" {{(old('category_id') || isset($product) && $product->category_id == $key) ? 'selected' : ''}}>{{$rs}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <input type="number" value="{{ old('price') ?? $product->price ?? '' }}" name="price" id="price" class="form-control" placeholder="Preço do Produto">
</div>
<div class="form-group">
    <textarea type="text" name="description" id="description" class="form-control" placeholder="Descrição da Categoria">{{ old('description') ?? $product->description ?? '' }}</textarea>
</div>
