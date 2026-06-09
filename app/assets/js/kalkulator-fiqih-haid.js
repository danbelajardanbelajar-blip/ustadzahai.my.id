// Externalized JS for kalkulator-fiqih-haid
let kategoriAktif = 'mubtadaah';
let adatTerpilih = null;
let dataKeluarDarah = [];
let nomorForm = 1;

function formatDateTime(dateStr, timeStr) {
    if (!dateStr) return '';
    const dt = new Date(`${dateStr}T${timeStr || '00:00'}`);
    if (isNaN(dt)) return `${dateStr} ${timeStr || ''}`;
    const date = dt.toLocaleDateString('id-ID');
    const time = dt.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
    return `${date} ${time}`;
}

function initKalkulator() {
    renderFormKeluarDarah();
    openTab('input');
}

function openTab(tab) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.toggle('active', b.dataset.tab === tab));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.toggle('active', p.id === 'tab-' + tab));

    if (tab === 'ringkasan') updateRingkasan();
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
    const lastIndex = nomorForm - 1;
    const tglKeluar = document.querySelector(`[data-index="${lastIndex}"].tglKeluar`).value;
    const jamKeluar = document.querySelector(`[data-index="${lastIndex}"].jamKeluar`).value;
    const tglBersih = document.querySelector(`[data-index="${lastIndex}"].tglBersih`).value;
    const jamBersih = document.querySelector(`[data-index="${lastIndex}"].jamBersih`).value;

    if (!tglKeluar || !tglBersih) {
        alert('Silakan isi tanggal keluar dan tanggal bersih untuk Keluar Darah ' + (lastIndex + 1));
        return;
    }

    const keluarDateTime = new Date(`${tglKeluar}T${jamKeluar || '00:00'}`);
    const bersihDateTime = new Date(`${tglBersih}T${jamBersih || '00:00'}`);

    if (bersihDateTime <= keluarDateTime) {
        alert('Tanggal & jam bersih harus setelah tanggal & jam keluar');
        return;
    }

    const durasi = Math.floor((bersihDateTime - keluarDateTime) / (1000 * 60 * 60 * 24)) + 1;

    dataKeluarDarah.push({ nomor: lastIndex + 1, tglKeluar, jamKeluar, tglBersih, jamBersih, durasi });

    nomorForm++;
    renderFormKeluarDarah();
    updateRingkasan();

    const newFormIndex = nomorForm - 1;
    const newForm = document.querySelector(`[data-form-index="${newFormIndex}"]`);
    if (newForm) newForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
        const item = `
            <div class="summary-item">
                <div>
                    <strong>Keluar Darah ${data.nomor}</strong><br>
                    <small>${formatDateTime(data.tglKeluar, data.jamKeluar)}</small><br>
                    <small>Bersih: ${formatDateTime(data.tglBersih, data.jamBersih)}</small><br>
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

        if (durasi <= 10) {
            status = 'HAID';
            statusColor = '#d32f2f';
            penjelasan = "Darah haid sah menurut Madzhab Syafi'i (1-10 hari). Tidak boleh shalat dan puasa.";
        } else if (durasi <= 15) {
            status = 'HAID atau ISTIHADHOH';
            statusColor = '#f57c00';
            penjelasan = 'Durasi antara 11-15 hari. Status perlu dikonfirmasi berdasarkan adat kebiasaan wanita.';
        } else {
            status = 'ISTIHADHOH';
            statusColor = '#1976d2';
            penjelasan = 'Pendarahan abnormal (> 15 hari). Boleh shalat dan puasa, tetapi harus wudhu setiap kali shalat.';
        }

        analisis += `\n            <div style="background: #f5f5f5; padding: 14px; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid ${statusColor};">\n                <strong style="color: ${statusColor};">Keluar Darah ${data.nomor}: ${status}</strong><br>\n                <small style="color: #666;">Durasi: ${durasi} hari | ${formatDateTime(data.tglKeluar, data.jamKeluar)} s/d ${formatDateTime(data.tglBersih, data.jamBersih)}</small><br>\n                <small style="color: #888; font-style: italic; display: block; margin-top: 6px;">${penjelasan}</small>\n            </div>\n        `;
    });

    analisis += '</div>';

    const hasilDiv = document.getElementById('hasilAnalisis');
    hasilDiv.innerHTML = `\n        <button type="button" class="collapsible-btn open" onclick="toggleHasil(this)">\n            <div style="display: flex; align-items: center; gap: 8px;">\n                <i class="fas fa-check-circle" style="color: #d32f2f;"></i>\n                <span>Hasil Analisis Hukum Darah</span>\n            </div>\n            <span class="arrow">▼</span>\n        </button>\n        <div class="collapsible-content open" style="display: block;">${analisis}</div>\n    `;
    openTab('hasil');

    setTimeout(() => { const target = document.getElementById('hasilAnalisis'); if (target) target.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 100);
}

function toggleHasil(btn) { btn.classList.toggle('open'); const content = btn.nextElementSibling; content.classList.toggle('open'); }

function pasteFromKalender() { alert('Fitur "Paste Ringkasan Data dari Kalender Haid" sedang dalam pengembangan. Silakan tambah data secara manual terlebih dahulu.'); }

function resetSemua() {
    if (!confirm('Apakah Anda yakin ingin mereset semua data?')) return;
    dataKeluarDarah = [];
    nomorForm = 1;
    kategoriAktif = 'mubtadaah';
    adatTerpilih = null;
    const tanggal = document.getElementById('tanggalLahir'); if (tanggal) tanggal.value = '';
    const jam = document.getElementById('jamLahir'); if (jam) jam.value = '00:00';
    document.querySelectorAll('.adat-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
    const firstCat = document.querySelector('.category-btn'); if (firstCat) firstCat.classList.add('active');
    renderFormKeluarDarah();
    const ringkasanList = document.getElementById('ringkasanList'); if (ringkasanList) ringkasanList.innerHTML = '';
    const hasilDiv2 = document.getElementById('hasilAnalisis'); if (hasilDiv2) { hasilDiv2.innerHTML = ''; hasilDiv2.style.display = 'none'; }
    openTab('input');
}

// Auto-init if script loaded after DOM
if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(initKalkulator, 10);
}
