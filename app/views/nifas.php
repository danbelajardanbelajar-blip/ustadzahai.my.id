<div class="n-bg-gradient"></div>

<div class="n-container">
    
    <!-- HEADER -->
    <div class="n-header">
        <div class="n-icon-moon"><i class="far fa-moon"></i></div>
        <h1>Kalkulator Fiqih Nifas</h1>
        <p>Menghitung hukum darah nifas berdasarkan Madzhab Syafi'i. Masukkan data kelahiran dan periode darah/bersih untuk mengetahui hukum fiqihnya.</p>
        <div class="n-badge"><i class="fas fa-book-open"></i> Madzhab Syafi'i</div>
    </div>

    <!-- TANGGAL MELAHIRKAN -->
    <div class="n-card">
        <div class="n-card-title">
            <div class="n-icon-circle-red"><i class="fas fa-cog"></i></div> Tanggal & Waktu Melahirkan
        </div>
        
        <div class="n-input-group">
            <label>TANGGAL</label>
            <div class="n-input-wrapper">
                <input type="date" class="n-input n-date-picker">
                <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
            </div>
        </div>

        <div class="n-input-group">
            <label>WAKTU</label>
            <div class="n-input-wrapper">
                <input type="time" value="12:00" class="n-input n-time-picker">
                <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
            </div>
        </div>
        
        <p class="n-info-text">Awal nifas secara hitungan dihitung sejak kosongnya rahim (melahirkan seluruh tubuh bayi).</p>
    </div>

    <!-- DATA ADAT -->
    <div class="n-card">
        <div class="n-card-title">
            <div class="n-icon-circle-orange"><i class="far fa-sticky-note"></i></div> Data Adat (Kebiasaan)
        </div>

        <div class="n-toggle-row">
            <div class="n-toggle-text">
                <strong>Pertama Kali Nifas?</strong>
                <span>Belum punya adat nifas ... nifas dihitung 40 hari</span>
            </div>
            <label class="n-switch">
                <input type="checkbox" id="toggle-pertama-nifas">
                <span class="n-slider"></span>
            </label>
        </div>

        <div class="n-input-group">
            <label>ADAT NIFAS (HARI)</label>
            <input type="number" placeholder="contoh: 40" class="n-input" id="input-adat-nifas">
            <p class="n-info-text n-mt-5">Kosongkan jika tidak diketahui (akan dianggap 40 hari)</p>
        </div>

        <div class="n-toggle-row">
            <div class="n-toggle-text">
                <strong>Belum Pernah Haid Sebelumnya?</strong>
                <span>Suci 29 hari, haid 1 hari (adat pertama kali)</span>
            </div>
            <label class="n-switch">
                <input type="checkbox" id="toggle-belum-haid">
                <span class="n-slider"></span>
            </label>
        </div>

        <div class="n-input-row-half">
            <div class="n-input-group">
                <label>ADAT SUCI (HARI)</label>
                <input type="number" placeholder="contoh: 29" class="n-input" id="input-adat-suci">
                <p class="n-info-text n-mt-5" style="text-align: center;">Suci terakhir</p>
            </div>
            <div class="n-input-group">
                <label>ADAT HAID (HARI)</label>
                <input type="number" placeholder="contoh: 7" class="n-input" id="input-adat-haid">
                <p class="n-info-text n-mt-5" style="text-align: center;">Haid terakhir</p>
            </div>
        </div>

        <div class="n-input-group">
            <label>JAM MULAI SUCI ADAT</label>
            <div class="n-input-wrapper">
                <input type="time" class="n-input n-time-picker">
                <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
            </div>
            <p class="n-info-text n-mt-5">Jam mulai suci terakhir (untuk urutan haid & istihadhah pada masa sebelum hamil)</p>
        </div>

        <div class="n-warning-box">
            <i class="fas fa-info-circle" style="color: #d3557d; float: left; margin-right: 8px; margin-top: 2px;"></i>
            Data adat digunakan untuk menentukan hukum jika darah melebihi 60 hari (nifas campur istihadhah). Umumnya wanita tidak haid saat hamil, sehingga adat suci adalah masa suci saat hamil.
        </div>
    </div>

    <!-- PERIODE DARAH & BERSIH -->
    <div class="n-card">
        <div class="n-card-title">
            <div class="n-icon-circle-red"><i class="fas fa-list-ul"></i></div> Periode Darah & Bersih
        </div>

        <div id="n-darah-container">
            <div class="n-darah-block">
                <div class="n-darah-header">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-tint"></i> <strong>Keluar Darah ke-<span class="n-darah-index">1</span></strong>
                    </div>
                    <i class="far fa-trash-alt n-btn-delete" style="color:#777; cursor:pointer;"></i>
                </div>
                
                <label class="n-label-red">MULAI KELUAR DARAH</label>
                <div class="n-input-row-half">
                    <div class="n-input-wrapper">
                        <input type="date" class="n-input n-input-red n-date-picker">
                        <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                    </div>
                    <div class="n-input-wrapper">
                        <input type="time" class="n-input n-input-red n-time-picker">
                        <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                    </div>
                </div>

                <label class="n-label-red" style="margin-top:15px;">DARAH BERHENTI (MULAI BERSIH)</label>
                <div class="n-input-row-half">
                    <div class="n-input-wrapper">
                        <input type="date" class="n-input n-input-red n-date-picker">
                        <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                    </div>
                    <div class="n-input-wrapper">
                        <input type="time" class="n-input n-input-red n-time-picker">
                        <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                    </div>
                </div>
            </div>
        </div>

        <button class="n-btn-dashed" id="n-btn-add-periode">
            <i class="fas fa-plus"></i> Tambah Periode
        </button>
    </div>

    <!-- TEMPEL DATA -->
    <div class="n-card n-card-pink">
        <div class="n-card-title">
            <div class="n-icon-circle-red"><i class="far fa-clipboard"></i></div> Tempel Data dari Kalender
        </div>
        <p class="n-info-text-dark">Tempel ringkasan data dari catatan kalender, tanggal lahir dan periode akan terisi otomatis.</p>
        
        <textarea class="n-textarea" rows="4" placeholder="Tempel data di sini (format KD 1 : / B 1 : ... dengan Mulai & Selesai)..."></textarea>
        
        <button class="n-btn-outline-pink">
            <i class="far fa-clipboard"></i> Terapkan Data ke Form
        </button>
    </div>

    <!-- BOTTOM ACTIONS -->
    <div class="n-bottom-actions">
        <button class="n-btn-solid">
            <i class="fas fa-calculator"></i> Hitung Hukum Nifas
        </button>
        <button class="n-btn-reset" id="n-btn-reset">
            <i class="fas fa-sync-alt"></i>
        </button>
    </div>

</div>
