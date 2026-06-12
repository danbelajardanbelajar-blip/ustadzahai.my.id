<?php
class HomeController extends Controller {
    public function index() {
        // Fallback default data in case DB fails
        $defaultHomeLinks = [
            ["title" => "Kalender<br>Fiqih Haid", "url" => "index.php?url=kalender", "icon" => "far fa-calendar-alt", "color" => "bg-pink"],
            ["title" => "Kalkulator<br>Fiqih Haid", "url" => "index.php?url=kalkulator", "icon" => "fas fa-file-invoice", "color" => "bg-yellow"],
            ["title" => "Kalkulator<br>Fiqih Nifas", "url" => "index.php?url=nifas", "icon" => "fas fa-calculator", "color" => "bg-purple"],
            ["title" => "Kalkulator Qodo<br>Puasa & Fidyah", "url" => "index.php?url=qadha", "icon" => "fas fa-list-alt", "color" => "bg-orange"],
            ["title" => "Tanya<br>Ustadzah AI", "url" => "index.php?url=tanya", "icon" => "far fa-comment-dots", "color" => "bg-pink"],
            ["title" => "Maktabah Haid,<br>Nifas & Istihadhoh", "url" => "index.php?url=maktabah", "icon" => "fas fa-book-open", "color" => "bg-light-purple"]
        ];

        $defaultSocialLinks = [
            ["title" => "Facebook", "username" => "anas.anam.507", "url" => "https://m.facebook.com/anas.anam.507/", "icon" => "fab fa-facebook"],
            ["title" => "Instagram", "username" => "@aimaslaily", "url" => "https://www.instagram.com/aimaslaily?igsh=NjIxbGRyb3luandz", "icon" => "fab fa-instagram"],
            ["title" => "TikTok", "username" => "@mamahanas", "url" => "https://tiktok.com/@mamahanas", "icon" => "fab fa-tiktok"],
            ["title" => "YouTube", "username" => "@maslaily", "url" => "https://youtube.com/@maslaily?si=of6RFqfHUnwXlrIT", "icon" => "fab fa-youtube"]
        ];

        $defaultStoreLinks = [
            ["title" => "Pembalut kain cuci ulang 4 picis", "shop" => "Shopee", "url" => "https://s.shopee.co.id/1Vwi795W8Q?share_channel_code=1", "image" => "img/pad_shopee_1_orig.png", "icon" => "fas fa-store", "special" => false],
            ["title" => "Menstrual pad / pembalut kain", "shop" => "Shopee", "url" => "https://s.shopee.co.id/1Vwi795W8Q?share_channel_code=1", "image" => "img/pad_shopee_2_orig.png", "icon" => "fas fa-store", "special" => false],
            ["title" => "Pembalut kain cuci ulang (3)", "shop" => "TikTok Shop", "url" => "https://vt.tokopedia.com/t/ZS9jeBEtV6cMj-eeo9c/", "image" => "", "icon" => "fas fa-shopping-bag", "special" => true]
        ];

        $defaultTabelLinks = [
            ["title" => "Tabel Haid", "desc" => "Buat tabel haid untuk memudahkan menggambarkan kasus haid dan istihadoh", "url" => "index.php?url=tabel", "icon" => "fas fa-table", "color" => "#f3e8ff", "text_color" => "#8c52ff"],
            ["title" => "Tabel Nifas", "desc" => "Buat tabel nifas untuk memudahkan menggambarkan nifas mumayyizah, goiru mumayyizah, mustahadoh finnifas", "url" => "#", "icon" => "fas fa-border-all", "color" => "#f0f7ff", "text_color" => "#3b82f6"],
            ["title" => "Tabel Mutahayyiroh", "desc" => "Tabel khusus mutahayyiroh nisbiyah, agar memudahkan dalam menggambarkan masa yakin haid , yakin suci , haid masykuk, suci masykuk , nifas masykuk", "url" => "#", "icon" => "fas fa-list-ul", "color" => "#fff0e6", "text_color" => "#f97316"],
            ["title" => "Struktur Haid", "desc" => "Buat struktur haid , nifas , mustahadoh, dll", "url" => "#", "icon" => "fas fa-pen-nib", "color" => "#e6f4ea", "text_color" => "#22c55e"]
        ];

        $defaultKajianInfo = [
            "title" => "Kajian fiqih haid via Google meet gratis",
            "time" => "Setiap selasa jam 8 malam",
            "desc" => "Kajian fiqih haid nifas dan istihadhoh menggunakan buku Khulashoh Fiqih Haid di bawah ust / ustadzah...",
            "wa_url" => "https://wa.me/6285248704900"
        ];

        $data = [
            'home_links' => $defaultHomeLinks,
            'social_links' => $defaultSocialLinks,
            'store_links' => $defaultStoreLinks,
            'tabel_links' => $defaultTabelLinks,
            'kajian_info' => $defaultKajianInfo
        ];

        try {
            $settingsModel = $this->model('SettingsModel');
            
            $dbHomeLinks = $settingsModel->getSetting('home_links');
            if ($dbHomeLinks) $data['home_links'] = $dbHomeLinks;

            $dbSocialLinks = $settingsModel->getSetting('social_links');
            if ($dbSocialLinks) $data['social_links'] = $dbSocialLinks;

            $dbStoreLinks = $settingsModel->getSetting('store_links');
            if ($dbStoreLinks) $data['store_links'] = $dbStoreLinks;

            $dbTabelLinks = $settingsModel->getSetting('tabel_links');
            if ($dbTabelLinks) $data['tabel_links'] = $dbTabelLinks;

            $dbKajianInfo = $settingsModel->getSetting('kajian_info');
            if ($dbKajianInfo) $data['kajian_info'] = $dbKajianInfo;
        } catch (Exception $e) {
            // DB connection failed, use default hardcoded fallback silently
        }

        $this->view('home', $data);
    }
}
