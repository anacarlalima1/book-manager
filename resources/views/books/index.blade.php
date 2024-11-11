@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Lista de Livros</h4>
        <a href="{{ route('books.create') }}" class="btn btn-success ms-auto">Adicionar novo livro</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Descrição</th>
            <th>Ano de publicação</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->publication_year }}</td>
                <td>
                    <div class="d-inline-flex align-items-center">
                        <a href="{{ route('books.show', $book->id) }}" class="text-dark me-3" title="Ver detalhes">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('books.edit', $book->id) }}" class="text-dark me-2">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="border-0 bg-transparent text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $book->id }}">
                            <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <!-- Modal de Confirmação -->
            <div class="modal fade" id="deleteModal-{{ $book->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $book->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $book->id }}">Confirmar exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir o livro "{{ $book->title }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {!! $books->links() !!}
    </div>

@endsection
