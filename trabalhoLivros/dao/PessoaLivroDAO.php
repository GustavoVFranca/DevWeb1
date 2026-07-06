<?php
abstract class PessoaLivroDAO
{
    abstract function inserir($objeto);
    abstract function alterar($objeto);
    abstract function excluir($id);
    abstract function listar();
    abstract function obter($id);
}
?>
