<?php
require_once 'app/core/Database.php';

$db = new Database();

$sql = "
CREATE TABLE IF NOT EXISTS `undangan` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama` VARCHAR(150) NOT NULL,
  `kontak` VARCHAR(150) NOT NULL,
  `jenis_acara` VARCHAR(100) NOT NULL,
  `keterangan` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `settings` (`setting_key`, `setting_value`) VALUES
('home_links', '[{\"title\":\"Kalender<br>Fiqih Haid\",\"url\":\"index.php?url=kalender\",\"icon\":\"far fa-calendar-alt\",\"color\":\"bg-pink\"},{\"title\":\"Kalkulator<br>Fiqih Haid\",\"url\":\"index.php?url=kalkulator\",\"icon\":\"fas fa-file-invoice\",\"color\":\"bg-yellow\"},{\"title\":\"Kalkulator<br>Fiqih Nifas\",\"url\":\"index.php?url=nifas\",\"icon\":\"fas fa-calculator\",\"color\":\"bg-purple\"},{\"title\":\"Kalkulator Qodo<br>Puasa & Fidyah\",\"url\":\"index.php?url=qadha\",\"icon\":\"fas fa-list-alt\",\"color\":\"bg-orange\"},{\"title\":\"Tanya<br>Ustadzah AI\",\"url\":\"index.php?url=tanya\",\"icon\":\"far fa-comment-dots\",\"color\":\"bg-pink\"},{\"title\":\"Maktabah Haid,<br>Nifas & Istihadhoh\",\"url\":\"index.php?url=maktabah\",\"icon\":\"fas fa-book-open\",\"color\":\"bg-light-purple\"}]'),
('social_links', '[{\"title\":\"Facebook\",\"username\":\"anas.anam.507\",\"url\":\"https://m.facebook.com/anas.anam.507/\",\"icon\":\"fab fa-facebook\"},{\"title\":\"Instagram\",\"username\":\"@aimaslaily\",\"url\":\"https://www.instagram.com/aimaslaily?igsh=NjIxbGRyb3luandz\",\"icon\":\"fab fa-instagram\"},{\"title\":\"TikTok\",\"username\":\"@mamahanas\",\"url\":\"https://tiktok.com/@mamahanas\",\"icon\":\"fab fa-tiktok\"},{\"title\":\"YouTube\",\"username\":\"@maslaily\",\"url\":\"https://youtube.com/@maslaily?si=of6RFqfHUnwXlrIT\",\"icon\":\"fab fa-youtube\"}]'),
('store_links', '[{\"title\":\"Pembalut kain cuci ulang 4 picis\",\"shop\":\"Shopee\",\"url\":\"https://s.shopee.co.id/1Vwi795W8Q?share_channel_code=1\",\"image\":\"img/pad_shopee_1_orig.png\",\"icon\":\"fas fa-store\",\"special\":false},{\"title\":\"Menstrual pad / pembalut kain\",\"shop\":\"Shopee\",\"url\":\"https://s.shopee.co.id/1Vwi795W8Q?share_channel_code=1\",\"image\":\"img/pad_shopee_2_orig.png\",\"icon\":\"fas fa-store\",\"special\":false},{\"title\":\"Pembalut kain cuci ulang (3)\",\"shop\":\"TikTok Shop\",\"url\":\"https://vt.tokopedia.com/t/ZS9jeBEtV6cMj-eeo9c/\",\"image\":\"\",\"icon\":\"fas fa-shopping-bag\",\"special\":true}]');
";

try {
    $db->query($sql);
    $db->execute();
    echo "Migration successful.";
} catch (Exception $e) {
    echo "Migration failed: " . $e->getMessage();
}
