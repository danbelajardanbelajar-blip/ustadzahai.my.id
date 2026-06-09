<?php
class Controller {
    public function view($view, $data = []) {
        extract($data);
        if (file_exists('app/views/' . $view . '.php')) {
            $viewPath = 'app/views/' . $view . '.php';
            require_once 'app/views/layout.php';
        } else {
            echo "View not found: " . $view;
        }
    }
}
