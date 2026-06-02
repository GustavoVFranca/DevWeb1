<?php
$pagina = $_GET['pagina'] ?? 'home';

$paginas_validas = ['home', 'noticias', 'produto', 'faleconosco'];
if (!in_array($pagina, $paginas_validas)) {
    $pagina = 'home';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minha Loja</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <?php include "cabecalho.php"; ?>

    <main>
        <?php include "paginas/{$pagina}.php"; ?>
    </main>

    <?php include "rodape.php"; ?>

</body>
</html>
