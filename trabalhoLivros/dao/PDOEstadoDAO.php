<?php
include_once __DIR__ . "/EstadoDAO.php";

class PDOEstadoDAO extends EstadoDAO
{
    private static $instance = NULL;
    private $conn = NULL;

    function __construct()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PDOEstadoDAO();
        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/../banco.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS estado (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome TEXT NOT NULL,
                    sigla TEXT NOT NULL
                );
            ");
        } catch (PDOException $e) {
            echo 'Erro na conexao com o banco: ' . $e->getMessage();
        }
    }

    function inserir($objeto)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO estado (nome, sigla) VALUES (:nome, :sigla)");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':sigla' => $objeto->sigla
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE estado SET nome = :nome, sigla = :sigla WHERE id = :id");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':sigla' => $objeto->sigla,
                ':id' => $objeto->id
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM estado WHERE id = :id");
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function listar()
    {
        $dados = [];
        try {
            $result = $this->conn->query("SELECT * FROM estado");
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($dados, $linha);
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
        return $dados;
    }

    function obter($id)
    {
        $objeto = [];
        try {
            $stmt = $this->conn->prepare("SELECT * FROM estado WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($linha) {
                $objeto = $linha;
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
        return $objeto;
    }
}
?>
