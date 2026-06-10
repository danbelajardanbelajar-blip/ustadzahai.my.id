<div class="q-bg-gradient"></div>

<div class="q-container">
    
    <!-- HEADER -->
    <div class="q-header">
        <div style="text-align: left; margin-bottom: 10px;">
            <a href="index.php" style="color: white; text-decoration: none; font-size: 16px;"><i class="fas fa-arrow-left"></i> Kembali</a>
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
            <i class="far fa-question-circle" style="color: #aaa; font-size: 12px;"></i>
        </div>

        <div class="q-custom-select" id="q-custom-select">
            <div class="q-select-trigger" id="q-select-trigger">
                <span id="q-select-text">Pilih alasan...</span>
                <i class="fas fa-chevron-down" style="color: #aaa;"></i>
            </div>
            
            <div class="q-select-options" id="q-select-options">
                <div class="q-option" data-value="haid">
                    <span class="q-opt-icon">🩸</span> Haid / Nifas
                </div>
                <div class="q-option" data-value="sakit">
                    <span class="q-opt-icon">🤒</span> Sakit (bisa sembuh)
                </div>
                <div class="q-option" data-value="hamil1">
                    <span class="q-opt-icon">🤰</span> Hamil/Menyusui (khawatir anak)
                </div>
                <div class="q-option" data-value="hamil2">
                    <span class="q-opt-icon">🤰</span> Hamil/Menyusui (khawatir diri sendiri)
                </div>
                <div class="q-option" data-value="hamil3">
                    <span class="q-opt-icon">🤰</span> Hamil/Menyusui (khawatir diri sendiri + anak)
                </div>
                <div class="q-option" data-value="safar">
                    <span class="q-opt-icon">🧳</span> Dalam Perjalanan (Safar)
                </div>
                <div class="q-option" data-value="sengaja">
                    <span class="q-opt-icon">⚠️</span> Sengaja tidak puasa
                </div>
                <div class="q-option" data-value="lupa">
                    <span class="q-opt-icon">💭</span> Lupa niat di malam hari
                </div>
                <div class="q-option" data-value="lansia">
                    <span class="q-opt-icon">🧓</span> Sakit permanen / Lansia
                </div>
            </div>
        </div>

    </div> <!-- End Card -->

    <!-- BOTTOM ACTIONS -->
    <div class="q-action-container">
        <button class="q-btn-solid">
            <i class="fas fa-calculator"></i> Hitung Formulir 1
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
