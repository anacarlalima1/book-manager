@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
    <div class="card">
        <div class="card-header">Editar Livro</div>
        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('books.partials.form', ['book' => $book])
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>
@endsection
