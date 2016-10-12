<?php

/**
 * Roteamento da requisição
 */
class Dispatcher {

    /**
     * Convenções para uso do framework
     * Arquivos dos controladores devem serguir o padrão:
     * nomedaclasse_controlador.php
     *
     * As classes controladoras devem seguir o padrão:
     * NomedaclasseController
     */
    public function route() {
        // Verifica se o parametro controlador existe
        // sim pega o nome do controlador e concatena com o padrao do nome do arquivo
        // se nao define o home_controlador como padrao
        $arquivo_controlador = isset($_GET['controlador']) ?
                $_GET['controlador'] . '_controlador' : 'home_controlador';

        // verifica se o parametro acao existe
        // sim pega o parametro
        // se nao define index como padrao
        $acao = isset($_GET['acao']) ? $_GET['acao'] : 'index';

        // trata a string do nome do arquivo para transformar no formato esperado
        $classe_controlador = str_replace('_', ' ', $arquivo_controlador);
        $classe_controlador = ucwords($classe_controlador);
        $classe_controlador = str_replace(' ', '', $classe_controlador);

        // insere o controlador
        // caso nao exista o arquivo com o nome esperado, um erro de sistema acontece
        require_once('controladores/' . $arquivo_controlador . '.php');

        // instancia o controlador de acordo com o nome padrao esperado
        $obj = new $classe_controlador;

        // executa a acao do controlador
        $this->executarAcao($obj, $acao);
    }

    private function executarAcao($obj, $acao) {
        if (method_exists($obj, $acao)) {
            call_user_func(array($obj, $acao), $_REQUEST);
        } else {
            user_error('Acao '.$acao.' nao existe no controlador '.get_class($obj));
        }
    }

}
