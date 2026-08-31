<?php
require_once 'entidades/Pessoa.php';
require_once 'dao/PDOPessoaDAO.php';

define("DESTINO", "pessoa_list.php");

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
        'cidade_id' => $_POST['cidade_id'] ?? '',
        'peso' => $_POST['peso'] ?? '',
        'altura' => $_POST['altura'] ?? ''
    ];
}

function array2objeto($array)
{
    $objeto = new Pessoa();
    $objeto->id = $array['id'];
    $objeto->nome = $array['nome'];
    $objeto->cidade_id = $array['cidade_id'];
    $objeto->peso = $array['peso'];
    $objeto->altura = $array['altura'];
    return $objeto;
}

function salvar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOPessoaDAO::getInstance();
    $dao->inserir($objeto);

    header("Location: " . DESTINO);
}

function alterar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOPessoaDAO::getInstance();
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
}

function excluir()
{
    $id = $_GET['id'] ?? '';

    $dao = PDOPessoaDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
}
?>
