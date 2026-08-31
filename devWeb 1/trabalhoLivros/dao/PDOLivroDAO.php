<?php
include_once __DIR__ . "/LivroDAO.php";

class PDOLivroDAO extends LivroDAO
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
            self::$instance = new PDOLivroDAO();
        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/../banco.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS livro (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome TEXT NOT NULL,
                    autor TEXT NOT NULL,
                    genero TEXT NOT NULL,
                    descricao TEXT
                );
            ");
        } catch (PDOException $e) {
            echo 'Erro na conexao com o banco: ' . $e->getMessage();
        }
    }

    function inserir($objeto)
    {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO livro (nome, autor, genero, descricao)
                VALUES (:nome, :autor, :genero, :descricao)
            ");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':autor' => $objeto->autor,
                ':genero' => $objeto->genero,
                ':descricao' => $objeto->descricao
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare("
                UPDATE livro
                SET nome = :nome, autor = :autor, genero = :genero, descricao = :descricao
                WHERE id = :id
            ");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':autor' => $objeto->autor,
                ':genero' => $objeto->genero,
                ':descricao' => $objeto->descricao,
                ':id' => $objeto->id
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM livro WHERE id = :id");
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function listar()
    {
        $dados = [];
        try {
            $result = $this->conn->query("SELECT * FROM livro");
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
            $stmt = $this->conn->prepare("SELECT * FROM livro WHERE id = :id");
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
