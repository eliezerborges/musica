<?php
    require_once('fwk/controller.php');
    require_once('modelos/album.php');
    require_once('modelos/banda.php');

class AlbumControlador extends Controller {

    public function index() {
        $this->listar();
    }

    public function listar() {
        $al = new Album();
        $data['albuns'] = $al->all();
        $bd = new Banda();
        $data['bandas'] = $bd->all();
        $this->render('visao/album_listar.php', $data);
    }

    public function novo() {
        $bd = new Banda();
        $data['bandas'] = $bd->all();
        $data['acao'] = 'criar';
        $this->render('visao/album_form.php', $data);
    }

    public function criar() {
        $validacao = $this->validaInput('criar');
        if ($validacao === true) {
            $al = new Album();
            $al->criar($_POST);

            $this->listar();
        } else {
            // junta as variaveis do post com o erro para que o form possa
            // trazer os valores previamente cadastrados
            $data['albuns'] = new Album($_POST);
            $data['erro'] = $validacao;
            $data['acao'] = 'criar';
            $this->render('visao/album_form.php', $data);
        }
    }

    public function editar() {
        $data['albuns'] = (new Album())->find($_GET['id_album']);
        $bd = new Banda();
        $data['bandas'] = $bd->all();
        $data['acao'] = 'atualizar';
        $this->render('visao/album_form.php', $data);
    }

    public function atualizar() {
        $validacao = $this->validaInput('atualizar');
        if ($validacao === true) {
            $al = new Album();
            $al->atualizar($_POST);

            $this->listar();
        } else {
            // junta as variaveis do post com o erro para que o form possa
            // trazer os valores previamente cadastrados
            $data['albuns'] = new Album($_POST);
            $data['erro'] = $validacao;
            $data['acao'] = 'atualizar';
            $this->render('visao/album_form.php', $data);
        }
    }

    public function excluir() {
        $data['albuns'] = (new Album())->find($_GET['id_album']);
        if (isset($_GET['confirmado'])) {
            $data['albuns']->excluir($_GET['id_album']);
            $this->listar();
        } else {
            $this->render('visao/album_excluir_form.php', $data);
        }
    }

    public function validaInput($acao) {
        $res = '';

        if (strtolower($acao) == 'atualizar') {
            if (strlen($_POST['id_album']) == 0) {
                $res .= 'Id não identificado !! ';
            }
        }

        /*if ($_POST['id_banda'] == '') {
          $res .= 'È necessario selecionar uma banda para efetuar o cadastro do album. ';
        }*/             
       if ($res == '') {
            return true;
        } else {
            return $res;
        }
    }
}
