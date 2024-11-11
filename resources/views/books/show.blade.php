@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $book->title }}</h1>
        <p><strong>Autor:</strong> {{ $book->author }}</p>
        <p><strong>Descrição:</strong> {{ $book->description }}</p>
        <p><strong>Ano de publicação:</strong> {{ $book->publication_year }}</p>
        <a href="{{ route('books.index') }}" class="btn btn-primary">Voltar</a>
    </div>
@endsection
