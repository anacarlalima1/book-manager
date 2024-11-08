<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">404</h1>
    <p class="lead">Oops! A página que você está procurando não existe.</p>
    <a href="{{ route('books.index') }}" class="btn btn-primary">Voltar para a Página Inicial</a>
</div>
</body>
</html>
