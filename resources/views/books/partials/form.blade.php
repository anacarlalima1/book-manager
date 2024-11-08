<div class="mb-3">
    <label for="title" class="form-label">Título</label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $book->title ?? '') }}">
    @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="author" class="form-label">Autor</label>
    <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror"
           value="{{ old('author', $book->author ?? '') }}">
    @error('author')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description ?? '') }}</textarea>
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="publication_year" class="form-label">Ano de publicação</label>
    <input type="number" name="publication_year" id="publication_year" class="form-control @error('publication_year') is-invalid @enderror"
           value="{{ old('publication_year', $book->publication_year ?? '') }}">
    @error('publication_year')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
