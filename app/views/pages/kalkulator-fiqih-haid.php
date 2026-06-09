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

    /* Tabs */
    .tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
    }

    .tab-btn {
        padding: 8px 12px;
        border-radius: 10px;
        border: 1px solid #eee;
        background: #fff;
        cursor: pointer;
        font-weight: 700;
        color: #666;
    }

    .tab-btn.active {
        background: linear-gradient(135deg, #ffc0d9, #ffb3cc);
        border-color: #d32f2f;
        color: #7a0a1a;
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }
</style>

<div class="header">
    <div class="badge">🩸</div>
    <h1>Kalkulator Fiqih Haid</h1>
</div>

<div class="content">
    <div class="page-card">
        <div class="tabs" role="tablist">
            <button class="tab-btn active" data-tab="input" onclick="openTab('input')">Input Data</button>
            <button class="tab-btn" data-tab="ringkasan" onclick="openTab('ringkasan')">Ringkasan</button>
            <button class="tab-btn" data-tab="hasil" onclick="openTab('hasil')">Hasil</button>
        </div>

        <div id="tab-input" class="tab-panel active">
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
                    <label class="input-label">Tanggal Lahir</label>
                    <input type="date" id="tanggalLahir">
                </div>
                <div class="input-group">
                    <label class="input-label">Jam Lahir</label>
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
            <div id="keluarDarahContainer">
                <!-- Forms akan di-generate oleh JavaScript -->
            </div>
            <button type="button" class="btn-add" onclick="tambahDataKeluarDarah()">
                <i class="fas fa-plus"></i> Tambah Keluar Darah
            </button>
        </div>

        <!-- Ringkasan dan Hasil dipindah ke tab terpisah -->
        <!-- (konten ringkasan akan di-render ke #ringkasanList saat tab Ringkasan dibuka) -->

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

        <!-- Hasil Analisis (ditampilkan di tab Hasil) -->
        
        </div>

        <div id="tab-ringkasan" class="tab-panel">
            <h3 style="margin-top:0">Ringkasan Keluar Darah</h3>
            <div id="ringkasanList"></div>
        </div>

        <div id="tab-hasil" class="tab-panel">
            <h3 style="margin-top:0">Hasil Analisis Hukum Darah</h3>
            <div id="hasilAnalisis"></div>
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
let nomorForm = 1;

// Initialize form on page load
document.addEventListener('DOMContentLoaded', function() {
    renderFormKeluarDarah();
    openTab('input');
});

function openTab(tab) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.toggle('active', b.dataset.tab === tab));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.toggle('active', p.id === 'tab-' + tab));

    if (tab === 'ringkasan') {
        updateRingkasan();
    }
}

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

function renderFormKeluarDarah() {
    const container = document.getElementById('keluarDarahContainer');
    container.innerHTML = '';
    
    // Render form untuk setiap data yang akan diinput
    for (let i = 0; i < nomorForm; i++) {
        const html = `
            <div class="input-row" style="margin-bottom: 16px;" data-form-index="${i}">
                <div class="input-group">
                    <label class="input-label">Keluar Darah ${i + 1}</label>
                    <div class="input-wrapper">
                        <input type="date" class="tglKeluar" data-index="${i}">
                        <input type="time" class="jamKeluar" data-index="${i}" value="00:00">
                    </div>
                </div>
            </div>
            <div class="input-row" style="margin-bottom: 16px;" data-form-index="${i}">
                <div class="input-group">
                    <label class="input-label">Tanggal & Jam Bersih</label>
                    <div class="input-wrapper">
                        <input type="date" class="tglBersih" data-index="${i}">
                        <input type="time" class="jamBersih" data-index="${i}" value="00:00">
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }
}

function tambahDataKeluarDarah() {
    // Validasi form terakhir harus lengkap
    const lastIndex = nomorForm - 1;
    const tglKeluar = document.querySelector(`[data-index="${lastIndex}"].tglKeluar`).value;
    const jamKeluar = document.querySelector(`[data-index="${lastIndex}"].jamKeluar`).value;
    const tglBersih = document.querySelector(`[data-index="${lastIndex}"].tglBersih`).value;
    const jamBersih = document.querySelector(`[data-index="${lastIndex}"].jamBersih`).value;

    // Validasi: semua field harus terisi
    if (!tglKeluar || !tglBersih) {
        alert('Silakan isi tanggal keluar dan tanggal bersih untuk Keluar Darah ' + (lastIndex + 1));
        return;
    }

    // Validasi: tanggal bersih harus setelah tanggal keluar
    const keluarDateTime = new Date(`${tglKeluar}T${jamKeluar || '00:00'}`);
    const bersihDateTime = new Date(`${tglBersih}T${jamBersih || '00:00'}`);

    if (bersihDateTime <= keluarDateTime) {
        alert('Tanggal & jam bersih harus setelah tanggal & jam keluar');
        return;
    }

    // Hitung durasi
    const durasi = Math.floor((bersihDateTime - keluarDateTime) / (1000 * 60 * 60 * 24)) + 1;

    // Simpan data
    dataKeluarDarah.push({
        nomor: lastIndex + 1,
        tglKeluar,
        jamKeluar,
        tglBersih,
        jamBersih,
        durasi
    });

    // Tambah form baru
    nomorForm++;
    renderFormKeluarDarah();
    updateRingkasan();

    // Scroll ke form baru
    const newFormIndex = nomorForm - 1;
    const newForm = document.querySelector(`[data-form-index="${newFormIndex}"]`);
    if (newForm) {
        newForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function updateRingkasan() {
    const ringkasanList = document.getElementById('ringkasanList');
    if (!ringkasanList) return;

    ringkasanList.innerHTML = '';

    if (dataKeluarDarah.length === 0) {
        ringkasanList.innerHTML = '<p style="color:#666">Belum ada data keluar darah.</p>';
        return;
    }

    dataKeluarDarah.forEach((data, index) => {
        const tglKeluarObj = new Date(data.tglKeluar);
        const tglBersihObj = new Date(data.tglBersih);

        const item = `
            <div class="summary-item">
                <div>
                    <strong>Keluar Darah ${data.nomor}</strong><br>
                    <small>${tglKeluarObj.toLocaleDateString('id-ID')} ${data.jamKeluar}</small><br>
                    <small>Bersih: ${tglBersihObj.toLocaleDateString('id-ID')} ${data.jamBersih}</small><br>
                    <strong style="color: #d32f2f;">Durasi: ${data.durasi} hari</strong>
                </div>
                <button onclick="hapusDataKeluarDarah(${index})" style="background: #fee; color: #d32f2f; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: 600; white-space: nowrap;">Hapus</button>
            </div>
        `;
        ringkasanList.insertAdjacentHTML('beforeend', item);
    });
}

function hapusDataKeluarDarah(index) {
    dataKeluarDarah.splice(index, 1);
    updateRingkasan();
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
        let statusColor = '';

        // Logika penentuan status berdasarkan Madzhab Syafi'i
        if (durasi <= 10) {
            status = 'HAID';
            statusColor = '#d32f2f';
            penjelasan = 'Darah haid sah menurut Madzhab Syafi\'i (1-10 hari). Tidak boleh shalat dan puasa.';
        } else if (durasi <= 15) {
            status = 'HAID atau ISTIHADHOH';
            statusColor = '#f57c00';
            penjelasan = 'Durasi antara 11-15 hari. Status perlu dikonfirmasi berdasarkan adat kebiasaan wanita.';
        } else {
            status = 'ISTIHADHOH';
            statusColor = '#1976d2';
            penjelasan = 'Pendarahan abnormal (> 15 hari). Boleh shalat dan puasa, tetapi harus wudhu setiap kali shalat.';
        }

        analisis += `
            <div style="background: #f5f5f5; padding: 14px; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid ${statusColor};">
                <strong style="color: ${statusColor};">Keluar Darah ${data.nomor}: ${status}</strong><br>
                <small style="color: #666;">Durasi: ${durasi} hari | ${data.tglKeluar} s/d ${data.tglBersih}</small><br>
                <small style="color: #888; font-style: italic; display: block; margin-top: 6px;">${penjelasan}</small>
            </div>
        `;
    });

    analisis += '</div>';

    const hasilDiv = document.getElementById('hasilAnalisis');
    hasilDiv.innerHTML = `
        <button type="button" class="collapsible-btn open" onclick="toggleHasil(this)">
            <div style="display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-check-circle" style="color: #d32f2f;"></i>
                <span>Hasil Analisis Hukum Darah</span>
            </div>
            <span class="arrow">▼</span>
        </button>
        <div class="collapsible-content open" style="display: block;">${analisis}</div>
    `;
    // Tampilkan di tab Hasil
    openTab('hasil');

    // Scroll ke hasil
    setTimeout(() => {
        const target = document.getElementById('hasilAnalisis');
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 100);
}

function toggleHasil(btn) {
    btn.classList.toggle('open');
    const content = btn.nextElementSibling;
    content.classList.toggle('open');
}

function pasteFromKalender() {
    alert('Fitur "Paste Ringkasan Data dari Kalender Haid" sedang dalam pengembangan. Silakan tambah data secara manual terlebih dahulu.');
}

function resetSemua() {
    if (confirm('Apakah Anda yakin ingin mereset semua data?')) {
        // Reset semua data
        dataKeluarDarah = [];
        nomorForm = 1;
        kategoriAktif = 'mubtadaah';
        adatTerpilih = null;

        // Reset input fields
        document.getElementById('tanggalLahir').value = '';
        document.getElementById('jamLahir').value = '00:00';
        document.querySelectorAll('.adat-btn').forEach(btn => btn.classList.remove('active'));
        
        // Reset category
        document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelector('.category-btn').classList.add('active');

        // Render ulang form
        renderFormKeluarDarah();
        
        // Clear ringkasan dan hasil
        const ringkasanList = document.getElementById('ringkasanList');
        if (ringkasanList) ringkasanList.innerHTML = '';
        const hasilDiv2 = document.getElementById('hasilAnalisis');
        if (hasilDiv2) { hasilDiv2.innerHTML = ''; hasilDiv2.style.display = 'none'; }
        openTab('input');

        alert('Semua data telah direset');
    }
}
</script>
