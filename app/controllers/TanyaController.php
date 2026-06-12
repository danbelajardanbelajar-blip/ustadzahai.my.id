<?php
class TanyaController extends Controller {
    public function index() {
        $data = [
            'title' => 'Tanya Ustadzah AI',
            'css' => ['css/tanya.css'],
            'js' => ['js/tanya.js']
        ];
        $this->view('tanya', $data);
    }
}
