<div class="header">
    <div class="badge"><i class="fas fa-pen"></i> Alat Pembuat Tabel Haid</div>
    <h1>Buat Tabel Haid Anda</h1>
    <p>Visualisasikan siklus haid dan masa suci dengan tabel interaktif.</p>
</div>

<div class="content">
    <div class="page-card">
        <h2>Input Data Siklus Haid</h2>
        <form style="display: flex; flex-direction: column; gap: 12px;">
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Hari Pertama Haid Terakhir</label>
                <input type="date" id="hari1" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Durasi Haid Biasanya (Hari)</label>
                <input type="number" id="durasi" min="1" max="10" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" placeholder="Contoh: 6">
            </div>
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Durasi Istirahat (Hari)</label>
                <input type="number" id="istirahat" min="15" max="30" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" placeholder="Contoh: 15" value="15">
            </div>
            <button type="button" onclick="buatTabel()" style="padding: 12px; background: linear-gradient(135deg, #7c4dff, #536dfe); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                <i class="fas fa-table"></i> Buat Tabel
            </button>
        </form>
        
        <div id="tabel" style="margin-top: 20px; display: none;">
            <h3 style="color: #333; margin-bottom: 12px;">Visualisasi Siklus Anda</h3>
            <div id="tabelHasil" style="background: white; padding: 12px; border-radius: 8px; overflow-x: auto;"></div>
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
function buatTabel() {
    const hari1 = document.getElementById('hari1').value;
    const durasi = parseInt(document.getElementById('durasi').value);
    const istirahat = parseInt(document.getElementById('istirahat').value);
    
    if (!hari1 || isNaN(durasi) || isNaN(istirahat)) {
        alert('Silakan isi semua data dengan benar');
        return;
    }
    
    const start = new Date(hari1);
    let html = '<table style="width: 100%; border-collapse: collapse; font-size: 11px;">';
    html += '<tr style="background: #f0f0f0;"><th style="padding: 8px; border: 1px solid #ddd; width: 50px;">No</th><th style="padding: 8px; border: 1px solid #ddd;">Tanggal</th><th style="padding: 8px; border: 1px solid #ddd;">Status</th></tr>';
    
    let currentDate = new Date(start);
    let dayCounter = 1;
    let statusColor = '';
    let status = '';
    
    for (let i = 0; i < (durasi + istirahat) * 3; i++) {
        if (dayCounter <= durasi) {
            statusColor = '#ff6b9d';
            status = 'HAID';
        } else if (dayCounter <= durasi + istirahat) {
            statusColor = '#20b2aa';
            status = 'ISTIRAHAT (Suci)';
        } else {
            dayCounter = 1;
            statusColor = '#ff6b9d';
            status = 'HAID';
        }
        
        html += `<tr><td style="padding: 8px; border: 1px solid #ddd;">${i + 1}</td>`;
        html += `<td style="padding: 8px; border: 1px solid #ddd;">${currentDate.toLocaleDateString('id-ID')}</td>`;
        html += `<td style="padding: 8px; border: 1px solid #ddd; background: ${statusColor}; color: white; text-align: center; font-weight: bold;">${status}</td></tr>`;
        
        dayCounter++;
        currentDate.setDate(currentDate.getDate() + 1);
    }
    
    html += '</table>';
    document.getElementById('tabelHasil').innerHTML = html;
    document.getElementById('tabel').style.display = 'block';
}
</script>
