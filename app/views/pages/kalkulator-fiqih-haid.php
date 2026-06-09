<style>
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 12px;
        margin-bottom: 20px;
    }

    .category-card {
        padding: 16px;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
        background: white;
    }

    .category-card:hover {
        border-color: #ff6b9d;
        box-shadow: 0 4px 12px rgba(255, 107, 157, 0.2);
    }

    .category-card.active {
        background: linear-gradient(135deg, #ffc0d9, #ffb3cc);
        border-color: #ff6b9d;
        color: #c2185b;
    }

    .category-icon {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .category-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .category-subtitle {
        font-size: 11px;
        color: #888;
    }

    .data-section {
        background: #fff5f8;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 16px;
        border: 1px solid #ffd6e8;
    }

    .data-section h4 {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 12px 0;
        color: #c2185b;
        font-size: 14px;
        font-weight: 600;
    }

    .data-section .icon {
        font-size: 16px;
    }

    .input-group {
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
    }

    .input-group:last-child {
        margin-bottom: 0;
    }

    .input-field {
        flex: 1;
    }

    .input-field label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #666;
        margin-bottom: 4px;
    }

    .input-field input,
    .input-field select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 12px;
    }

    .adat-choice {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-bottom: 12px;
    }

    .adat-btn {
        padding: 10px;
        border: 2px solid #ddd;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 11px;
        font-weight: 600;
        color: #666;
        transition: all 0.3s ease;
    }

    .adat-btn:hover {
        border-color: #5ca0f2;
    }

    .adat-btn.active {
        background: linear-gradient(135deg, #5ca0f2, #4a90e2);
        color: white;
        border-color: #5ca0f2;
    }

    .add-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: white;
        color: #ff6b9d;
        padding: 10px;
        border: 2px dashed #ff6b9d;
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .add-btn:hover {
        background: #fff5f8;
    }

    .summary-item {
        background: white;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
    }

    .summary-item .icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #ff6b9d, #ff477e);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        flex-shrink: 0;
    }

    .primary-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #c2185b, #a01850);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .primary-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(194, 24, 91, 0.3);
    }

    .secondary-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px;
        background: white;
        color: #ff6b9d;
        border: 2px solid #ff6b9d;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 12px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .secondary-btn:hover {
        background: #fff5f8;
    }

    .collapsible {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 8px;
        font-weight: 600;
        color: #c2185b;
        user-select: none;
    }

    .collapsible:hover {
        background: #fff5f8;
    }

    .collapsible .arrow {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .collapsible.open .arrow {
        transform: rotate(180deg);
    }

    .collapsible-content {
        display: none;
        background: white;
        padding: 12px;
        margin-bottom: 8px;
        border-radius: 8px;
        max-height: 300px;
        overflow-y: auto;
    }

    .collapsible.open + .collapsible-content {
        display: block;
    }

    @media (max-width: 600px) {
        .category-grid {
            grid-template-columns: 1fr;
        }

        .adat-choice {
            grid-template-columns: 1fr;
        }

        .input-group {
            flex-direction: column;
        }
    }
</style>

<div class="header">
    <div class="badge"><i class="fas fa-calculator"></i> Kalkulator Fiqih Haid</div>
    <h1>Analisa Hukum Darah Wanita</h1>
    <p>Pilih kategori wanita untuk memulai analisa</p>
</div>

<div class="content">
    <div class="page-card">
        <h3 style="margin: 0 0 16px 0; color: #333;">Pilih kategori wanita untuk memulai analisa</h3>
        
        <div class="category-grid">
            <div class="category-card active" data-category="mubtadaah" onclick="selectCategory(this, 'mubtadaah')">
                <div class="category-icon">🩹</div>
                <div class="category-title">Mubtadaah</div>
                <div class="category-subtitle">Pertama kali haid</div>
            </div>
            <div class="category-card" data-category="mutadah" onclick="selectCategory(this, 'mutadah')">
                <div class="category-icon">📅</div>
                <div class="category-title">Mu'tadah</div>
                <div class="category-subtitle">Punya adat</div>
            </div>
            <div class="category-card" data-category="mutahayiroh" onclick="selectCategory(this, 'mutahayiroh')">
                <div class="category-icon">❓</div>
                <div class="category-title">Mutahayiroh</div>
                <div class="category-subtitle">Lupa adat</div>
            </div>
        </div>

        <!-- DATA KELAIRAN -->
        <div class="data-section">
            <h4><span class="icon">📅</span> DATA KELAIRAN</h4>
            <p style="font-size: 11px; color: #666; margin: 0 0 12px 0;">Wajib diisi untuk mendeteksi apakah darah pertama keluar di usia minimal haid (9 tahun Hijriah - 16 hari - 1 detik).</p>
            <div class="input-group">
                <div class="input-field">
                    <label>Tanggal Lahir</label>
                    <input type="date" id="tanggalLahir">
                </div>
                <div class="input-field">
                    <label>Jam Lahir</label>
                    <input type="time" id="jamLahir" value="12:00">
                </div>
            </div>
        </div>

        <!-- PILIH ADAT -->
        <div class="data-section">
            <h4><span class="icon">⚖️</span> PILIH ADAT (HAID / SUCI)</h4>
            <div class="adat-choice" id="adatChoice">
                <button type="button" class="adat-btn" data-adat="1/29" onclick="selectAdat(this, '1/29')">1 / 29</button>
                <button type="button" class="adat-btn" data-adat="6/24" onclick="selectAdat(this, '6/24')">6 / 24</button>
                <button type="button" class="adat-btn" data-adat="7/23" onclick="selectAdat(this, '7/23')">7 / 23</button>
                <button type="button" class="adat-btn" data-adat="8/22" onclick="selectAdat(this, '8/22')">8 / 22</button>
                <button type="button" class="adat-btn" data-adat="9/21" onclick="selectAdat(this, '9/21')">9 / 21</button>
                <button type="button" class="adat-btn" data-adat="10/20" onclick="selectAdat(this, '10/20')">10 / 20</button>
            </div>
        </div>

        <!-- DATA KELUAR DARAH -->
        <div class="data-section">
            <h4><span class="icon">🩸</span> DATA KELUAR DARAH</h4>
            <div class="input-group">
                <div class="input-field">
                    <label>TANGGAL & JAM KELUAR</label>
                    <input type="datetime-local" id="tglJamKeluar">
                </div>
            </div>
            <div class="input-group">
                <div class="input-field">
                    <label>TANGGAL & JAM BERSIH</label>
                    <input type="datetime-local" id="tglJamBersih">
                </div>
            </div>
            <button type="button" class="add-btn" onclick="tambahKeluerDarah()">
                <i class="fas fa-plus"></i> Tambah Keluar Darah
            </button>
        </div>

        <!-- RINGKASAN KELUAR DARAH -->
        <div class="data-section">
            <h4><span class="icon">📋</span> RINGKASAN KELUAR DARAH</h4>
            <div id="ringkasanList" style="display: none;">
                <!-- Items akan di-generate oleh JavaScript -->
            </div>
            <p id="ringkasanEmpty" style="font-size: 12px; color: #999; margin: 0; text-align: center;">Belum ada data. Tambah data keluar darah terlebih dahulu.</p>
        </div>

        <!-- ACTION BUTTONS -->
        <button type="button" class="primary-btn" onclick="analisisHukum()">
            <i class="fas fa-search"></i> Analisa Hukum Darah
        </button>

        <button type="button" class="secondary-btn" onclick="pasteFromKalender()">
            <i class="fas fa-paste"></i> Paste Ringkasan Data dari Kalender Haid
        </button>

        <button type="button" class="secondary-btn" onclick="resetSemua()">
            <i class="fas fa-redo"></i> Hitung Baru (Reset Semua)
        </button>

        <!-- HASIL ANALISIS -->
        <div id="hasilAnalisis" style="display: none; margin-top: 16px;">
            <div class="collapsible" onclick="toggleCollapsible(this)">
                <span><i class="fas fa-check-circle" style="color: #4caf50; margin-right: 6px;"></i> Ringkasan Keluar Darah</span>
                <span class="arrow">▼</span>
            </div>
            <div class="collapsible-content" id="ringkasanHasil"></div>
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

function selectCategory(element, category) {
    document.querySelectorAll('.category-card').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    kategoriAktif = category;
}

function selectAdat(element, adat) {
    document.querySelectorAll('#adatChoice .adat-btn').forEach(btn => btn.classList.remove('active'));
    element.classList.add('active');
    adatTerpilih = adat;
}

function tambahKeluerDarah() {
    const tglJamKeluar = document.getElementById('tglJamKeluar').value;
    const tglJamBersih = document.getElementById('tglJamBersih').value;

    if (!tglJamKeluar || !tglJamBersih) {
        alert('Silakan isi tanggal dan jam keluar dan bersih');
        return;
    }

    const keluar = new Date(tglJamKeluar);
    const bersih = new Date(tglJamBersih);

    if (bersih <= keluar) {
        alert('Jam bersih harus setelah jam keluar');
        return;
    }

    const durasi = Math.floor((bersih - keluar) / (1000 * 60 * 60 * 24)) + 1;

    dataKeluarDarah.push({
        keluar: tglJamKeluar,
        bersih: tglJamBersih,
        durasi: durasi
    });

    updateRingkasan();
    document.getElementById('tglJamKeluar').value = '';
    document.getElementById('tglJamBersih').value = '';
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
        const tanggalKeluar = new Date(data.keluar);
        const tanggalBersih = new Date(data.bersih);
        item.innerHTML = `
            <div class="icon">${index + 1}</div>
            <div style="flex: 1;">
                <strong>Keluar Darah ${index + 1}</strong><br>
                <small>${tanggalKeluar.toLocaleDateString('id-ID')} ${tanggalKeluar.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</small><br>
                <small>Bersih: ${tanggalBersih.toLocaleDateString('id-ID')} ${tanggalBersih.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</small><br>
                <strong style="color: #ff6b9d;">Durasi: ${data.durasi} hari</strong>
            </div>
            <button onclick="hapusDataKeluarDarah(${index})" style="background: #fee; color: #ff6b9d; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: 600;">Hapus</button>
        `;
        ringkasanList.appendChild(item);
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

    let analisis = '<div style="font-size: 12px; line-height: 1.6;">';

    dataKeluarDarah.forEach((data, index) => {
        const durasi = data.durasi;
        let status = '';

        if (durasi <= 10) {
            status = '<strong style="color: #d32f2f;">✓ HAID</strong>';
        } else if (durasi <= 15) {
            status = '<strong style="color: #f57c00;">⚠ HAID atau ISTIHADHOH</strong>';
        } else {
            status = '<strong style="color: #1976d2;">○ ISTIHADHOH</strong>';
        }

        analisis += `
            <div style="background: #f5f5f5; padding: 10px; border-radius: 6px; margin-bottom: 8px;">
                <strong>Keluar Darah ${index + 1}:</strong> ${status}<br>
                <small>Durasi: ${durasi} hari</small>
            </div>
        `;
    });

    analisis += '</div>';

    document.getElementById('ringkasanHasil').innerHTML = analisis;
    document.getElementById('hasilAnalisis').style.display = 'block';

    // Scroll ke hasil
    document.getElementById('hasilAnalisis').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function toggleCollapsible(element) {
    element.classList.toggle('open');
}

function pasteFromKalender() {
    alert('Fitur Paste dari Kalender Haid sedang dalam pengembangan. Silakan tambah data secara manual.');
}

function resetSemua() {
    if (confirm('Apakah Anda yakin ingin mereset semua data?')) {
        dataKeluarDarah = [];
        document.getElementById('tanggalLahir').value = '';
        document.getElementById('jamLahir').value = '12:00';
        document.querySelectorAll('#adatChoice .adat-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById('tglJamKeluar').value = '';
        document.getElementById('tglJamBersih').value = '';
        updateRingkasan();
        document.getElementById('hasilAnalisis').style.display = 'none';
        adatTerpilih = null;
    }
}
</script>
