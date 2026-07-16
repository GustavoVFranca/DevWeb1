<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gerenciamento CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container mt-5">
        <header class="text-center mb-4">
            <h1>Bem-vindo ao Sistema</h1>
        </header>
        <nav class="d-flex justify-content-center gap-3 mb-4">
            <a href="estado_list.php" class="btn btn-outline-primary">Estados</a>
            <a href="cidade_list.php" class="btn btn-outline-primary">Cidades</a>
            <a href="pessoa_list.php" class="btn btn-outline-primary">Pessoas</a>
            <a href="livro_list.php" class="btn btn-outline-primary">Livros</a>
            <a href="pessoalivro_list.php" class="btn btn-outline-primary">Empréstimos</a>
        </nav>
        <section class="text-center">
            <p class="lead">Selecione um módulo no menu acima para começar a gerenciar os registros.</p>
        </section>
    </main>
</body>
</html>