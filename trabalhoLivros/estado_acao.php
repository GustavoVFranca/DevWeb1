<?php
require_once 'entidades/Estado.php';
require_once 'dao/PDOEstadoDAO.php';

define("DESTINO", "estado_list.php");

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
    case 'Salvar':
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
        'sigla' => $_POST['sigla'] ?? ''
    ];
}

function array2objeto($array)
{
    $objeto = new Estado();
    $objeto->id = $array['id'];
    $objeto->nome = $array['nome'];
    $objeto->sigla = $array['sigla'];
    return $objeto;
}

function salvar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOEstadoDAO::getInstance();
    $dao->inserir($objeto);

    header("Location: " . DESTINO);
}

function alterar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOEstadoDAO::getInstance();
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
}

function excluir()
{
    $id = $_GET['id'] ?? '';

    $dao = PDOEstadoDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
}
?>
