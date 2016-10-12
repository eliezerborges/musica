<?php
require_once('fwk/controller.php');
class HomeControlador extends Controller{
    function index() {
        $this->render('visao/principal_visao.php');
    }
}
