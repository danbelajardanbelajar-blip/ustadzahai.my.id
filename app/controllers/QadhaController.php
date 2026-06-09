<?php
class QadhaController extends Controller {
    public function index() {
        $data = [
            'title' => 'Kalkulator Qadha Puasa & Fidyah',
            'css' => ['css/qadha.css'],
            'js' => ['js/qadha.js']
        ];
        $this->view('qadha', $data);
    }
}
