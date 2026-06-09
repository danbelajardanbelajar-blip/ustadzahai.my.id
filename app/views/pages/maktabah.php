<div class="header">
    <div class="badge"><i class="fas fa-book-open"></i> Maktabah (Perpustakaan)</div>
    <h1>Referensi Fiqih Wanita</h1>
    <p>Kumpulan materi dan rujukan hukum Islam tentang haid, nifas, dan istihadhoh.</p>
</div>

<div class="content">
<style>
    .library-container {
        margin-bottom: 20px;
    }

    .library-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
        margin: 20px 0;
    }

    .book-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(92, 160, 242, 0.15);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(92, 160, 242, 0.25);
    }

    .book-thumbnail {
        width: 100%;
        height: 240px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .book-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .book-info {
        padding: 12px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-weight: 600;
        font-size: 14px;
        color: #333;
        margin: 0;
        line-height: 1.3;
        min-height: 28px;
    }

    .book-description {
        font-size: 12px;
        color: #888;
        margin: 4px 0 0 0;
        flex-grow: 1;
        line-height: 1.3;
    }

    .book-link-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: linear-gradient(135deg, #5ca0f2, #4a90e2);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        margin-top: 8px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .book-link-btn:hover {
        background: linear-gradient(135deg, #4a90e2, #3a80d2);
        transform: scale(1.05);
    }

    .library-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .library-header h2 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .library-header .icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #5ca0f2, #4a90e2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }

    @media (max-width: 600px) {
        .library-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 12px;
        }

        .book-thumbnail {
            height: 180px;
        }
    }
</style>

    <div class="page-card">
        <div class="library-header">
            <div class="icon"><i class="fas fa-book"></i></div>
            <h2>Koleksi Kitab Fiqih Haid</h2>
        </div>
        
        <div class="library-grid">
            <?php
                $books = [
                    [
                        'id' => '1tCcSScUxaiVk6xHdEho0aJNODwD0Mg2s',
                        'title' => 'Panduan Fiqih Haid',
                        'description' => 'Referensi lengkap tentang haid menurut fiqih Islam',
                    ],
                    [
                        'id' => '1_qkw_k5brGDK8sBymikgaWu7t48xNJiv',
                        'title' => 'Ketentuan Haid Madzhab Syafi\'i',
                        'description' => 'Penjelasan detail hukum haid menurut madzhab Syafi\'i',
                    ],
                    [
                        'id' => '17g7ET65PB8ZDMBkbLPHvEqRWpsYdLBm_',
                        'title' => 'Panduan Nifas',
                        'description' => 'Panduan komprehensif tentang nifas dan hukum-hukumnya',
                    ],
                    [
                        'id' => '13yEkAlu6uBH8d5ozqYuXiEdMFaWt9p0y',
                        'title' => 'Istihadhoh dan Hukumnya',
                        'description' => 'Penjelasan tentang istihadhoh dan ketentuan syariah',
                    ],
                    [
                        'id' => '16ABXPwl6yok9Gw-go-ZJzA1f3t3REEWc',
                        'title' => 'Fiqih Wanita Terapan',
                        'description' => 'Aplikasi fiqih wanita dalam kehidupan sehari-hari',
                    ],
                    [
                        'id' => '1iE1-onGvFh1Rl_r1mp6htdJBprqd9rMR',
                        'title' => 'Qodo & Fidyah',
                        'description' => 'Penjelasan tentang qodo puasa dan fidyah untuk wanita',
                    ],
                ];

                foreach ($books as $book) {
                    $driveLink = "https://drive.google.com/file/{$book['id']}/view";
                    $thumbnailUrl = "https://drive.google.com/thumbnail?id={$book['id']}&sz=w340";
                    ?>
                    <a href="<?php echo $driveLink; ?>" class="book-card" target="_blank" rel="noopener noreferrer">
                        <div class="book-thumbnail">
                            <img src="<?php echo $thumbnailUrl; ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" onerror="this.style.display='none'">
                        </div>
                        <div class="book-info">
                            <h3 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="book-description"><?php echo htmlspecialchars($book['description']); ?></p>
                            <button class="book-link-btn">
                                <i class="fas fa-external-link-alt"></i> Buka
                            </button>
                        </div>
                    </a>
                    <?php
                }
            ?>
        </div>
    </div>

    <a href="index.php?page=home" class="list-card">
        <div class="list-icon" style="background: linear-gradient(135deg, #7c4dff, #536dfe);">
            <i class="fas fa-arrow-left"></i>
        </div>
        <div class="list-text">
            <h3>Kembali ke Home</h3>
            <p>Halaman utama Ustadzah AI</p>
        </div>
    </a>
</div>
