<?php
class UndanganModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function simpanUndangan($nama, $kontak, $jenis_acara, $keterangan) {
        $this->db->query('INSERT INTO undangan (nama, kontak, jenis_acara, keterangan) VALUES (:nama, :kontak, :jenis_acara, :keterangan)');
        $this->db->bind(':nama', $nama);
        $this->db->bind(':kontak', $kontak);
        $this->db->bind(':jenis_acara', $jenis_acara);
        $this->db->bind(':keterangan', $keterangan);

        return $this->db->execute();
    }
}
