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

        $data = [
            'home_links' => $defaultHomeLinks,
            'social_links' => $defaultSocialLinks,
            'store_links' => $defaultStoreLinks
        ];

        try {
            $settingsModel = $this->model('SettingsModel');
            $dbHomeLinks = $settingsModel->getSetting('home_links');
            if ($dbHomeLinks) $data['home_links'] = $dbHomeLinks;

            $dbSocialLinks = $settingsModel->getSetting('social_links');
            if ($dbSocialLinks) $data['social_links'] = $dbSocialLinks;

            $dbStoreLinks = $settingsModel->getSetting('store_links');
            if ($dbStoreLinks) $data['store_links'] = $dbStoreLinks;
        } catch (Exception $e) {
            // DB connection failed, use default hardcoded fallback silently
        }

        $this->view('home', $data);
    }
}
