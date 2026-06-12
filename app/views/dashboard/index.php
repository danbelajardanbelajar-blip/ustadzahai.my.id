<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Ustadzah AI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background: #f8f9fa; margin: 0; color: #333; }
        .header { background: linear-gradient(90deg, #ff7396, #fa5d82); color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { margin: 0; font-size: 20px; }
        .header a { color: white; text-decoration: none; font-weight: bold; background: rgba(0,0,0,0.1); padding: 6px 12px; border-radius: 6px; }
        .container { max-width: 800px; margin: 20px auto; padding: 0 15px; }
        .card { background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h2 { margin-top: 0; color: #fb5c82; font-size: 18px; border-bottom: 2px solid #fff0f5; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center; }
        textarea { width: 100%; height: 200px; font-family: monospace; padding: 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; resize: vertical; }
        button { background: #fb5c82; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        button:hover { opacity: 0.9; }
        .msg-box { border-left: 4px solid #fb5c82; background: #fff0f5; padding: 15px; margin-bottom: 15px; border-radius: 0 8px 8px 0; }
        .msg-time { font-size: 12px; color: #666; margin-bottom: 5px; }
        .msg-title { font-weight: bold; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard Admin</h1>
        <div>
            <a href="index.php" style="margin-right: 10px;"><i class="fas fa-home"></i> Home</a>
            <a href="index.php?url=dashboard/logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>
    </div>

    <div class="container">
        <?php if(isset($data['db_error'])): ?>
            <div style="background: #fee2e2; color: #ef4444; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-triangle"></i> <?= $data['db_error'] ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h2>Pesan & Undangan Masuk</h2>
            <?php if(empty($data['messages'])): ?>
                <p style="color: #666; text-align: center;">Belum ada pesan masuk.</p>
            <?php else: ?>
                <?php foreach($data['messages'] as $msg): ?>
                    <div class="msg-box">
                        <div class="msg-time"><?= date('d M Y H:i', strtotime($msg['created_at'])) ?></div>
                        <div class="msg-title"><?= htmlspecialchars($msg['nama']) ?> (<?= htmlspecialchars($msg['kontak']) ?>) - <span style="color: #fb5c82;"><?= htmlspecialchars($msg['jenis_acara']) ?></span></div>
                        <div><?= nl2br(htmlspecialchars($msg['keterangan'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="card">
            <h2>
                Pengaturan Menu Utama (Grid Links)
                <button onclick="saveData('home_links')" style="margin-top: 0; padding: 6px 12px; font-size: 13px;"><i class="fas fa-save"></i> Simpan</button>
            </h2>
            <p style="font-size: 13px; color: #666;">Format JSON. Hati-hati saat mengedit agar format tidak rusak.</p>
            <textarea id="home_links_json"><?= json_encode($data['home_links'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?></textarea>
        </div>

        <div class="card">
            <h2>
                Pengaturan Media Sosial
                <button onclick="saveData('social_links')" style="margin-top: 0; padding: 6px 12px; font-size: 13px;"><i class="fas fa-save"></i> Simpan</button>
            </h2>
            <textarea id="social_links_json"><?= json_encode($data['social_links'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?></textarea>
        </div>

        <div class="card">
            <h2>
                Pengaturan Toko Online
                <button onclick="saveData('store_links')" style="margin-top: 0; padding: 6px 12px; font-size: 13px;"><i class="fas fa-save"></i> Simpan</button>
            </h2>
            <textarea id="store_links_json"><?= json_encode($data['store_links'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?></textarea>
        </div>
    </div>

    <script>
        function saveData(type) {
            const el = document.getElementById(type + '_json');
            const dataStr = el.value;
            
            try {
                // Validate JSON first
                JSON.parse(dataStr);
                
                const formData = new FormData();
                formData.append('type', type);
                formData.append('data', dataStr);
                
                fetch('index.php?url=dashboard/update', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        alert('Berhasil disimpan!');
                    } else {
                        alert('Gagal: ' + res.message);
                    }
                })
                .catch(err => alert('Terjadi kesalahan jaringan'));
            } catch(e) {
                alert('Format JSON tidak valid! Mohon perbaiki sebelum menyimpan.');
            }
        }
    </script>
</body>
</html>
