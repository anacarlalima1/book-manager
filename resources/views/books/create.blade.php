@extends('layouts.app')

@section('title', 'Adicionar Livro')

@section('content')
    <div class="card">
        <div class="card-header">Adicionar novo livro</div>
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                @include('books.partials.form')
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
