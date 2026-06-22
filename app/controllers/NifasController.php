<?php
class NifasController extends Controller {
    public function index() {
        $data = [
            'title' => 'Kalkulator Fiqih Nifas',
            'css' => ['css/nifas-react.css']
        ];
        $this->view('nifas', $data);
    }
}
