<?php
require_once 'entidades/Livro.php';
require_once 'dao/PDOLivroDAO.php';

define("DESTINO", "livro_list.php");

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = $_GET['acao'] ?? "";
        break;
    case 'POST':
        $acao = $_POST['acao'] ?? "";
        break;
}

switch ($acao) {
    case 'salvar':
        salvar();
        break;
    case 'Alterar':
        alterar();
        break;
    case 'excluir':
        excluir();
        break;
}

function tela2array()
{
    return [
        'id' => $_POST['id'] ?? '',
        'nome' => $_POST['nome'] ?? '',
        'autor' => $_POST['autor'] ?? '',
        'genero' => $_POST['genero'] ?? '',
        'descricao' => $_POST['descricao'] ?? ''
    ];
}

function array2objeto($array)
{
    $objeto = new Livro();
    $objeto->id = $array['id'];
    $objeto->nome = $array['nome'];
    $objeto->autor = $array['autor'];
    $objeto->genero = $array['genero'];
    $objeto->descricao = $array['descricao'];
    return $objeto;
}

function salvar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOLivroDAO::getInstance();
    $dao->inserir($objeto);

    header("Location: " . DESTINO);
}

function alterar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOLivroDAO::getInstance();
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
}

function excluir()
{
    $id = $_GET['id'] ?? '';

    $dao = PDOLivroDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
}
?>
