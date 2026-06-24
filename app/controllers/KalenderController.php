<?php
class KalenderController extends Controller {
    public function index() {
        $data = [
            'title' => 'Kalender Fiqih Haid',
            'css' => [],
            'js' => []
        ];
        $this->view('kalender', $data);
    }
}
