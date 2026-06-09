<?php

class App
{
    protected $controller = 'PageController';
    protected $method = 'home';
    protected $routes = [];

    public function __construct()
    {
        $this->routes = [
            'home' => 'home',
            'kalender-fiqih-haid' => 'kalenderFiqihHaid',
            'kalkulator-fiqih-haid' => 'kalkulatorFiqihHaid',
            'kalkulator-fiqih-nifas' => 'kalkulatorFiqihNifas',
            'kalkulator-qodo-fidyah' => 'kalkulatorQodoFidyah',
            'tanya-ustadzah-ai' => 'tanyaUstadzahAi',
            'maktabah' => 'maktabah',
            'alat-pembuat-tabel-haid' => 'alatPembuatTabelHaid',
            'tabel-haid' => 'tabelHaid',
            'tabel-nifas' => 'tabelNifas',
        ];

        $page = $_GET['page'] ?? 'home';
        $this->method = $this->routes[$page] ?? 'notFound';

        require_once APP_ROOT . '/controllers/PageController.php';
        $this->controller = new PageController();

        if (method_exists($this->controller, $this->method)) {
            call_user_func([$this->controller, $this->method]);
        } else {
            $this->controller->notFound();
        }
    }
}
