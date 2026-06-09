<?php

class Controller
{
    protected function view(string $view, array $data = [])
    {
        extract($data, EXTR_SKIP);
        $viewPath = VIEW_ROOT . '/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo 'View file not found: ' . htmlspecialchars($viewPath);
            return;
        }

        require VIEW_ROOT . '/layout.php';
    }
}
