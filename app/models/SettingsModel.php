<?php
class SettingsModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getSetting($key) {
        $this->db->query('SELECT setting_value FROM settings WHERE setting_key = :key');
        $this->db->bind(':key', $key);
        $result = $this->db->single();
        if ($result) {
            return json_decode($result['setting_value'], true);
        }
        return null;
    }

    public function updateSetting($key, $value) {
        $json_value = json_encode($value);
        $this->db->query('UPDATE settings SET setting_value = :value WHERE setting_key = :key');
        $this->db->bind(':value', $json_value);
        $this->db->bind(':key', $key);
        return $this->db->execute();
    }
}
