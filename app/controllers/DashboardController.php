<?php
class DashboardController extends Controller {
    private function checkAuth() {
        session_start();
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: index.php?url=dashboard/login');
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        
        $settingsModel = $this->model('SettingsModel');
        
        $data = [
            'home_links' => $settingsModel->getSetting('home_links') ?? [],
            'social_links' => $settingsModel->getSetting('social_links') ?? [],
            'store_links' => $settingsModel->getSetting('store_links') ?? [],
            'tabel_links' => $settingsModel->getSetting('tabel_links') ?? [],
            'kajian_info' => $settingsModel->getSetting('kajian_info') ?? []
        ];

        // Fetch messages if UndanganModel exists and is connected
        try {
            $db = new Database();
            $db->query('SELECT * FROM undangan ORDER BY created_at DESC');
            $data['messages'] = $db->resultSet();
        } catch (Exception $e) {
            $data['messages'] = [];
            $data['db_error'] = 'Tidak dapat terhubung ke database untuk melihat pesan.';
        }

        $this->view('dashboard/index', $data);
    }

    public function login() {
        session_start();
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: index.php?url=dashboard');
            exit;
        }

        $data = ['error' => ''];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'] ?? '';
            // Simple hardcoded password for now
            if ($password === 'admin123') {
                $_SESSION['admin_logged_in'] = true;
                header('Location: index.php?url=dashboard');
                exit;
            } else {
                $data['error'] = 'Password salah!';
            }
        }
        $this->view('dashboard/login', $data);
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?url=dashboard/login');
        exit;
    }

    public function update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = $_POST['type'] ?? '';
            $json_data = $_POST['data'] ?? '';
            
            $decoded = json_decode($json_data, true);
            if ($decoded !== null) {
                $settingsModel = $this->model('SettingsModel');
                $settingsModel->updateSetting($type, $decoded);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Format data tidak valid']);
            }
        }
    }
}
