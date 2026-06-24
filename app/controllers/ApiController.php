<?php
class ApiController extends Controller {
    public function index() {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
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
