<div class="k-header">
    <div class="k-title-row">
        <a href="index.php" style="color: #d3557d; margin-right: 15px; text-decoration: none; font-size: 20px;"><i class="fas fa-arrow-left"></i></a>
        <i class="fas fa-tint k-icon-drop"></i>
        <div class="k-title-text">
            <h2>Kalender Fiqih Haid</h2>
            <p>Haid · Nifas · Istihadhah · Madzhab Syafi'i</p>
        </div>
    </div>

    <div class="k-nav-row">
        <button class="k-btn-today" id="btn-today">
            Hari Ini<br><span id="today-label">10 Juni<br>25 Dzulhijjah</span>
        </button>
        <div class="k-nav-arrows">
            <button id="btn-prev"><i class="fas fa-chevron-left"></i></button>
            <button id="btn-next"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="k-month-label" id="month-label">
            <strong>Juni 2026</strong><br>Dzulhijjah 1447
        </div>
    </div>

    <button class="k-btn-sholat" id="btn-sholat">
        <i class="far fa-clock"></i> Jadwal Sholat
    </button>

    <div id="sholat-panel" class="k-sholat-panel" style="display: none;">
        <div class="k-sholat-header">
            <div class="k-sholat-title">
                <i class="far fa-clock"></i> Jadwal Sholat <i class="fas fa-map-marker-alt" style="margin-left: 8px; font-size: 12px; color: #aaa;"></i> <span id="sholat-city" style="color: #888; font-size: 13px;">Meminta lokasi...</span>
            </div>
            <div class="k-sholat-actions">
                <i class="fas fa-sync-alt" id="btn-refresh-sholat" style="cursor:pointer;"></i>
                <i class="fas fa-times" id="btn-close-sholat" style="cursor:pointer; margin-left:10px;"></i>
            </div>
        </div>
        <div class="k-sholat-date" id="sholat-date"></div>
        
        <div class="k-sholat-grid" id="sholat-grid">
            <div style="text-align:center; grid-column: 1 / span 2; padding: 20px; font-size: 12px; color: #888;">Memuat data jadwal sholat...</div>
        </div>

        <div class="k-sholat-footer">
            <span>Sumber: Aladhan API - Metode Kemenag RI</span>
            <a href="#" id="btn-change-city" style="color:#c24669; text-decoration:underline;">Ganti kota</a>
        </div>
    </div>

    <div class="k-legend">
        <div class="k-legend-item"><span class="k-dot k-haid"></span> Haid</div>
        <div class="k-legend-item"><span class="k-dot k-nifas"></span> Nifas</div>
        <div class="k-legend-item"><span class="k-dot k-suci"></span> Suci</div>
        <div class="k-legend-item"><span class="k-dot k-melahirkan-outline"></span> Melahirkan (tanpa KD)</div>
        <div class="k-legend-item"><span class="k-dot k-melahirkan-solid"></span> Melahirkan + KD</div>
    </div>
</div>

<div class="k-calendar-wrapper">
    <div class="k-weekdays">
        <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
    </div>
    <div class="k-days-grid" id="calendar-grid">
        <!-- Rendered by JS -->
    </div>
</div>

<div class="k-notes-container">
    <!-- Catatan Box -->
    <div class="k-card">
        <div class="k-card-header">
            <i class="fas fa-book-open" style="color: #c24669; font-size: 18px;"></i>
            <h3>Catatan</h3>
        </div>
        
        <div class="k-note-box k-box-blue" id="box-sholat">
            <h4>Qadha Sholat</h4>
            <div id="list-sholat" class="k-item-list"></div>
            <button class="k-btn-add k-text-blue" onclick="addNote('sholat')">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>

        <div class="k-note-box k-box-orange" id="box-puasa">
            <h4>Qadha Puasa</h4>
            <div id="list-puasa" class="k-item-list"></div>
            <button class="k-btn-add k-text-orange" onclick="addNote('puasa')">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>

        <div class="k-note-box k-box-green" id="box-mandi">
            <h4>Mandi Wajib</h4>
            <div id="list-mandi" class="k-item-list"></div>
            <button class="k-btn-add k-text-green" onclick="addNote('mandi')">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>

    <!-- Catatan Tahun Box -->
    <div class="k-card">
        <div class="k-card-header">
            <i class="fas fa-book" style="color: #c24669; font-size: 18px;"></i>
            <h3 id="year-note-title">Catatan Tahun 2026 M / 1447 H</h3>
            <button class="k-btn-edit" onclick="editYearNote()"><i class="fas fa-pencil-alt"></i></button>
        </div>
        <p class="k-year-desc">Catat qadha puasa yang sudah/belum dibayar, hutang ibadah, atau catatan penting lainnya tahun ini.</p>
        
        <div class="k-year-input-area" id="year-note-area" onclick="editYearNote()">
            <span id="year-note-placeholder" style="color:#aaa;font-style:italic">Ketuk untuk mulai menulis catatan tahun ini...</span>
            <div id="year-note-text" style="display:none; white-space: pre-wrap; word-wrap: break-word; color:#333"></div>
        </div>
        <textarea id="year-note-textarea" style="display:none" rows="4"></textarea>
        <button id="btn-save-year-note" style="display:none; width:100%; margin-top:8px; padding:8px; background:#c24669; color:white; border:none; border-radius:6px" onclick="saveYearNote()">Simpan</button>
    </div>
</div>
