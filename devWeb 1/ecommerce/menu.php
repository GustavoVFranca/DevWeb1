<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php?pagina=noticias">Noticias</a></li>
        <li><a href="index.php?pagina=faleconosco">Fale Conosco</a></li>
    </ul>
    <form action="index.php" method="GET">
        <input type="hidden" name="pagina" value="busca">
        <input type="text" name="q" placeholder="buscar">
        <input type="submit" value="ok">
    </form>
</nav>
