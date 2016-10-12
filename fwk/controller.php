<?php

// como todo processo vem do raix/index.php é necessário utilizar o caminho relativo
require 'fwk/view.php';

/**
* Classe base dos Controladores
**/
abstract class Controller {

    // forca que os controladores criem uma acao index por padrao
    //abstract public function index();

    // define um metodo padrao de insercao das visoes
    protected function render($viewName, $data = array()) {
        $view = new View();
        $view->render($viewName,$data);
    }
}
