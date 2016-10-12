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
class Banda {

    private $id_banda = '';
    private $nome = '';
    private $guitarrista = '';
    private $vocalista = '';
    private $baterista = '';
    private $genero = '';

    public function __construct($data = []) {
        $this->populateFromArray($data);
    }

    private function populateFromArray($data) {
        $id_banda = isset($data['id_banda']) ? $data['id_banda'] : '';
        $nome = isset($data['nome']) ? $data['nome'] : '';
        $guitarrista = isset($data['guitarrista']) ? $data['guitarrista'] : '';
        $vocalista = isset($data['vocalista']) ? $data['vocalista'] : '';
        $baterista = isset($data['baterista']) ? $data['baterista'] : '';
        $genero = isset($data['genero']) ? $data['genero'] : '';

        $this->id_banda = $id_banda;
        $this->setNome($nome);
        $this->setGuitarrista($guitarrista);
        $this->setVocalista($vocalista);
        $this->setBaterista($baterista);
        $this->setGenero($genero);
    }

    public function getId() {
        return $this->id_banda;
    }

    public function getNomeBanda() {
        return $this->nome;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getGuitarrista(){
        return $this->guitarrista;
    }

    public function getVocalista(){
        return $this->vocalista;
    }

    public function getBaterista(){
        return $this->baterista;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setGuitarrista($guitarrista){
        $this->guitarrista = $guitarrista;
    }

    public function setVocalista($vocalista){
        $this->vocalista = $vocalista;
    }

    public function setBaterista($baterista){
        $this->baterista = $baterista;
    }

    public function criar($data = []) {
        $db = Database::getInstance()->getConnection();
        $sql = 'INSERT INTO bandas (nome, guitarrista, vocalista, baterista, genero) VALUES ';
        $sql .= '(:nome, :guitarrista, :vocalista, :baterista, :genero)';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':guitarrista', $data['guitarrista']);
        $stmt->bindParam(':vocalista', $data['vocalista']);
        $stmt->bindParam(':baterista', $data['baterista']);
        $stmt->bindParam(':genero', $data['genero']);

        return $stmt->execute();
    }

    public function atualizar($data = []) {
        $db = Database::getInstance()->getConnection();
        $sql = 'UPDATE bandas SET
                    nome = :nome,
                    guitarrista = :guitarrista,
                    vocalista = :vocalista,
                    baterista = :baterista,
                    genero = :genero
                    WHERE id_banda = :id_banda ';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id_banda', $data['id_banda'], PDO::PARAM_STR);
        $stmt->bindParam(':nome', $data['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':guitarrista', $data['guitarrista'], PDO::PARAM_STR);
        $stmt->bindParam(':vocalista', $data['vocalista'], PDO::PARAM_INT);
        $stmt->bindParam(':baterista', $data['baterista'], PDO::PARAM_INT);
        $stmt->bindParam(':genero', $data['genero'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluir($id_banda) {
        $db = Database::getInstance()->getConnection();
        $sql = 'DELETE FROM bandas
                    WHERE id_banda = :id_banda ';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id_banda', $id_banda, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
    * Retorna um array com todos os equipamentos da base
    **/
    public function all() {
        $db = Database::getInstance()->getConnection();
        $res = $db->query('SELECT * FROM bandas')->fetchAll(PDO::FETCH_ASSOC);
        if ($res === false) {
            $res = [];
        }
        return $res;
    }

    /**
    * Retorna um objeto equipamento baseado na pesquisa de seu id no banco
    **/
    public function find($id_banda) {
        $db = Database::getInstance()->getConnection();
        $sql = 'SELECT * FROM bandas WHERE id_banda = :id_banda ';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_banda', $id_banda);

        $stmt->execute();
        $res= $stmt->fetch(PDO::FETCH_ASSOC);

        $this->populateFromArray($res);

        return $this;
    }

}
