<?php
class ApiController extends Controller {
    public function index() {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
        
        // Intercept Login Route
        if (strpos($url, 'api/apps/auth/login') !== false) {
            echo "<!DOCTYPE html><html><head><meta charset=\"UTF-8\"><title>Login</title></head><body>";
            echo "<script>alert('Fitur login/sinkronisasi cloud tidak tersedia pada versi kloning ini. Data Anda akan tetap tersimpan secara lokal di perangkat.'); window.history.back();</script>";
            echo "</body></html>";
            exit;
        }

        $targetUrl = 'https://kalender-haid.base44.app/' . $url;
        
        $queryString = '';
        if (!empty($_SERVER['QUERY_STRING'])) {
            // Remove 'url=...' from query string
            $queryString = preg_replace('/(^|&)url=[^&]*/', '', $_SERVER['QUERY_STRING']);
            $queryString = ltrim($queryString, '&');
        }
        
        if ($queryString) {
            $targetUrl .= '?' . $queryString;
        }
        
        header('Location: ' . $targetUrl);
        exit;
    }
}
