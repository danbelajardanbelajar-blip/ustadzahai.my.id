<div class="c-header">
    <div class="c-title-row">
        <div class="c-icon-box-main">
            <i class="fas fa-tint"></i>
        </div>
        <h2>Kalkulator Fiqih Haid</h2>
    </div>
    <p class="c-subtitle">Pilih kategori wanita untuk memulai analisa</p>
</div>

<div class="c-tabs">
    <button class="c-tab active" data-tab="mubtadaah" id="tab-mubtadaah">
        <i class="fas fa-spa c-tab-icon" style="color: #ff4d85;"></i>
        <div class="c-tab-title" style="color: #ff4d85;">Mubtadaah</div>
        <div class="c-tab-subtitle">Pertama kali haid</div>
    </button>
    <button class="c-tab" data-tab="mutadah" id="tab-mutadah">
        <i class="far fa-calendar-alt c-tab-icon" style="color: #6c5ce7;"></i>
        <div class="c-tab-title" style="color: #6c5ce7;">Mu'tadah</div>
        <div class="c-tab-subtitle">Punya adat</div>
    </button>
    <button class="c-tab" data-tab="mutahayyiroh" id="tab-mutahayyiroh">
        <i class="fas fa-hurricane c-tab-icon" style="color: #00cec9;"></i>
        <div class="c-tab-title" style="color: #00cec9;">Mutahayyiroh</div>
        <div class="c-tab-subtitle">Lupa adat haid</div>
    </button>
</div>

<div class="c-content-area">
    <!-- MUBTADAAH SECTION -->
    <div id="section-mubtadaah" class="c-section active">
        <div class="c-card c-card-pink">
            <div class="c-card-header c-text-pink">
                <i class="fas fa-baby"></i> DATA KELAHIRAN *
            </div>
            <p class="c-warning-text">Wajib diisi untuk mendeteksi apakah darah pertama keluar diusia minimal haid (9 tahun Hijriah - 16 hari - 1 detik).</p>
            
            <div class="c-input-row">
                <div class="c-input-group">
                    <label>Tanggal Lahir</label>
                    <div class="c-input-with-icon">
                        <input type="date" value="2026-06-17" class="c-input date-picker">
                        <i class="far fa-calendar-alt" onclick="this.previousElementSibling.showPicker()" style="cursor:pointer"></i>
                    </div>
                </div>
                <div class="c-input-group">
                    <label>Jam Lahir</label>
                    <div class="c-input-with-icon">
                        <input type="time" value="00:00" class="c-input time-picker">
                        <i class="far fa-clock" onclick="this.previousElementSibling.showPicker()" style="cursor:pointer"></i>
                    </div>
                </div>
            </div>

            <div class="c-result-box">
                <div class="c-result-row">
                    <span class="c-result-label">Tgl Lahir:</span>
                    <span class="c-result-val">17 Juni 2026 jam 00:00<br><span class="c-text-pink">1 Muharram 1448 H</span></span>
                </div>
                <div class="c-result-row">
                    <span class="c-result-label">Min. Haid:</span>
                    <span class="c-result-val">23 Februari 2035 jam 07.17<br><span class="c-text-pink">15 Dzulhijjah 1456 H</span></span>
                </div>
            </div>
        </div>

        <div class="c-card c-card-white">
            <div class="c-card-header c-text-gray">
                <i class="fas fa-balance-scale" style="color: #f39c12;"></i> PILIH ADAT (HAID / SUCI)
            </div>
            <div class="c-adat-options">
                <button class="c-adat-btn active"><strong>1 / 29</strong><br>hari</button>
                <button class="c-adat-btn"><strong>6 / 24</strong><br>hari</button>
                <button class="c-adat-btn"><strong>7 / 23</strong><br>hari</button>
            </div>
        </div>
    </div>

    <!-- MU'TADAH SECTION -->
    <div id="section-mutadah" class="c-section">
        <div class="c-card c-card-purple">
            <div class="c-card-header c-text-purple">
                <i class="far fa-calendar-alt"></i> ADAT MU'TADAH
            </div>
            <div class="c-input-row c-col-3">
                <div class="c-input-group">
                    <label style="text-align: center;">Haid (Hari)</label>
                    <input type="number" value="7" class="c-input c-text-center">
                </div>
                <div class="c-input-group">
                    <label style="text-align: center;">Waktu Suci</label>
                    <div class="c-input-with-icon">
                        <input type="time" value="23:49" class="c-input time-picker">
                        <i class="far fa-clock" onclick="this.previousElementSibling.showPicker()" style="cursor:pointer"></i>
                    </div>
                </div>
                <div class="c-input-group">
                    <label style="text-align: center;">Suci (Hari)</label>
                    <input type="number" value="23" class="c-input c-text-center">
                </div>
            </div>
        </div>
    </div>

    <!-- MUTAHAYYIROH SECTION -->
    <div id="section-mutahayyiroh" class="c-section">
        <div class="c-card c-card-white">
            <div class="c-card-header c-text-gray">
                <i class="fas fa-balance-scale" style="color: #f39c12;"></i> PILIH ADAT (HAID / SUCI)
            </div>
            <div class="c-adat-options">
                <button class="c-adat-btn active"><strong>1 / 29</strong><br>hari</button>
                <button class="c-adat-btn"><strong>6 / 24</strong><br>hari</button>
                <button class="c-adat-btn"><strong>7 / 23</strong><br>hari</button>
            </div>
        </div>
    </div>

    <!-- COMMON SECTION: DATA KELUAR DARAH -->
    <div class="c-common-header">
        <i class="fas fa-tint" style="color: #ff4d85;"></i> DATA KELUAR DARAH
    </div>

    <div id="darah-blocks-container">
        <!-- Darah Block 1 -->
        <div class="c-card c-card-pink c-darah-block">
            <div class="c-card-header c-text-dark">
                <div class="c-icon-circle-red"><i class="fas fa-history"></i></div>
                <strong>Keluar Darah <span class="darah-index">1</span></strong>
            </div>
            
            <div class="c-input-group c-mt-10">
                <label class="c-label-small">TANGGAL & JAM KELUAR</label>
                <div class="c-input-row">
                    <div class="c-input-with-icon">
                        <input type="date" class="c-input date-picker">
                        <i class="far fa-calendar-alt" onclick="this.previousElementSibling.showPicker()" style="cursor:pointer"></i>
                    </div>
                    <div class="c-input-with-icon">
                        <input type="time" value="00:00" class="c-input time-picker">
                        <i class="far fa-clock" onclick="this.previousElementSibling.showPicker()" style="cursor:pointer"></i>
                    </div>
                </div>
            </div>

            <div class="c-input-group c-mt-10">
                <label class="c-label-small">TANGGAL & JAM BERSIH</label>
                <div class="c-input-row">
                    <div class="c-input-with-icon">
                        <input type="date" class="c-input date-picker">
                        <i class="far fa-calendar-alt" onclick="this.previousElementSibling.showPicker()" style="cursor:pointer"></i>
                    </div>
                    <div class="c-input-with-icon">
                        <input type="time" value="00:00" class="c-input time-picker">
                        <i class="far fa-clock" onclick="this.previousElementSibling.showPicker()" style="cursor:pointer"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTION BUTTONS -->
    <button class="c-btn-dashed" id="btn-tambah-darah">
        <i class="fas fa-plus"></i> Tambah Keluar Darah
    </button>

    <div class="c-card c-card-pink-outline c-mt-15">
        <div class="c-card-header c-text-pink c-space-between">
            <div><i class="far fa-clock"></i> Ringkasan Keluar Darah</div>
            <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
        </div>
    </div>

    <button class="c-btn-dashed c-mt-15">
        <i class="far fa-clipboard"></i> Paste Ringkasan Data dari Kalender Haid
    </button>

    <button class="c-btn-solid c-mt-15">
        <i class="fas fa-search"></i> Analisa Hukum Darah
    </button>

    <button class="c-btn-dashed c-mt-15" id="btn-reset">
        <i class="fas fa-undo"></i> Hitung Baru (Reset Semua)
    </button>
</div>
