<?php
require_once 'entidades/Cidade.php';
require_once 'dao/PDOCidadeDAO.php';

define("DESTINO", "cidade_list.php");

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
        'estado_id' => $_POST['estado_id'] ?? ''
    ];
}

function array2objeto($array)
{
    $objeto = new Cidade();
    $objeto->id = $array['id'];
    $objeto->nome = $array['nome'];
    $objeto->estado_id = $array['estado_id'];
    return $objeto;
}

function salvar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOCidadeDAO::getInstance();
    $dao->inserir($objeto);

    header("Location: " . DESTINO);
}

function alterar()
{
    $novo = tela2array();
    $objeto = array2objeto($novo);

    $dao = PDOCidadeDAO::getInstance();
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
}

function excluir()
{
    $id = $_GET['id'] ?? '';

    $dao = PDOCidadeDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
}
?>
