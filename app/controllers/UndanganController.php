<?php
class UndanganController extends Controller {
    public function kirim() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'] ?? '';
            $kontak = $_POST['kontak'] ?? '';
            $jenis_acara = $_POST['jenis_acara'] ?? '';
            $keterangan = $_POST['keterangan'] ?? '';

            if (empty($nama) || empty($kontak) || empty($jenis_acara)) {
                echo json_encode(['status' => 'error', 'message' => 'Harap isi semua field wajib.']);
                return;
            }

            $model = $this->model('UndanganModel');
            $result = $model->simpanUndangan($nama, $kontak, $jenis_acara, $keterangan);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Undangan berhasil dikirim.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim undangan.']);
            }
        }
    }
}
