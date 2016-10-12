<?php
	require_once('fwk/controller.php');
	require_once('modelos/musica.php');
    require_once('modelos/banda.php');
    require_once('modelos/album.php');

class MusicaControlador extends Controller {

    public function index() {
        $this->listar();
    }

    public function listar() {
        $al = new Album();
        $data['albuns'] = $al->all();
        $bd = new Banda();
        $data['bandas'] = $bd->all();
        $ms = new Musica();
        $data['musicas'] = $ms->all();

        $this->render('visao/musica_listar.php', $data);
    }

    public function novo() {
        $al = new Album();
        $data['albuns'] = $al->all();
        $bd = new Banda();
        $data['bandas'] = $bd->all();
        $data['acao'] = 'criar';
        $this->render('visao/musica_form.php', $data);
    }

    public function criar() {
        $validacao = $this->validaInput('criar');
        if ($validacao === true) {
            $ms = new Musica();
            $ms->criar($_POST);

            $this->listar();
        } else {
            // junta as variaveis do post com o erro para que o form possa
            // trazer os valores previamente cadastrados
            $data['musicas'] = new Musica($_POST);
            $data['erro'] = $validacao;
            $data['acao'] = 'criar';
            $this->render('visao/musica_form.php', $data);
        }
    }

    public function editar() {
        $al = new Album();
        $data['albuns'] = $al->all();
        $bd = new Banda();
        $data['bandas'] = $bd->all();
        $data['musicas'] = (new Musica())->find($_GET['id']);
        $data['acao'] = 'atualizar';
        $this->render('visao/musica_form.php', $data);
    }

    public function atualizar() {
        $validacao = $this->validaInput('atualizar');
        if ($validacao === true) {
            $eq = new Musica();
            $eq->atualizar($_POST);

            $this->listar();
        } else {
            // junta as variaveis do post com o erro para que o form possa
            // trazer os valores previamente cadastrados
            $data['musicas'] = new Musica($_POST);
            $data['erro'] = $validacao;
            $data['acao'] = 'atualizar';
            $this->render('visao/musica_form.php', $data);
        }
    }

    public function excluir() {
        $data['musicas'] = (new Musica())->find($_GET['id']);
        $al = new Album();
        $data['albuns'] = $al->all();
        $bd = new Banda();
        $data['bandas'] = $bd->all();
        if (isset($_GET['confirmado'])) {
            $data['musicas']->excluir($_GET['id']);
            $this->listar();
        } else {
            $this->render('visao/musica_excluir_form.php', $data);
        }
    }

    public function validaInput($acao) {
        $res = '';

        if (strtolower($acao) == 'atualizar') {
            if (strlen($_POST['id']) == 0) {
                $res .= 'Id não identificado !!</br> ';
            }
        }

        if (strlen($_POST['nome']) < 3) {
            $res .= 'Nome deve ter 3 caracteres ao menos !! </br>';
        }

        if (strlen($_POST['id_album']) == '') {
            $res .= 'Selecione um album pra cadastrar a musica!</br>';
        }

        if (strlen($_POST['id_banda']) == '') {
            $res .= 'Selecione uma banda pra cadastrar a musica!</br>';
        }

        if (strlen($_POST['genero']) == '') {
            $res .= 'Insira o genero musical.</br>';
        }

        
        //if (strlen($_POST['cor']) < 3) {
         //   $res .= 'Cor deve ter 3 caracteres ao menos !! ';
       // }

       // if (is_numeric($_POST['ano']) === false) {
       //     $res .= 'Ano deve ser um número !! ';
       // } else if (strlen($_POST['ano']) != 4) {
       //     $res .= 'Ano deve ser um número de 4 dígitos !! ';
       // }

        if ($res == '') {
            return true;
        } else {
            return $res;
        }
    }
}
