<?php

require_once 'lib/database.php';

/**
* Classe equipamento sincroniza com os dados no banco de dados
* porém, note que esta implementação visa demonstrar a arquitetura
* da aplicação e não leva em consideração
* várias questões de segurança como evitar o SQL Injection.
* Também, neste exemplo, não estamos levando em consideração muitas passagens de parâmetros
* que não podem vir vazias ou retornos de SQL que possam estar vazios
**/
class Album {

    private $id_album = '';
    private $id_banda = '';
    private $nome = '';
    private $data_lancamento = '';

    //public function __construct($data = []) {
    //    $this->populateFromArray($data);
   // }

    private function populateFromArray($data) {
        $id_album = isset($data['id_album']) ? $data['id_album'] : '';
        $nome = isset($data['nome']) ? $data['nome'] : '';
        $data_lancamento = isset($data['data_lancamento']) ? $data['data_lancamento'] : '';
        $id_banda = isset($data['id_banda']) ? $data['id_banda'] : '';

        $this->id_album = $id_album;
        $this->id_banda = $id_banda;
        $this->setNome($nome);
        $this->setData_lancamento($data_lancamento);
    }

    public function getId() {
        return $this->id_album;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdBanda(){
        return $this->id_banda;
    }

    public function getData_lancamento() {
        return $this->data_lancamento;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setData_lancamento($data_lancamento) {
        $this->data_lancamento = $data_lancamento;
    }

    public function criar($data = []) {
        $db = Database::getInstance()->getConnection();
        $sql = 'INSERT INTO albuns (nome, data_lancamento, id_banda) VALUES ';
        $sql .= '(:nome, :data_lancamento, :id_banda)';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':data_lancamento', $data['data_lancamento']);
        $stmt->bindParam(':id_banda', $data['id_banda']);
        return $stmt->execute();
    }

    public function atualizar($data = []) {
        $db = Database::getInstance()->getConnection();
        $sql = 'UPDATE albuns SET
                    nome = :nome,
                    data_lancamento = :data_lancamento,
                    id_banda = :id_banda
                    WHERE id_album = :id_album';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id_album', $data['id_album'], PDO::PARAM_STR);
         $stmt->bindParam(':id_banda', $data['id_banda'], PDO::PARAM_STR);
        $stmt->bindParam(':nome', $data['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':data_lancamento', $data['data_lancamento'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function excluir($id_album) {
        $db = Database::getInstance()->getConnection();
        $sql = 'DELETE FROM albuns
                    WHERE id_album = :id_album ';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id_album', $id_album, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
    * Retorna um array com todos os equipamentos da base
    **/
    public function all() {
        $db = Database::getInstance()->getConnection();
        $res = $db->query('SELECT a.*,b.nome as banda FROM albuns a inner join bandas b on a.id_banda = b.id_banda')->fetchAll(PDO::FETCH_ASSOC);

        if ($res === false) {
            $res = [];
        }
        return $res;
    }

    /**
    * Retorna um objeto equipamento baseado na pesquisa de seu id no banco
    **/
    public function find($id_album) {
        $db = Database::getInstance()->getConnection();
        $sql = 'SELECT * FROM albuns WHERE id_album = :id_album ';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_album', $id_album);

        $stmt->execute();
        $res= $stmt->fetch(PDO::FETCH_ASSOC);

        $this->populateFromArray($res);

        return $this;
    }

}
