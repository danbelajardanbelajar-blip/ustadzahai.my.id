<?php

class PageController extends Controller
{
    public function home()
    {
        $this->view('pages/home', [
            'title' => 'Ustadzah AI - Panduan Fiqih Wanita',
        ]);
    }

    public function kalenderFiqihHaid()
    {
        $this->view('pages/kalender-fiqih-haid', [
            'title' => 'Kalender Fiqih Haid',
        ]);
    }

    public function kalkulatorFiqihHaid()
    {
        $this->view('pages/kalkulator-fiqih-haid', [
            'title' => 'Kalkulator Fiqih Haid',
        ]);
    }

    public function kalkulatorFiqihNifas()
    {
        $this->view('pages/kalkulator-fiqih-nifas', [
            'title' => 'Kalkulator Fiqih Nifas',
        ]);
    }

    public function kalkulatorQodoFidyah()
    {
        $this->view('pages/kalkulator-qodo-fidyah', [
            'title' => 'Kalkulator Qodo Puasa & Fidyah',
        ]);
    }

    public function tanyaUstadzahAi()
    {
        $this->view('pages/tanya-ustadzah-ai', [
            'title' => 'Tanya Ustadzah AI',
        ]);
    }

    public function maktabah()
    {
        $this->view('pages/maktabah', [
            'title' => 'Maktabah Haid, Nifas & Istihadhoh',
        ]);
    }

    public function alatPembuatTabelHaid()
    {
        $this->view('pages/alat-pembuat-tabel-haid', [
            'title' => 'Alat Pembuat Tabel Haid',
        ]);
    }

    public function tabelHaid()
    {
        $this->view('pages/tabel-haid', [
            'title' => 'Tabel Haid',
        ]);
    }

    public function tabelNifas()
    {
        $this->view('pages/tabel-nifas', [
            'title' => 'Tabel Nifas',
        ]);
    }

    public function notFound()
    {
        http_response_code(404);
        $this->view('pages/not-found', [
            'title' => 'Halaman Tidak Ditemukan',
        ]);
    }
}
