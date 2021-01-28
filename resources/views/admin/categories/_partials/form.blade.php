<div class="form-group">
    <input type="text" value="{{ old('name') ?? $category->name ?? '' }}" name="name" id="name" class="form-control" placeholder="Nome da Categoria">
</div>
<div class="form-group">
    <textarea type="text" name="description" id="description" class="form-control" placeholder="Descrição da Categoria">{{ old('description') ?? $category->description ?? '' }}</textarea>
</div>
