<style>
    * {
        box-sizing: border-box;
    }

    body {
        background: #f5f5f5;
    }

    .header {
        background: linear-gradient(135deg, #f8e4f1, #f0d8eb);
        padding: 24px;
        text-align: center;
        border-bottom: none;
    }

    .header .badge {
        font-size: 32px;
        margin-bottom: 12px;
    }

    .header h1 {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .header p {
        font-size: 14px;
        color: #666;
        margin: 8px 0 0 0;
    }

    .content {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .intro-text {
        text-align: center;
        font-size: 14px;
        color: #666;
        margin-bottom: 24px;
        font-weight: 500;
    }

    /* Category Cards */
    .category-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }

    .category-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border: 2px solid #e0e0e0;
        border-radius: 16px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
        text-align: center;
    }

    .category-btn:hover {
        border-color: #d32f2f;
        box-shadow: 0 4px 12px rgba(211, 47, 47, 0.1);
    }

    .category-btn.active {
        background: linear-gradient(135deg, #ffc0d9, #ffb3cc);
        border-color: #d32f2f;
    }

    .category-emoji {
        font-size: 32px;
        margin-bottom: 12px;
    }

    .category-title {
        font-weight: 700;
        font-size: 14px;
        color: #333;
        margin-bottom: 4px;
    }

    .category-subtitle {
        font-size: 12px;
        color: #999;
    }

    /* Data Sections */
    .data-section {
        background: #fff0f5;
        border: 1px solid #ffd6e8;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .section-emoji {
        font-size: 20px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 700;
        color: #d32f2f;
        margin: 0;
    }

    .section-title.required::after {
        content: " *";
        color: #d32f2f;
    }

    .section-desc {
        font-size: 12px;
        color: #999;
        margin: 8px 0 16px 0;
        line-height: 1.5;
    }

    /* Input Fields */
    .input-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 16px;
    }

    .input-group {
        display: flex;
        flex-direction: column;
    }

    .input-label {
        font-size: 12px;
        font-weight: 600;
        color: #666;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .input-label-icon {
        font-size: 14px;
    }

    .input-wrapper {
        display: flex;
        gap: 8px;
    }

    input[type="date"],
    input[type="time"],
    input[type="datetime-local"] {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 13px;
        font-family: inherit;
        background: white;
    }

    input[type="date"]:focus,
    input[type="time"]:focus,
    input[type="datetime-local"]:focus {
        outline: none;
        border-color: #d32f2f;
        box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
    }

    /* Adat Choice */
    .adat-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .adat-btn {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: white;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        color: #666;
        transition: all 0.3s ease;
        font-family: inherit;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }

    .adat-duration {
        font-size: 11px;
        color: #999;
        font-weight: 400;
    }

    .adat-btn:hover {
        border-color: #d32f2f;
        background: #faf8ff;
    }

    .adat-btn.active {
        background: white;
        border: 1px solid #d32f2f;
        color: #d32f2f;
    }

    /* Buttons */
    .btn-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px;
        background: #d32f2f;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
        margin-bottom: 12px;
    }

    .btn-primary:hover {
        background: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(211, 47, 47, 0.2);
    }

    .btn-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px;
        background: white;
        color: #d32f2f;
        border: 2px solid #d32f2f;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
        margin-bottom: 12px;
    }

    .btn-secondary:hover {
        background: #fff5f5;
    }

    .btn-add {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px;
        background: white;
        color: #d32f2f;
        border: 2px dashed #d32f2f;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .btn-add:hover {
        background: #fff5f5;
    }

    /* Collapsible */
    .collapsible-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 12px;
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        color: #d32f2f;
        transition: all 0.3s ease;
        font-family: inherit;
        margin-bottom: 12px;
    }

    .collapsible-btn:hover {
        background: #fff5f5;
        border-color: #d32f2f;
    }

    .collapsible-btn.open {
        border-bottom: none;
        border-radius: 8px 8px 0 0;
    }

    .collapsible-btn .arrow {
        transition: transform 0.3s ease;
        font-size: 12px;
    }

    .collapsible-btn.open .arrow {
        transform: rotate(180deg);
    }

    .collapsible-content {
        display: none;
        background: white;
        border: 1px solid #e0e0e0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        padding: 12px;
        margin-bottom: 12px;
    }

    .collapsible-content.open {
        display: block;
    }

    .summary-item {
        background: #f5f5f5;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 8px;
        font-size: 12px;
        line-height: 1.6;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    @media (max-width: 600px) {
        .page-card {
            padding: 16px;
        }

        .category-buttons {
            grid-template-columns: 1fr;
        }

        .input-row {
            grid-template-columns: 1fr;
        }

        .adat-buttons {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="header">
    <div class="badge">🩸</div>
    <h1>Kalkulator Fiqih Haid</h1>
</div>

<div class="content">
    <div class="page-card">
        <p class="intro-text">Pilih kategori wanita untuk memulai analisa</p>

        <!-- Category Selection -->
        <div class="category-buttons">
            <button type="button" class="category-btn active" data-category="mubtadaah" onclick="selectCategory(this, 'mubtadaah')">
                <div class="category-emoji">🌸</div>
                <div class="category-title">Mubtadaah</div>
                <div class="category-subtitle">Pertama kali haid</div>
            </button>
            <button type="button" class="category-btn" data-category="mutadah" onclick="selectCategory(this, 'mutadah')">
                <div class="category-emoji">📅</div>
                <div class="category-title">Mu'tadah</div>
                <div class="category-subtitle">Punya adat</div>
            </button>
            <button type="button" class="category-btn" data-category="mutahayiroh" onclick="selectCategory(this, 'mutahayiroh')">
                <div class="category-emoji">🌀</div>
                <div class="category-title">Mutahayyiroh</div>
                <div class="category-subtitle">Lupa adat haid</div>
            </button>
        </div>

        <!-- Data Kelahiran -->
        <div class="data-section">
            <div class="section-header">
                <span class="section-emoji">😊</span>
                <h3 class="section-title required">Data Kelahiran</h3>
            </div>
            <p class="section-desc">Wajib diisi untuk mendeteksi apakah darah pertama keluar di usia minimal haid (9 tahun Hijriah − 16 hari − 1 detik).</p>
            <div class="input-row">
                <div class="input-group">
                    <label class="input-label">
                        <span class="input-label-icon">📅</span>
                        Tanggal Lahir
                    </label>
                    <input type="date" id="tanggalLahir" placeholder="mm/dd/yyyy">
                </div>
                <div class="input-group">
                    <label class="input-label">
                        <span class="input-label-icon">🕐</span>
                        Jam Lahir
                    </label>
                    <input type="time" id="jamLahir" value="00:00">
                </div>
            </div>
        </div>

        <!-- Pilih Adat -->
        <div class="data-section">
            <div class="section-header">
                <span class="section-emoji">⚖️</span>
                <h3 class="section-title">Pilih Adat (Haid / Suci)</h3>
            </div>
            <div class="adat-buttons">
                <button type="button" class="adat-btn" data-adat="1/29" onclick="selectAdat(this, '1/29')">
                    <strong>1 / 29</strong>
                    <span class="adat-duration">hari</span>
                </button>
                <button type="button" class="adat-btn" data-adat="6/24" onclick="selectAdat(this, '6/24')">
                    <strong>6 / 24</strong>
                    <span class="adat-duration">hari</span>
                </button>
                <button type="button" class="adat-btn" data-adat="7/23" onclick="selectAdat(this, '7/23')">
                    <strong>7 / 23</strong>
                    <span class="adat-duration">hari</span>
                </button>
                <button type="button" class="adat-btn" data-adat="8/22" onclick="selectAdat(this, '8/22')">
                    <strong>8 / 22</strong>
                    <span class="adat-duration">hari</span>
                </button>
                <button type="button" class="adat-btn" data-adat="9/21" onclick="selectAdat(this, '9/21')">
                    <strong>9 / 21</strong>
                    <span class="adat-duration">hari</span>
                </button>
                <button type="button" class="adat-btn" data-adat="10/20" onclick="selectAdat(this, '10/20')">
                    <strong>10 / 20</strong>
                    <span class="adat-duration">hari</span>
                </button>
            </div>
        </div>

        <!-- Data Keluar Darah -->
        <div class="data-section">
            <div class="section-header">
                <span class="section-emoji">🩸</span>
                <h3 class="section-title">Data Keluar Darah</h3>
            </div>
            <div id="keluarDarahList">
                <div class="input-row" style="margin-bottom: 16px;">
                    <div class="input-group">
                        <label class="input-label">Keluar Darah 1</label>
                        <div class="input-wrapper">
                            <input type="date" id="tglKeluar1" class="tglKeluar">
                            <input type="time" id="jamKeluar1" class="jamKeluar" value="00:00">
                        </div>
                    </div>
                </div>
                <div class="input-row" style="margin-bottom: 16px;">
                    <div class="input-group">
                        <label class="input-label">Tanggal & Jam Bersih</label>
                        <div class="input-wrapper">
                            <input type="date" id="tglBersih1" class="tglBersih">
                            <input type="time" id="jamBersih1" class="jamBersih" value="00:00">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="tambahDataKeluarDarah()">
                <i class="fas fa-plus"></i> Tambah Keluar Darah
            </button>
        </div>

        <!-- Ringkasan Keluar Darah -->
        <button type="button" class="collapsible-btn" onclick="toggleRingkasan()">
            <div style="display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-list"></i>
                <span>Ringkasan Keluar Darah</span>
            </div>
            <span class="arrow">▼</span>
        </button>
        <div class="collapsible-content" id="ringkasanContent">
            <div id="ringkasanList" style="display: none;"></div>
            <p id="ringkasanEmpty" style="text-align: center; color: #999; font-size: 12px; margin: 0;">
                Belum ada data. Silakan tambah data keluar darah.
            </p>
        </div>

        <!-- Action Buttons -->
        <button type="button" class="btn-primary" onclick="analisisHukum()">
            <i class="fas fa-search"></i> Analisa Hukum Darah
        </button>

        <button type="button" class="btn-secondary" onclick="pasteFromKalender()">
            <i class="fas fa-paste"></i> Paste Ringkasan Data dari Kalender Haid
        </button>

        <button type="button" class="btn-secondary" onclick="resetSemua()">
            <i class="fas fa-redo"></i> Hitung Baru (Reset Semua)
        </button>

        <!-- Hasil Analisis -->
        <div id="hasilAnalisis" style="display: none; margin-top: 20px;"></div>
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
let kategoriAktif = 'mubtadaah';
let adatTerpilih = null;
let dataKeluarDarah = [];
let nomorData = 1;

function selectCategory(element, category) {
    document.querySelectorAll('.category-btn').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    kategoriAktif = category;
}

function selectAdat(element, adat) {
    document.querySelectorAll('.adat-btn').forEach(btn => btn.classList.remove('active'));
    element.classList.add('active');
    adatTerpilih = adat;
}

function tambahDataKeluarDarah() {
    const keluarInputs = document.querySelectorAll('.tglKeluar');
    const jamKeluarInputs = document.querySelectorAll('.jamKeluar');
    const bersihInputs = document.querySelectorAll('.tglBersih');
    const jamBersihInputs = document.querySelectorAll('.jamBersih');
    
    const lastIndex = keluarInputs.length - 1;
    
    const tglKeluar = keluarInputs[lastIndex].value;
    const jamKeluar = jamKeluarInputs[lastIndex].value;
    const tglBersih = bersihInputs[lastIndex].value;
    const jamBersih = jamBersihInputs[lastIndex].value;

    if (!tglKeluar || !tglBersih) {
        alert('Silakan isi tanggal keluar dan bersih');
        return;
    }

    const keluarDateTime = new Date(`${tglKeluar}T${jamKeluar || '00:00'}`);
    const bersihDateTime = new Date(`${tglBersih}T${jamBersih || '00:00'}`);

    if (bersihDateTime <= keluarDateTime) {
        alert('Jam bersih harus setelah jam keluar');
        return;
    }

    const durasi = Math.floor((bersihDateTime - keluarDateTime) / (1000 * 60 * 60 * 24)) + 1;

    dataKeluarDarah.push({
        nomor: nomorData,
        tglKeluar,
        jamKeluar,
        tglBersih,
        jamBersih,
        durasi
    });

    nomorData++;
    updateRingkasan();
    tambahFormKeluarDarah();
    
    // Clear input yang baru saja diisi
    keluarInputs[lastIndex].value = '';
    jamKeluarInputs[lastIndex].value = '00:00';
    bersihInputs[lastIndex].value = '';
    jamBersihInputs[lastIndex].value = '00:00';
}

function tambahFormKeluarDarah() {
    const list = document.getElementById('keluarDarahList');
    const html = `
        <div class="input-row" style="margin-bottom: 16px;">
            <div class="input-group">
                <label class="input-label">Keluar Darah ${nomorData}</label>
                <div class="input-wrapper">
                    <input type="date" class="tglKeluar">
                    <input type="time" class="jamKeluar" value="00:00">
                </div>
            </div>
        </div>
        <div class="input-row" style="margin-bottom: 16px;">
            <div class="input-group">
                <label class="input-label">Tanggal & Jam Bersih</label>
                <div class="input-wrapper">
                    <input type="date" class="tglBersih">
                    <input type="time" class="jamBersih" value="00:00">
                </div>
            </div>
        </div>
    `;
    list.insertAdjacentHTML('beforeend', html);
}

function updateRingkasan() {
    const ringkasanList = document.getElementById('ringkasanList');
    const ringkasanEmpty = document.getElementById('ringkasanEmpty');

    if (dataKeluarDarah.length === 0) {
        ringkasanList.style.display = 'none';
        ringkasanEmpty.style.display = 'block';
        return;
    }

    ringkasanEmpty.style.display = 'none';
    ringkasanList.style.display = 'block';
    ringkasanList.innerHTML = '';

    dataKeluarDarah.forEach((data, index) => {
        const item = document.createElement('div');
        item.className = 'summary-item';
        const tglKeluarObj = new Date(data.tglKeluar);
        const tglBersihObj = new Date(data.tglBersih);
        
        item.innerHTML = `
            <div>
                <strong>Keluar Darah ${data.nomor}</strong><br>
                <small>${tglKeluarObj.toLocaleDateString('id-ID')} ${data.jamKeluar}</small><br>
                <small>Bersih: ${tglBersihObj.toLocaleDateString('id-ID')} ${data.jamBersih}</small><br>
                <strong style="color: #d32f2f;">Durasi: ${data.durasi} hari</strong>
            </div>
            <button onclick="hapusDataKeluarDarah(${index})" style="background: #fee; color: #d32f2f; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: 600;">Hapus</button>
        `;
        ringkasanList.appendChild(item);
    });
}

function hapusDataKeluarDarah(index) {
    dataKeluarDarah.splice(index, 1);
    updateRingkasan();
}

function toggleRingkasan() {
    const btn = event.target.closest('.collapsible-btn');
    const content = btn.nextElementSibling;
    
    btn.classList.toggle('open');
    content.classList.toggle('open');
}

function analisisHukum() {
    if (dataKeluarDarah.length === 0) {
        alert('Silakan tambah data keluar darah terlebih dahulu');
        return;
    }

    let analisis = '<div style="font-size: 13px; line-height: 1.8;">';

    dataKeluarDarah.forEach((data, index) => {
        const durasi = data.durasi;
        let status = '';
        let penjelasan = '';

        if (durasi <= 10) {
            status = '<strong style="color: #d32f2f;">✓ HAID</strong>';
            penjelasan = 'Darah haid sah menurut Madzhab Syafi\'i (1-10 hari)';
        } else if (durasi <= 15) {
            status = '<strong style="color: #f57c00;">⚠ HAID atau ISTIHADHOH</strong>';
            penjelasan = 'Perlu dikonfirmasi dengan adat kebiasaan atau riwayat haid sebelumnya';
        } else {
            status = '<strong style="color: #1976d2;">○ ISTIHADHOH</strong>';
            penjelasan = 'Pendarahan abnormal (> 15 hari) - Wudhu setiap shalat, boleh puasa & shalat';
        }

        analisis += `
            <div style="background: #f5f5f5; padding: 12px; border-radius: 8px; margin-bottom: 10px; border-left: 4px solid #d32f2f;">
                <strong>Keluar Darah ${data.nomor}:</strong> ${status}<br>
                <small style="color: #666;">Durasi: ${durasi} hari (${data.tglKeluar} - ${data.tglBersih})</small><br>
                <small style="color: #888; font-style: italic;">${penjelasan}</small>
            </div>
        `;
    });

    analisis += '</div>';

    document.getElementById('hasilAnalisis').innerHTML = `
        <button type="button" class="collapsible-btn open" onclick="toggleRingkasan()">
            <div style="display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-check-circle" style="color: #d32f2f;"></i>
                <span>Hasil Analisis Hukum Darah</span>
            </div>
            <span class="arrow">▼</span>
        </button>
        <div class="collapsible-content open">${analisis}</div>
    `;
    document.getElementById('hasilAnalisis').style.display = 'block';

    // Scroll ke hasil
    setTimeout(() => {
        document.getElementById('hasilAnalisis').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 100);
}

function pasteFromKalender() {
    alert('Fitur Paste dari Kalender Haid sedang dalam pengembangan. Silakan tambah data secara manual.');
}

function resetSemua() {
    if (confirm('Apakah Anda yakin ingin mereset semua data?')) {
        dataKeluarDarah = [];
        nomorData = 1;
        
        document.getElementById('tanggalLahir').value = '';
        document.getElementById('jamLahir').value = '00:00';
        
        document.querySelectorAll('.adat-btn').forEach(btn => btn.classList.remove('active'));
        
        // Reset ke form awal
        const keluarDarahList = document.getElementById('keluarDarahList');
        keluarDarahList.innerHTML = `
            <div class="input-row" style="margin-bottom: 16px;">
                <div class="input-group">
                    <label class="input-label">Keluar Darah 1</label>
                    <div class="input-wrapper">
                        <input type="date" id="tglKeluar1" class="tglKeluar">
                        <input type="time" id="jamKeluar1" class="jamKeluar" value="00:00">
                    </div>
                </div>
            </div>
            <div class="input-row" style="margin-bottom: 16px;">
                <div class="input-group">
                    <label class="input-label">Tanggal & Jam Bersih</label>
                    <div class="input-wrapper">
                        <input type="date" id="tglBersih1" class="tglBersih">
                        <input type="time" id="jamBersih1" class="jamBersih" value="00:00">
                    </div>
                </div>
            </div>
        `;
        
        updateRingkasan();
        document.getElementById('hasilAnalisis').style.display = 'none';
    }
}
</script>
