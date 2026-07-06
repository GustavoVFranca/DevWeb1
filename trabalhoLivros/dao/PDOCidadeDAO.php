<?php
include_once __DIR__ . "/CidadeDAO.php";

class PDOCidadeDAO extends CidadeDAO
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
            self::$instance = new PDOCidadeDAO();
        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/../banco.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS cidade (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome TEXT NOT NULL,
                    estado_id INTEGER NOT NULL,
                    FOREIGN KEY (estado_id) REFERENCES estado(id)
                );
            ");
        } catch (PDOException $e) {
            echo 'Erro na conexao com o banco: ' . $e->getMessage();
        }
    }

    function inserir($objeto)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO cidade (nome, estado_id) VALUES (:nome, :estado_id)");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':estado_id' => $objeto->estado_id
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE cidade SET nome = :nome, estado_id = :estado_id WHERE id = :id");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':estado_id' => $objeto->estado_id,
                ':id' => $objeto->id
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM cidade WHERE id = :id");
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function listar()
    {
        $dados = [];
        try {
            $result = $this->conn->query("
                SELECT c.*, e.nome AS estado_nome
                FROM cidade c
                JOIN estado e ON c.estado_id = e.id
            ");
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
            $stmt = $this->conn->prepare("SELECT * FROM cidade WHERE id = :id");
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
