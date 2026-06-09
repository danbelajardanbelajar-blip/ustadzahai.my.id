<link rel="stylesheet" href="app/assets/css/kalkulator-fiqih-haid.css">

<div class="header">
	<div class="badge">🩸</div>
	<h1>Kalkulator Fiqih Haid</h1>
</div>

<div class="content">
	<div class="page-card">
		<p class="intro-text">Pilih kategori wanita untuk memulai analisa</p>

		<!-- Category Selection -->
		<div class="category-buttons">
			<button type="button" class="category-btn active" data-category="mubtadaah" onclick="selectCategory(this, 'mubtadaah')">
				<div class="category-emoji">🌸</div>
				<div class="category-title">Mubtadaah</div>
				<div class="category-subtitle">Pertama kali haid</div>
			</button>
			<button type="button" class="category-btn" data-category="mutadah" onclick="selectCategory(this, 'mutadah')">
				<div class="category-emoji">📅</div>
				<div class="category-title">Mu'tadah</div>
				<div class="category-subtitle">Punya adat</div>
			</button>
			<button type="button" class="category-btn" data-category="mutahayiroh" onclick="selectCategory(this, 'mutahayiroh')">
				<div class="category-emoji">🌀</div>
				<div class="category-title">Mutahayyiroh</div>
				<div class="category-subtitle">Lupa adat haid</div>
			</button>
		</div>

		<!-- Data Kelahiran (tampil untuk Mubtadaah dan default) -->
		<div id="kelahiranPanel" class="data-section">
			<div class="section-header">
				<span class="section-emoji">😊</span>
				<h3 class="section-title required">DATA KELAHIRAN</h3>
			</div>
			<p class="section-desc">Wajib diisi untuk mendeteksi apakah darah pertama keluar di usia minimal haid (9 tahun Hijriah − 16 hari − 1 detik).</p>
			<div class="input-row">
				<div class="input-group">
					<label class="input-label">Tanggal Lahir</label>
					<input type="date" id="tanggalLahir">
				</div>
				<div class="input-group">
					<label class="input-label">Jam Lahir</label>
					<input type="time" id="jamLahir" value="00:00">
				</div>
			</div>
			<div id="kelahiranDetails" style="margin-top:10px;color:#6b6b6b;font-size:13px"></div>
		</div>

		<!-- Adat Mu'tadah panel (tampil saat pilih Mu'tadah) -->
		<div id="mutadahPanel" class="data-section" style="display:none">
			<div class="section-header">
				<span class="section-emoji">📘</span>
				<h3 class="section-title">ADAT MU'TADAH</h3>
			</div>
			<div class="input-row">
				<div class="input-group">
					<label class="input-label">Haid (Hari)</label>
					<input type="number" id="mutadahHaid" value="7" min="1" max="30">
				</div>
				<div class="input-group">
					<label class="input-label">Waktu Suci</label>
					<input type="time" id="mutadahWaktu" value="23:49">
				</div>
				<div class="input-group">
					<label class="input-label">Suci (Hari)</label>
					<input type="number" id="mutadahSuci" value="23" min="1" max="60">
				</div>
			</div>
		</div>

		<!-- Pilih Adat (default) -->
		<div class="data-section">
			<div class="section-header">
				<span class="section-emoji">⚖️</span>
				<h3 class="section-title">PILIH ADAT (HAID / SUCI)</h3>
			</div>
			<div class="adat-buttons">
				<button type="button" class="adat-btn" data-adat="1/29" onclick="selectAdat(this, '1/29')"><strong>1 / 29</strong><span class="adat-duration">hari</span></button>
				<button type="button" class="adat-btn" data-adat="6/24" onclick="selectAdat(this, '6/24')"><strong>6 / 24</strong><span class="adat-duration">hari</span></button>
				<button type="button" class="adat-btn" data-adat="7/23" onclick="selectAdat(this, '7/23')"><strong>7 / 23</strong><span class="adat-duration">hari</span></button>
				<button type="button" class="adat-btn" data-adat="8/22" onclick="selectAdat(this, '8/22')"><strong>8 / 22</strong><span class="adat-duration">hari</span></button>
				<button type="button" class="adat-btn" data-adat="9/21" onclick="selectAdat(this, '9/21')"><strong>9 / 21</strong><span class="adat-duration">hari</span></button>
				<button type="button" class="adat-btn" data-adat="10/20" onclick="selectAdat(this, '10/20')"><strong>10 / 20</strong><span class="adat-duration">hari</span></button>
			</div>
		</div>

		<!-- Data Keluar Darah -->
		<div class="data-section">
			<div class="section-header">
				<span class="section-emoji">🩸</span>
				<h3 class="section-title">DATA KELUAR DARAH</h3>
			</div>
			<div id="keluarDarahContainer"></div>
			<button type="button" class="btn-add" onclick="tambahDataKeluarDarah()">+ Tambah Keluar Darah</button>
		</div>

		<!-- Ringkasan Keluar Darah (collapsible) -->
		<button type="button" class="collapsible-btn" onclick="toggleHasil(this)">
			<div style="display:flex;align-items:center;gap:8px;">
				<span>Ringkasan Keluar Darah</span>
			</div>
			<span class="arrow">▼</span>
		</button>
		<div class="collapsible-content">
			<div id="ringkasanList"></div>
		</div>

		<button type="button" class="btn-secondary" onclick="pasteFromKalender()">Paste Ringkasan Data dari Kalender Haid</button>

		<button type="button" class="btn-primary" onclick="analisisHukum()">Analisa Hukum Darah</button>

		<button type="button" class="btn-secondary" onclick="resetSemua()">Hitung Baru (Reset Semua)</button>

		<div id="hasilAnalisis" style="display:none;margin-top:16px"></div>

	</div>
</div>

<a href="index.php?page=home" class="list-card">
	<div class="list-icon" style="background: linear-gradient(135deg, #7c4dff, #536dfe);"><i class="fas fa-arrow-left"></i></div>
	<div class="list-text"><h3>Kembali ke Home</h3><p>Halaman utama Ustadzah AI</p></div>
</a>

<script src="app/assets/js/kalkulator-fiqih-haid.js"></script>
