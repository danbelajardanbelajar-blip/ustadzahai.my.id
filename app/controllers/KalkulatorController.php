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

    public function analisa() {
        // Handle AJAX POST Request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            $kategori = $input['kategori'] ?? 'mubtadaah';
            $tglLahir = $input['tglLahir'] ?? null;
            $jamLahir = $input['jamLahir'] ?? null;
            $adatHaid = $input['adatHaid'] ?? 0;
            $adatSuci = $input['adatSuci'] ?? 0;
            $darahBlocks = $input['darah'] ?? [];

            $result = FiqhKalkulator::analisa($kategori, $tglLahir, $jamLahir, $adatHaid, $adatSuci, $darahBlocks);

            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }
}
