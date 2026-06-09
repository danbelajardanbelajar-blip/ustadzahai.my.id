<div class="header">
    <div class="badge"><i class="fas fa-calculator"></i> Kalkulator Fiqih Haid</div>
    <h1>Hitung Periode Haid</h1>
    <p>Tentukan status fiqih dari durasi haid Anda.</p>
</div>

<div class="content">
    <div class="page-card">
        <h2>Masukkan Data Haid</h2>
        <form style="display: flex; flex-direction: column; gap: 12px;">
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Hari Pertama Haid</label>
                <input type="date" id="haidStart" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Hari Terakhir Haid</label>
                <input type="date" id="haidEnd" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <button type="button" onclick="hitungHaid()" style="padding: 12px; background: linear-gradient(135deg, #ff6b9d, #ff477e); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                <i class="fas fa-calculate"></i> Hitung
            </button>
        </form>
        
        <div id="hasil" style="margin-top: 20px; display: none;">
            <h3 style="color: #333; margin-bottom: 12px;">Hasil Perhitungan</h3>
            <div style="background: #f9f9f9; padding: 12px; border-radius: 8px; border-left: 4px solid #ff6b9d;">
                <p style="margin: 6px 0;"><strong>Durasi Haid:</strong> <span id="durasi">-</span> hari</p>
                <p style="margin: 6px 0;"><strong>Status Fiqih:</strong> <span id="status">-</span></p>
                <p style="margin: 6px 0;"><strong>Penjelasan:</strong> <span id="penjelasan" style="font-size: 12px; color: #666;">-</span></p>
            </div>
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

<script>
function hitungHaid() {
    const start = new Date(document.getElementById('haidStart').value);
    const end = new Date(document.getElementById('haidEnd').value);
    
    if (isNaN(start) || isNaN(end)) {
        alert('Silakan masukkan tanggal dengan benar');
        return;
    }
    
    const durasi = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;
    let status, penjelasan;
    
    if (durasi < 1) {
        status = 'Data tidak valid';
        penjelasan = 'Tanggal akhir harus setelah tanggal awal';
    } else if (durasi <= 10) {
        status = 'Haid Sah (حيض)';
        penjelasan = 'Haid Madzhab Syafi\'i antara 1-10 hari. Istirahat minimal 15 hari sebelum haid berikutnya';
    } else if (durasi <= 15) {
        status = 'Haid atau Istihadhoh';
        penjelasan = 'Jika kebiasaan Anda 10 hari ke bawah = Haid. Jika lebih = Istihadhoh';
    } else {
        status = 'Istihadhoh (استحاضة)';
        penjelasan = 'Pendarahan abnormal yang melebihi 15 hari. Wudhu disetiap waktu shalat, boleh berpuasa dan shalat';
    }
    
    document.getElementById('durasi').textContent = durasi;
    document.getElementById('status').textContent = status;
    document.getElementById('penjelasan').textContent = penjelasan;
    document.getElementById('hasil').style.display = 'block';
}
</script>
