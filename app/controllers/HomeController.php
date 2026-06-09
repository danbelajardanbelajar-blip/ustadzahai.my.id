<?php
class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Ustadzah AI'
        ];
        $this->view('home', $data);
    }
}
