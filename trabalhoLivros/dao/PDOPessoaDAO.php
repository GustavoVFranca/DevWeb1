<?php
include_once __DIR__ . "/PessoaDAO.php";

class PDOPessoaDAO extends PessoaDAO
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
            self::$instance = new PDOPessoaDAO();
        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/../banco.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS pessoa (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome TEXT NOT NULL,
                    cidade_id INTEGER NOT NULL,
                    peso REAL,
                    altura REAL,
                    FOREIGN KEY (cidade_id) REFERENCES cidade(id)
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
                INSERT INTO pessoa (nome, cidade_id, peso, altura)
                VALUES (:nome, :cidade_id, :peso, :altura)
            ");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':cidade_id' => $objeto->cidade_id,
                ':peso' => $objeto->peso,
                ':altura' => $objeto->altura
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare("
                UPDATE pessoa
                SET nome = :nome, cidade_id = :cidade_id, peso = :peso, altura = :altura
                WHERE id = :id
            ");
            $stmt->execute([
                ':nome' => $objeto->nome,
                ':cidade_id' => $objeto->cidade_id,
                ':peso' => $objeto->peso,
                ':altura' => $objeto->altura,
                ':id' => $objeto->id
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM pessoa WHERE id = :id");
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
                SELECT p.*, c.nome AS cidade_nome
                FROM pessoa p
                JOIN cidade c ON p.cidade_id = c.id
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
            $stmt = $this->conn->prepare("SELECT * FROM pessoa WHERE id = :id");
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
