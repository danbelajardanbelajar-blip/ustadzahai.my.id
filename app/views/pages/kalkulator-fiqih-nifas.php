<div class="header">
    <div class="badge"><i class="fas fa-calculator"></i> Kalkulator Fiqih Nifas</div>
    <h1>Hitung Periode Nifas</h1>
    <p>Tentukan masa nifas setelah melahirkan (postpartum bleeding).</p>
</div>

<div class="content">
    <div class="page-card">
        <h2>Masukkan Data Nifas</h2>
        <form style="display: flex; flex-direction: column; gap: 12px;">
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Tanggal Melahirkan</label>
                <input type="date" id="nifasStart" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Apakah Berhenti Pendarahan Sebelum 40 Hari?</label>
                <select id="stopBefore40" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="">-- Pilih --</option>
                    <option value="yes">Ya, tanggal:</option>
                    <option value="no">Tidak, melanjut hingga 40 hari</option>
                </select>
            </div>
            <div id="stopDateDiv" style="display: none;">
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Tanggal Berhenti Pendarahan</label>
                <input type="date" id="nifasStop" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <button type="button" onclick="hitungNifas()" style="padding: 12px; background: linear-gradient(135deg, #a76df0, #8a4af3); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                <i class="fas fa-calculate"></i> Hitung Nifas
            </button>
        </form>
        
        <div id="hasil" style="margin-top: 20px; display: none;">
            <h3 style="color: #333; margin-bottom: 12px;">Hasil Perhitungan Nifas</h3>
            <div style="background: #f9f9f9; padding: 12px; border-radius: 8px; border-left: 4px solid #a76df0;">
                <p style="margin: 6px 0;"><strong>Awal Nifas:</strong> <span id="awalNifas">-</span></p>
                <p style="margin: 6px 0;"><strong>Akhir Nifas:</strong> <span id="akhirNifas">-</span></p>
                <p style="margin: 6px 0;"><strong>Durasi Nifas:</strong> <span id="durasiNifas">-</span> hari</p>
                <p style="margin: 6px 0;"><strong>Catatan:</strong> <span id="catatan" style="font-size: 12px; color: #666;">-</span></p>
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
document.getElementById('stopBefore40').addEventListener('change', (e) => {
    document.getElementById('stopDateDiv').style.display = e.value === 'yes' ? 'block' : 'none';
});

function hitungNifas() {
    const start = new Date(document.getElementById('nifasStart').value);
    if (isNaN(start)) {
        alert('Silakan masukkan tanggal melahirkan');
        return;
    }
    
    const stopBefore40 = document.getElementById('stopBefore40').value;
    let endNifas, durasi, catatan;
    
    if (stopBefore40 === 'yes') {
        const stopDate = new Date(document.getElementById('nifasStop').value);
        if (isNaN(stopDate)) {
            alert('Silakan masukkan tanggal berhenti pendarahan');
            return;
        }
        endNifas = stopDate;
        durasi = Math.floor((stopDate - start) / (1000 * 60 * 60 * 24)) + 1;
        catatan = 'Jika pendarahan berhenti sebelum 40 hari, ikuti masa nifas yang aktual';
    } else {
        endNifas = new Date(start);
        endNifas.setDate(endNifas.getDate() + 39);
        durasi = 40;
        catatan = 'Nifas maksimal 40 hari Madzhab Syafi\'i. Setelah nifas selesai, boleh shalat dan puasa';
    }
    
    document.getElementById('awalNifas').textContent = start.toLocaleDateString('id-ID');
    document.getElementById('akhirNifas').textContent = endNifas.toLocaleDateString('id-ID');
    document.getElementById('durasiNifas').textContent = durasi;
    document.getElementById('catatan').textContent = catatan;
    document.getElementById('hasil').style.display = 'block';
}
</script>
