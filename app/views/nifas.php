<div class="n-bg-gradient"></div>

<div class="n-container">
    
    <!-- HEADER -->
    <div class="n-header">
        <div style="text-align: left; margin-bottom: 10px;">
            <a href="index.php" style="color: #d3557d; text-decoration: none; font-size: 16px; font-weight: bold;"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="n-icon-moon"><i class="far fa-moon"></i></div>
        <h1>Kalkulator Fiqih Nifas</h1>
        <p>Menghitung hukum darah nifas berdasarkan Madzhab Syafi'i. Masukkan data kelahiran dan periode darah/bersih untuk mengetahui hukum fiqihnya.</p>
        <div class="n-badge"><i class="far fa-comment-dots"></i> Madzhab Syafi'i</div>
    </div>

    <!-- TANGGAL MELAHIRKAN -->
    <div class="n-card">
        <div class="n-card-title">
            <div class="n-icon-circle-red"><i class="far fa-clock"></i></div> Tanggal & Waktu Melahirkan
        </div>
        
        <div class="n-input-group">
            <label class="n-label-black">TANGGAL</label>
            <div class="n-input-wrapper">
                <input type="date" class="n-input n-date-picker" id="n-lahir-date">
                <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
            </div>
        </div>

        <div class="n-input-group">
            <label class="n-label-black">WAKTU</label>
            <div class="n-input-wrapper">
                <input type="time" value="12:00" class="n-input n-time-picker" id="n-lahir-time">
                <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
            </div>
        </div>
        
        <p class="n-info-text">Awal nifas secara hitungan dihitung sejak kosongnya rahim (melahirkan seluruh tubuh bayi).</p>
    </div>

    <!-- DATA ADAT -->
    <div class="n-card">
        <div class="n-card-title">
            <div class="n-icon-circle-red"><i class="fas fa-undo"></i></div> Data Adat (Kebiasaan)
        </div>

        <label class="n-label-black-bold">Adat Nifas</label>
        
        <label class="n-radio-option selected" id="opt-nifas-lupa">
            <input type="radio" name="adat_nifas" value="lupa" checked>
            <div class="n-radio-content">
                <div class="n-radio-title">Pertama kali nifas / Pernah nifas lupa adat</div>
                <div class="n-radio-desc">Adat nifas dihitung 40 hari, jam/menit nifas mengikuti jam KD 1</div>
            </div>
        </label>
        
        <label class="n-radio-option" id="opt-nifas-ingat">
            <input type="radio" name="adat_nifas" value="ingat">
            <div class="n-radio-content">
                <div class="n-radio-title">Pernah nifas ingat adat</div>
                <div class="n-radio-desc">Masukkan jumlah hari dan jam/menit suci adat nifas</div>
            </div>
        </label>

        <!-- Container for Adat Nifas Ingat -->
        <div id="container-nifas-ingat" style="display:none; padding-left:15px; margin-bottom:20px;">
            <div class="n-input-group">
                <label class="n-label-black">HARI ADAT NIFAS</label>
                <input type="number" class="n-input" id="input-nifas-hari" placeholder="Contoh: 40">
            </div>
        </div>

        <label class="n-label-black-bold" style="margin-top:20px;">Adat Haid</label>
        
        <label class="n-radio-option selected" id="opt-haid-belum">
            <input type="radio" name="adat_haid" value="belum" checked>
            <div class="n-radio-content">
                <div class="n-radio-title">Belum pernah haid</div>
                <div class="n-radio-desc">Pilih pasangan adat haid / suci, jam mengikuti jam KD 1</div>
            </div>
        </label>
        
        <label class="n-radio-option" id="opt-haid-lupa">
            <input type="radio" name="adat_haid" value="lupa">
            <div class="n-radio-content">
                <div class="n-radio-title">Pernah haid lupa adat</div>
                <div class="n-radio-desc">Pilih pasangan adat haid / suci, jam mengikuti jam KD 1</div>
            </div>
        </label>
        
        <label class="n-radio-option" id="opt-haid-ingat">
            <input type="radio" name="adat_haid" value="ingat">
            <div class="n-radio-content">
                <div class="n-radio-title">Pernah haid ingat adat</div>
                <div class="n-radio-desc">Masukkan adat haid, adat suci, dan jam suci adat haid</div>
            </div>
        </label>
        
        <div id="pasangan-haid-suci-container">
            <label class="n-label-black" style="font-size:10px; margin-bottom:8px; display:block;">Pilih pasangan Haid / Suci:</label>
            <div class="n-pills-row">
                <button type="button" class="n-pill selected" data-haid="1" data-suci="29">1/29</button>
                <button type="button" class="n-pill" data-haid="6" data-suci="24">6/24</button>
                <button type="button" class="n-pill" data-haid="7" data-suci="23">7/23</button>
            </div>
            <p class="n-info-text-small">Format: Haid (hari) / Suci (hari) -- Jam suci mengikuti jam KD 1</p>
        </div>

        <!-- Container for Adat Haid Ingat -->
        <div id="container-haid-ingat" style="display:none; padding-left:15px; margin-top:15px;">
            <div class="n-input-row-half">
                <div class="n-input-group">
                    <label class="n-label-black">ADAT HAID</label>
                    <input type="number" class="n-input" id="input-haid-hari" placeholder="Hari">
                </div>
                <div class="n-input-group">
                    <label class="n-label-black">ADAT SUCI</label>
                    <input type="number" class="n-input" id="input-suci-hari" placeholder="Hari">
                </div>
            </div>
            <div class="n-input-group">
                <label class="n-label-black">JAM MULAI SUCI</label>
                <div class="n-input-wrapper">
                    <input type="time" class="n-input" id="input-suci-jam">
                    <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                </div>
            </div>
        </div>

        <div class="n-warning-box-grey">
            Data adat digunakan untuk menentukan hukum jika terjadi Mustahadhah fin Nifas atau Mustahadhah fil Haid.
        </div>
    </div>

    <!-- PERIODE DARAH & BERSIH -->
    <div class="n-card">
        <div class="n-card-title">
            <div class="n-icon-circle-red"><i class="fas fa-tint"></i></div> Periode Darah & Bersih
        </div>

        <div id="n-darah-container">
            <div class="n-darah-block-new">
                <div class="n-darah-badge-row">
                    <div class="n-darah-badge"><div class="n-dot"></div> KD <span class="n-darah-index">1</span> <span class="n-badge-pink" style="display:none;"></span></div>
                    <i class="far fa-trash-alt n-btn-delete" style="color:#bbb; cursor:pointer;"></i>
                </div>
                
                <label class="n-label-black" style="font-size:10px;">MULAI KELUAR DARAH</label>
                <div class="n-input-wrapper" style="margin-bottom:10px;">
                    <input type="date" class="n-input n-date-picker">
                    <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                </div>
                <div class="n-input-wrapper">
                    <input type="time" class="n-input n-time-picker">
                    <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                </div>
                
                <label class="n-label-black" style="font-size:10px; margin-top:15px;">DARAH BERHENTI (MULAI BERSIH)</label>
                <div class="n-input-wrapper" style="margin-bottom:10px;">
                    <input type="date" class="n-input n-date-picker">
                    <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                </div>
                <div class="n-input-wrapper">
                    <input type="time" class="n-input n-time-picker">
                    <i class="fas fa-chevron-down n-icon-right" onclick="this.previousElementSibling.showPicker()"></i>
                </div>
            </div>
        </div>

        <button type="button" class="n-btn-add-periode-new" id="n-btn-add-periode">
            <i class="fas fa-plus"></i> Tambah Periode
        </button>
    </div>

    <!-- TEMPEL DATA -->
    <div class="n-card">
        <div class="n-card-title">
            <div class="n-icon-circle-grey"><i class="far fa-clipboard"></i></div> Tempel Data dari Kalender
        </div>
        <p class="n-info-text" style="color:#777; margin-bottom:10px;">Tempel ringkasan data dari catatan kalender... Tanggal lahir dan periode akan terisi otomatis.</p>
        
        <div class="n-paste-box">
            <textarea class="n-textarea-borderless" rows="4" placeholder="Contoh format:
Lahir: 2024-01-15 08:30
Darah: 2024-01-15 - 2024-01-20
Darah: 2024-02-01 - 2024-02-05"></textarea>
        </div>
        
        <button type="button" class="n-btn-transparent">Terapkan Data ke Form</button>
    </div>

    <!-- BOTTOM ACTIONS -->
    <div class="n-bottom-actions">
        <button type="button" class="n-btn-solid" id="btn-hitung-nifas">
            <i class="far fa-file-alt"></i> Hitung Hukum Nifas
        </button>
        <button type="button" class="n-btn-reset" id="n-btn-reset">
            <i class="fas fa-sync-alt"></i>
        </button>
    </div>

    <!-- HASIL ANALISIS -->
    <div class="n-card" id="n-result-card" style="display:none;">
        <div class="n-card-title">
            <div class="n-icon-circle-red"><i class="far fa-file-alt"></i></div> Hasil Analisis Hukum Nifas
        </div>
        
        <div id="n-error-box" class="n-error-box" style="display:none;">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:5px;">
                <i class="fas fa-exclamation-triangle" style="color:#d32f2f;"></i>
                <span style="font-weight:bold; color:#333; font-size:12px;">Data Tidak Valid</span>
                <span class="n-badge-error">Error</span>
            </div>
            <p id="n-error-message" style="margin:0; font-size:11px; color:#555; padding-left:22px;"></p>
        </div>

        <div id="n-success-box" style="display:none;">
            <!-- Render hasil tabel disini -->
        </div>
    </div>

</div>
