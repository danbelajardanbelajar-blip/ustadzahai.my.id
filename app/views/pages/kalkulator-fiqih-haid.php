<link rel="stylesheet" href="app/assets/css/kalkulator-fiqih-haid.css">

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
<script src="app/assets/js/kalkulator-fiqih-haid.js"></script>
