<?php
require_once 'entidades/PessoaLivro.php';
require_once 'dao/PDOPessoaLivroDAO.php';

define("DESTINO", "pessoalivro_list.php");

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
        'pessoa_id' => $_POST['pessoa_id'] ?? '',
        'livro_id' => $_POST['livro_id'] ?? '',
        'data_emprestimo' => $_POST['data_emprestimo'] ?? '',
        'prazo' => $_POST['prazo'] ?? ''
    ];
}

function array2objeto($array)
{
    $objeto = new PessoaLivro();
    $objeto->id = $array['id'];
    $objeto->pessoa_id = $array['pessoa_id'];
    $objeto->livro_id = $array['livro_id'];
    $objeto->data_emprestimo = $array['data_emprestimo'];
    $objeto->prazo = $array['prazo'];
    return $objeto;
}

function salvar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOPessoaLivroDAO::getInstance();
    $dao->inserir($objeto);

    header("Location: " . DESTINO);
}

function alterar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOPessoaLivroDAO::getInstance();
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
}

function excluir()
{
    $id = $_GET['id'] ?? '';

    $dao = PDOPessoaLivroDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
}
?>
