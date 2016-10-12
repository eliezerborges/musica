<?php
	require_once('fwk/controller.php');
	require_once('modelos/banda.php');

class BandaControlador extends Controller {

    public function index() {
        $this->listar();
    }

    public function listar() {
        $bd = new Banda();
        $data['bandas'] = $bd->all();

        $this->render('visao/banda_listar.php', $data);
    }

    public function novo() {
        $data['acao'] = 'criar';
        $this->render('visao/banda_form.php', $data);
    }

    public function criar() {
        $validacao = $this->validaInput('criar');
        if ($validacao === true) {
            $bd = new Banda();
            $bd->criar($_POST);

            $this->listar();
        } else {
            // junta as variaveis do post com o erro para que o form possa
            // trazer os valores previamente cadastrados
            $data['bandas'] = new Banda($_POST);
            $data['erro'] = $validacao;
            $data['acao'] = 'criar';
            $this->render('visao/banda_form.php', $data);
        }
    }

    public function editar() {
        $data['bandas'] = (new Banda())->find($_GET['id_banda']);
        $data['acao'] = 'atualizar';
        $this->render('visao/banda_form.php', $data);
    }

    public function atualizar() {
        $validacao = $this->validaInput('atualizar');
        if ($validacao === true) {
            $bd = new Banda();
            $bd->atualizar($_POST);

            $this->listar();
        } else {
            // junta as variaveis do post com o erro para que o form possa
            // trazer os valores previamente cadastrados
            $data['bandas'] = new Banda($_POST);
            $data['erro'] = $validacao;
            $data['acao'] = 'atualizar';
            $this->render('visao/banda_form.php', $data);
        }
    }

    public function excluir() {
        $data['bandas'] = (new Banda())->find($_GET['id_banda']);
        if (isset($_GET['confirmado'])) {
            $data['bandas']->excluir($_GET['id_banda']);
            $this->listar();
        } else {
            $this->render('visao/bandas_excluir_form.php', $data);
        }
    }

    public function validaInput($acao) {
        $res = '';

        if (strtolower($acao) == 'atualizar') {
            if (strlen($_POST['id_banda']) == 0) {
                $res .= 'Id não identificado !! ';
            }
        }

        if (strlen($_POST['nome']) < 3) {
            $res .= 'Nome deve ter 3 caracteres ao menos !! ';
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
