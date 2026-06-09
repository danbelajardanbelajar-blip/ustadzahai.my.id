<?php
class NifasController extends Controller {
    public function index() {
        $data = [
            'title' => 'Kalkulator Fiqih Nifas',
            'css' => ['css/nifas.css'],
            'js' => ['js/nifas.js']
        ];
        $this->view('nifas', $data);
    }
}
