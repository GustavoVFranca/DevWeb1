<?php
include_once __DIR__ . "/PessoaLivroDAO.php";

class PDOPessoaLivroDAO extends PessoaLivroDAO
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
            self::$instance = new PDOPessoaLivroDAO();
        return self::$instance;
    }

    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/../banco.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS pessoa_livro (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    pessoa_id INTEGER NOT NULL,
                    livro_id INTEGER NOT NULL,
                    data_emprestimo TEXT,
                    prazo TEXT,
                    FOREIGN KEY (pessoa_id) REFERENCES pessoa(id),
                    FOREIGN KEY (livro_id) REFERENCES livro(id)
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
                INSERT INTO pessoa_livro (pessoa_id, livro_id, data_emprestimo, prazo)
                VALUES (:pessoa_id, :livro_id, :data_emprestimo, :prazo)
            ");
            $stmt->execute([
                ':pessoa_id' => $objeto->pessoa_id,
                ':livro_id' => $objeto->livro_id,
                ':data_emprestimo' => $objeto->data_emprestimo,
                ':prazo' => $objeto->prazo
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare("
                UPDATE pessoa_livro
                SET pessoa_id = :pessoa_id, livro_id = :livro_id,
                    data_emprestimo = :data_emprestimo, prazo = :prazo
                WHERE id = :id
            ");
            $stmt->execute([
                ':pessoa_id' => $objeto->pessoa_id,
                ':livro_id' => $objeto->livro_id,
                ':data_emprestimo' => $objeto->data_emprestimo,
                ':prazo' => $objeto->prazo,
                ':id' => $objeto->id
            ]);
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM pessoa_livro WHERE id = :id");
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
                SELECT pl.*, p.nome AS pessoa_nome, l.nome AS livro_nome
                FROM pessoa_livro pl
                JOIN pessoa p ON pl.pessoa_id = p.id
                JOIN livro l ON pl.livro_id = l.id
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
            $stmt = $this->conn->prepare("SELECT * FROM pessoa_livro WHERE id = :id");
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
