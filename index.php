<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'fwk/dispatcher.php';

$dispatcher = new Dispatcher();
$dispatcher->route();
