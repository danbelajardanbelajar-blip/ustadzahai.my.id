<?php
class MaktabahController extends Controller {
    public function index() {
        $data = [
            'title' => 'Maktabah',
            'css' => ['css/maktabah.css']
        ];
        $this->view('maktabah', $data);
    }
}
