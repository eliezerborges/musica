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
class Musica {

    private $id = '';
    private $nome = '';
    private $id_banda = '';
    private $id_album = '';
    private $data_lancamento = '';
    private $genero = '';

    public function __construct($data = []) {
        $this->populateFromArray($data);
    }

    private function populateFromArray($data) {
        $id = isset($data['id']) ? $data['id'] : '';
        $nome = isset($data['nome']) ? $data['nome'] : '';
        $id_banda = isset($data['id_banda']) ? $data['id_banda'] : '';
        $id_album = isset($data['id_album']) ? $data['id_album'] : '';
        $data_lancamento = isset($data['data_lancamento']) ? $data['data_lancamento'] : '';
        $genero = isset($data['genero']) ? $data['genero'] : '';

        $this->id = $id;
        $this->setNome($nome);
        $this->setIdAlbum($id_album);
        $this->setIdBanda($id_banda);

        $this->setData_lancamento($data_lancamento);
        $this->setGenero($genero);
    }

    public function getId() {
        return $this->id;
    }

    public function getNomeMusica() {
        return $this->nome;
    }

    public function getIdBanda() {
        return $this->id_banda;
    }

    public function getIdAlbum() {
        return $this->id_album;
    }

    public function getData_lancamento() {
        return $this->data_lancamento;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setIdBanda($id_banda) {
        $this->id_banda = $id_banda;
    }

    public function setIdAlbum($id_album) {
        $this->id_album = $id_album;
    }

    public function setData_lancamento($data_lancamento) {
        $this->data_lancamento = $data_lancamento;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function criar($data = []) {
        $db = Database::getInstance()->getConnection();
        $sql = 'INSERT INTO musicas (nome, id_banda, id_album, data_lancamento, genero) VALUES ';
        $sql .= '(:nome, :id_banda, :id_album, :data_lancamento, :genero)';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':id_banda', $data['id_banda']);
        $stmt->bindParam(':id_album', $data['id_album']);
        $stmt->bindParam(':data_lancamento', $data['data_lancamento']);
        $stmt->bindParam(':genero', $data['genero']);

        return $stmt->execute();
    }

    public function atualizar($data = []) {
        $db = Database::getInstance()->getConnection();
        $sql = 'UPDATE musicas SET
                    nome = :nome,
                    id_banda = :id_banda,
                    id_album = :id_album,
                    data_lancamento = :data_lancamento,
                    genero = :genero
                    WHERE id = :id ';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id', $data['id'], PDO::PARAM_STR);
        $stmt->bindParam(':nome', $data['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':id_banda', $data['id_banda'], PDO::PARAM_STR);
        $stmt->bindParam(':id_album', $data['id_album'], PDO::PARAM_INT);
        $stmt->bindParam(':data_lancamento', $data['data_lancamento'], PDO::PARAM_INT);
        $stmt->bindParam(':genero', $data['genero'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluir($id) {
        $db = Database::getInstance()->getConnection();
        $sql = 'DELETE FROM musicas
                    WHERE id = :id ';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
    * Retorna um array com todos os equipamentos da base
    **/
    public function all() {
        $db = Database::getInstance()->getConnection();
        $res = $db->query('SELECT m.*,a.nome as album,b.nome as banda 
        FROM musicas m
        inner join albuns a on m.id_album = a.id_album
        inner join bandas b on m.id_banda = b.id_banda'
        )->fetchAll(PDO::FETCH_ASSOC);

        if ($res === false) {
            $res = [];
        }
        return $res;
    }

    /**
    * Retorna um objeto equipamento baseado na pesquisa de seu id no banco
    **/
    public function find($id) {
        $db = Database::getInstance()->getConnection();
        $sql = 'SELECT * FROM musicas WHERE id = :id ';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        $res= $stmt->fetch(PDO::FETCH_ASSOC);

        $this->populateFromArray($res);

        return $this;
    }

}
