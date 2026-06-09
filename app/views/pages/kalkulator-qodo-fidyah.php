<div class="header">
    <div class="badge"><i class="fas fa-utensils"></i> Kalkulator Qodo & Fidyah</div>
    <h1>Hitung Qodo Puasa & Fidyah</h1>
    <p>Tentukan kewajiban qodo dan fidyah puasa yang tertinggal.</p>
</div>

<div class="content">
    <div class="page-card">
        <h2>Masukkan Data Puasa Tertinggal</h2>
        <form style="display: flex; flex-direction: column; gap: 12px;">
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Jumlah Hari Puasa Tertinggal</label>
                <input type="number" id="hariTertinggal" min="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" placeholder="Contoh: 5">
            </div>
            <div>
                <label style="display: block; margin-bottom: 4px; font-weight: bold; font-size: 13px;">Apakah Ada Keuzuran Permanen? (Sakit kronis, tua, dll)</label>
                <select id="uzur" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="no">Tidak Ada Keuzuran</option>
                    <option value="yes">Ada Keuzuran Permanen</option>
                </select>
            </div>
            <button type="button" onclick="hitungQodo()" style="padding: 12px; background: linear-gradient(135deg, #ffb347, #ff7b00); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                <i class="fas fa-calculate"></i> Hitung Kewajiban
            </button>
        </form>
        
        <div id="hasil" style="margin-top: 20px; display: none;">
            <h3 style="color: #333; margin-bottom: 12px;">Hasil Perhitungan</h3>
            <div style="background: #f9f9f9; padding: 12px; border-radius: 8px; border-left: 4px solid #ffb347;">
                <p style="margin: 6px 0;"><strong>Jumlah Hari Qodo:</strong> <span id="jumlahQodo">-</span> hari</p>
                <p style="margin: 6px 0;"><strong>Fidyah:</strong> <span id="fidyah">-</span></p>
                <p style="margin: 6px 0;"><strong>Keterangan:</strong> <span id="keterangan" style="font-size: 12px; color: #666;">-</span></p>
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
function hitungQodo() {
    const hari = parseInt(document.getElementById('hariTertinggal').value);
    const uzur = document.getElementById('uzur').value;
    
    if (isNaN(hari) || hari < 0) {
        alert('Silakan masukkan jumlah hari dengan benar');
        return;
    }
    
    let qodo = hari;
    let fidyah, keterangan;
    
    if (uzur === 'yes') {
        qodo = 0;
        fidyah = `${hari} hari × 1,5 kg beras/hari = ${hari * 1.5} kg beras`;
        keterangan = 'Jika ada keuzuran permanen (tidak bisa puasa selamanya), cukup bayar fidyah tanpa perlu qodo';
    } else {
        fidyah = 'Tidak ada fidyah, cukup qodo';
        keterangan = 'Qodo harus dikerjakan sesudah Ramadhan berakhir. Setiap hari qodo setara 1 hari puasa penuh';
    }
    
    document.getElementById('jumlahQodo').textContent = qodo;
    document.getElementById('fidyah').textContent = fidyah;
    document.getElementById('keterangan').textContent = keterangan;
    document.getElementById('hasil').style.display = 'block';
}
</script>
