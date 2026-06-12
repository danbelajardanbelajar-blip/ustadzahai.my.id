<div class="q-bg-gradient"></div>

<div class="q-container">
    
    <!-- HEADER -->
    <div class="q-header">
        <div style="text-align: left; margin-bottom: 10px;">
            <a href="index.php" style="color: #d3557d; text-decoration: none; font-size: 16px; font-weight: bold;"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="q-icon-moon-wrapper">
            <div class="q-icon-moon"><i class="far fa-moon"></i></div>
        </div>
        <h1>Kalkulator Qadha Puasa <br> <span style="color: #d3557d;">& Fidyah</span></h1>
        <p><i class="fas fa-star-of-life" style="color: #d3557d; font-size: 8px;"></i> Berdasarkan Fiqih Madzhab Syafi'i — Hitung hutang puasa dan<br>denda fidyah Anda dengan mudah</p>
        
        <div class="q-badges">
            <span class="q-badge">Madzhab Syafi'i</span>
            <span class="q-badge">Qadha & Fidyah</span>
            <span class="q-badge">Multi-Tahun</span>
        </div>
    </div>

    <!-- FORMULIR INDICATOR -->
    <div class="q-divider-wrapper">
        <div class="q-divider-line"></div>
        <div class="q-formulir-pill">
            <i class="fas fa-pencil-alt"></i> Formulir 1 — Aktif
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="q-card">
        <div class="q-card-title">
            <i class="far fa-calendar-alt" style="color: #d3557d; font-size: 16px;"></i> 
            <span>Formulir Input Data 1</span>
        </div>

        <div class="q-section-title">
            <i class="far fa-moon" style="color: #d3557d;"></i> 
            <i class="far fa-calendar-alt" style="color: #6c5ce7;"></i> 
            <span>Pilih Tahun Ramadhan</span>
        </div>

        <!-- SELECTED YEAR SUMMARY (Hidden by default) -->
        <div class="q-selected-year-box" id="q-selected-year-box" style="display: none;">
            <div class="q-selected-icon"><i class="fas fa-check"></i></div>
            <div class="q-selected-text">
                <div class="q-selected-title" id="q-selected-title">Ramadhan 1448 H</div>
                <div class="q-selected-desc" id="q-selected-desc">2027 Masehi • Mulai 8 Februari 2027</div>
            </div>
        </div>

        <!-- CAROUSEL NAVIGATION -->
        <div class="q-carousel-nav">
            <i class="fas fa-chevron-left q-nav-arrow" style="color: #d3557d;"></i>
            <span class="q-nav-text">1448 H – 1450 H</span>
            <i class="fas fa-chevron-right q-nav-arrow" style="color: #ffb3cc;"></i>
        </div>

        <!-- YEAR CARDS -->
        <div class="q-year-cards-container">
            <div class="q-year-card" data-year-h="1448 H" data-year-m="2027 M" data-start="Mulai 8 Februari 2027">
                <div class="q-year-title">1448 H</div>
                <div class="q-year-subtitle">2027 M</div>
                <div class="q-year-date">Mulai 8 Februari 2027</div>
            </div>

            <div class="q-year-card" data-year-h="1449 H" data-year-m="2028 M" data-start="Mulai 28 Januari 2028">
                <div class="q-year-title">1449 H</div>
                <div class="q-year-subtitle">2028 M</div>
                <div class="q-year-date">Mulai 28 Januari 2028</div>
            </div>

            <div class="q-year-card" data-year-h="1450 H" data-year-m="2029 M" data-start="Mulai 16 Januari 2029">
                <div class="q-year-title">1450 H</div>
                <div class="q-year-subtitle">2029 M</div>
                <div class="q-year-date">Mulai 16 Januari 2029</div>
            </div>
        </div>

        <!-- DOTS -->
        <div class="q-dots">
            <span class="q-dot"></span>
            <span class="q-dot"></span>
            <span class="q-dot"></span>
            <span class="q-dot q-dot-active"></span>
        </div>

        <!-- ALASAN DROPDOWN -->
        <div class="q-question-title">
            <span style="color: #d3557d; font-weight: bold; font-size: 14px;">?</span>
            <span>Apa alasan meninggalkan puasa di Ramadhan ini?</span>
        </div>

        <div class="q-custom-select" id="q-custom-select">
            <div class="q-select-trigger" id="q-select-trigger">
                <span id="q-select-text">Pilih alasan...</span>
                <i class="fas fa-chevron-down" style="color: #aaa;"></i>
            </div>
            
            <div class="q-select-options" id="q-select-options">
                <div class="q-option" data-value="anak_kecil">👶 Anak Kecil</div>
                <div class="q-option" data-value="gila_tidak_sengaja">🧠 Gila yang tidak disengaja</div>
                <div class="q-option" data-value="gila_sengaja">🧠 Gila yang disengaja</div>
                <div class="q-option" data-value="sakit_harapan">🤒 Sakit yang ada harapan sembuh</div>
                <div class="q-option" data-value="sakit_tanpa_harapan">♿ Sakit yang tidak ada harapan sembuh</div>
                <div class="q-option" data-value="sangat_tua">🧓 Orang yang sangat tua</div>
                <div class="q-option" data-value="musafir">🧳 Orang yang bepergian (musafir)</div>
                <div class="q-option" data-value="hamil_diri">🤰 Hamil/menyusui (Khawatir diri sendiri)</div>
                <div class="q-option" data-value="hamil_diri_bayi">🤰 Hamil/menyusui (Khawatir diri & bayi)</div>
                <div class="q-option" data-value="hamil_bayi">🤰 Hamil/menyusui (Khawatir bayinya saja)</div>
                <div class="q-option" data-value="haid">🩸 Haid</div>
                <div class="q-option" data-value="nifas">🩸 Nifas</div>
                <div class="q-option" data-value="jima">⚠️ Jima'/bersetubuh di siang hari</div>
            </div>
            <input type="hidden" id="q-hidden-alasan" value="">
        </div>

        <!-- JUMLAH HARI INPUT -->
        <div class="q-question-title" style="margin-top: 20px;">
            <span style="color: #d3557d; font-weight: bold; font-size: 14px;">#</span>
            <span>Berapa hari meninggalkan puasa?</span>
        </div>
        <div class="q-input-wrapper">
            <input type="number" id="q-input-hari" class="q-input" placeholder="Contoh: 7" min="1" max="30">
        </div>

    </div> <!-- End Card -->

    <!-- RESULT CARD (Hidden initially) -->
    <div class="q-result-card" id="q-result-card" style="display: none;">
        <div class="q-result-title">
            <i class="far fa-file-alt" style="color: #6c5ce7;"></i> Hasil Perhitungan
        </div>
        
        <div class="q-result-item">
            <span class="q-result-label">Qadha Puasa</span>
            <span class="q-result-value" id="res-qadha">-</span>
        </div>
        
        <div class="q-result-item">
            <span class="q-result-label">Membayar Fidyah</span>
            <span class="q-result-value" id="res-fidyah">-</span>
        </div>

        <div id="res-kifarah" class="q-kifarah-box" style="display: none;">
            <div class="q-kifarah-title"><i class="fas fa-exclamation-triangle"></i> Denda Kifarah Jima'</div>
            Berdasarkan urutan kemampuan:<br>
            1. Memerdekakan budak<br>
            2. Puasa 2 bulan terus menerus<br>
            3. Memberi makan 60 orang miskin
        </div>
    </div>

    <!-- BOTTOM ACTIONS -->
    <div class="q-action-container">
        <button class="q-btn-solid" id="btn-hitung-qadha">
            <i class="fas fa-calculator"></i> Hitung Hasil
        </button>
        
        <div class="q-btn-mulai-ulang" id="q-btn-mulai-ulang">
            <i class="fas fa-undo-alt"></i> Mulai Ulang
        </div>

        <div class="q-divider-line" style="margin: 30px 0;"></div>

        <button class="q-btn-outline-red" id="q-btn-reset-semua">
            <i class="fas fa-undo"></i> Hitung Ulang (Reset Semua Data)
        </button>
    </div>

</div>
