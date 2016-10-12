<?php
class View {
    public function render($viewName, $data) {
        require_once $viewName;
    }
}
