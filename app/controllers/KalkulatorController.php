<?php
class KalkulatorController extends Controller {
    public function index() {
        $data = [
            'title' => 'Kalkulator Fiqih Haid',
            'css' => ['css/kalkulator.css'],
            'js' => ['js/kalkulator.js']
        ];
        $this->view('kalkulator', $data);
    }
}
