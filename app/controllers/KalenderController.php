<?php
class KalenderController extends Controller {
    public function index() {
        $data = [
            'title' => 'Kalender Fiqih Haid',
            'css' => ['css/kalender.css'],
            'js' => ['js/kalender.js']
        ];
        $this->view('kalender', $data);
    }
}
