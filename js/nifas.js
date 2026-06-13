(function() {

    // --- UI INTERACTION LOGIC --- //

    // Adat Nifas Toggle
    const optNifasLupa = document.getElementById('opt-nifas-lupa');
    const optNifasIngat = document.getElementById('opt-nifas-ingat');
    const containerNifasIngat = document.getElementById('container-nifas-ingat');

    document.getElementsByName('adat_nifas').forEach(radio => {
        radio.addEventListener('change', (e) => {
            optNifasLupa.classList.remove('selected');
            optNifasIngat.classList.remove('selected');
            e.target.closest('.n-radio-option').classList.add('selected');
            
            if (e.target.value === 'ingat') {
                containerNifasIngat.style.display = 'block';
            } else {
                containerNifasIngat.style.display = 'none';
            }
        });
    });

    // Adat Haid Toggle
    const optHaidBelum = document.getElementById('opt-haid-belum');
    const optHaidLupa = document.getElementById('opt-haid-lupa');
    const optHaidIngat = document.getElementById('opt-haid-ingat');
    const containerHaidIngat = document.getElementById('container-haid-ingat');
    const containerPasangan = document.getElementById('pasangan-haid-suci-container');

    document.getElementsByName('adat_haid').forEach(radio => {
        radio.addEventListener('change', (e) => {
            optHaidBelum.classList.remove('selected');
            optHaidLupa.classList.remove('selected');
            optHaidIngat.classList.remove('selected');
            e.target.closest('.n-radio-option').classList.add('selected');
            
            if (e.target.value === 'ingat') {
                containerHaidIngat.style.display = 'block';
                containerPasangan.style.display = 'none';
            } else {
                containerHaidIngat.style.display = 'none';
                containerPasangan.style.display = 'block';
            }
        });
    });

    // Pasangan Haid Suci Pills
    const pills = document.querySelectorAll('.n-pill');
    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            pills.forEach(p => p.classList.remove('selected'));
            pill.classList.add('selected');
        });
    });

    // Dynamic Periode Darah
    const btnTambah = document.getElementById('n-btn-add-periode');
    const containerDarah = document.getElementById('n-darah-container');

    btnTambah.addEventListener('click', () => {
        const index = containerDarah.children.length + 1;
        const newBlock = document.createElement('div');
        newBlock.className = 'n-darah-block-new';
        newBlock.innerHTML = `
            <div class="n-darah-badge-row">
                <div class="n-darah-badge"><div class="n-dot"></div> KD <span class="n-darah-index">${index}</span> <span class="n-badge-pink" style="display:none;"></span></div>
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
        `;
        containerDarah.appendChild(newBlock);

        // Delete logic
        newBlock.querySelector('.n-btn-delete').addEventListener('click', () => {
            newBlock.remove();
            reindexDarah();
        });
    });

    function reindexDarah() {
        Array.from(containerDarah.children).forEach((block, idx) => {
            block.querySelector('.n-darah-index').innerText = idx + 1;
        });
    }

    // Reset Logic
    document.getElementById('n-btn-reset').addEventListener('click', () => {
        if(confirm('Apakah Anda yakin ingin mereset seluruh isian form?')) {
            window.location.reload();
        }
    });


    // --- CALCULATION ENGINE --- //

    const btnHitung = document.getElementById('btn-hitung-nifas');
    const resultCard = document.getElementById('n-result-card');
    const errorBox = document.getElementById('n-error-box');
    const errorMessage = document.getElementById('n-error-message');
    const successBox = document.getElementById('n-success-box');

    function showError(msg) {
        resultCard.style.display = 'block';
        errorBox.style.display = 'block';
        successBox.style.display = 'none';
        errorMessage.innerText = msg;
        resultCard.scrollIntoView({behavior: 'smooth'});
    }

    function formatDurasi(ms) {
        let jam = ms / (1000 * 60 * 60);
        let hari = Math.floor(jam / 24);
        let sisaJam = jam % 24;
        if (hari > 0 && sisaJam > 0) return `${hari} hari ${sisaJam} jam`;
        if (hari > 0) return `${hari} hari`;
        return `${sisaJam} jam`;
    }

    function parseDateTime(dateStr, timeStr) {
        if (!dateStr || !timeStr) return null;
        return new Date(`${dateStr}T${timeStr}`);
    }

    btnHitung.addEventListener('click', () => {
        errorBox.style.display = 'none';
        successBox.innerHTML = '';

        // 1. Ambil Waktu Lahir
        const lahirDate = document.getElementById('n-lahir-date').value;
        const lahirTime = document.getElementById('n-lahir-time').value;
        if (!lahirDate || !lahirTime) return showError('Tanggal dan waktu melahirkan harus diisi lengkap.');
        const waktuLahir = parseDateTime(lahirDate, lahirTime);

        // 2. Ambil Adat Nifas
        let adatNifasHari = 40;
        if (document.querySelector('input[name="adat_nifas"]:checked').value === 'ingat') {
            const val = document.getElementById('input-nifas-hari').value;
            if (!val) return showError('Masukkan hari adat nifas.');
            adatNifasHari = parseInt(val);
        }

        // 3. Ambil Adat Haid
        let adatHaidHari = 1;
        let adatSuciHari = 29;
        const adatHaidVal = document.querySelector('input[name="adat_haid"]:checked').value;
        if (adatHaidVal === 'belum' || adatHaidVal === 'lupa') {
            const selectedPill = document.querySelector('.n-pill.selected');
            adatHaidHari = parseInt(selectedPill.getAttribute('data-haid'));
            adatSuciHari = parseInt(selectedPill.getAttribute('data-suci'));
        } else {
            const h = document.getElementById('input-haid-hari').value;
            const s = document.getElementById('input-suci-hari').value;
            if (!h || !s) return showError('Masukkan hari adat haid dan suci secara lengkap.');
            adatHaidHari = parseInt(h);
            adatSuciHari = parseInt(s);
        }

        // 4. Parse Periode Darah
        const blocks = containerDarah.children;
        let periods = [];
        for (let i=0; i<blocks.length; i++) {
            const inputsDate = blocks[i].querySelectorAll('input[type="date"]');
            const inputsTime = blocks[i].querySelectorAll('input[type="time"]');
            
            const start = parseDateTime(inputsDate[0].value, inputsTime[0].value);
            const end = parseDateTime(inputsDate[1].value, inputsTime[1].value);

            if (!start) return showError(`Waktu mulai keluar darah (KD ${i+1}) belum diisi.`);
            if (!end) return showError(`Waktu darah berhenti (KD ${i+1}) belum diisi.`);
            if (start < waktuLahir) return showError(`Mulai keluar darah (KD ${i+1}) tidak boleh mendahului waktu melahirkan.`);
            if (end <= start) return showError(`Waktu berhenti (KD ${i+1}) harus setelah waktu mulai.`);

            periods.push({start: start, end: end, id: i+1});
        }

        // Validate sequence
        for (let i=1; i<periods.length; i++) {
            if (periods[i].start < periods[i-1].end) {
                return showError(`Waktu keluar darah (KD ${i+1}) tumpang tindih / mundur dari waktu berhenti sebelumnya.`);
            }
        }

        // Build Timeline Segmen (Darah dan Bersih)
        let segments = [];
        let curTime = waktuLahir;
        
        for (let i=0; i<periods.length; i++) {
            let p = periods[i];
            // Jika ada jeda bersih sebelum darah (atau dari lahir ke KD1)
            if (p.start > curTime) {
                segments.push({ type: 'BERSIH', start: curTime, end: p.start, durasi: p.start - curTime, label: (i===0 ? 'Lahir s.d KD1' : `Bersih ${i}`) });
            }
            // Segmen Darah
            segments.push({ type: 'DARAH', start: p.start, end: p.end, durasi: p.end - p.start, label: `KD ${i+1}` });
            curTime = p.end;
        }

        // MENGHITUNG LOGIKA (Algoritma Fiqih Nifas)
        const HARI = 24 * 60 * 60 * 1000;
        const JAM = 60 * 60 * 1000;
        const MAX_NIFAS_MS = 60 * HARI;
        const BATAS_NIFAS_DATE = new Date(waktuLahir.getTime() + MAX_NIFAS_MS);

        let hasilSahbi = [];
        let hasilLaqti = [];

        // Tingkat 2: Cek Jarak ke KD 1
        let isPertamaNifas = false;
        let isKD1Haid = false;
        if (segments[0].type === 'BERSIH' && segments[0].durasi >= (15 * HARI)) {
            // Jarak ke KD pertama >= 15 hari -> Masuk Haid
            isKD1Haid = true;
        }

        // Loop Segmen untuk menentukan Hukum
        let totalDarahNifas = 0;
        let nifasEnded = false;

        segments.forEach(seg => {
            let hukumSahbi = '';
            let hukumLaqti = '';

            if (isKD1Haid) {
                // Semua masuk mesin haid
                if (seg.type === 'DARAH') {
                    if (seg.durasi < HARI) { hukumSahbi = hukumLaqti = 'Darah Fasad'; }
                    else if (seg.durasi <= 15*HARI) { hukumSahbi = hukumLaqti = 'Haid Normal'; }
                    else { hukumSahbi = hukumLaqti = 'Mustahadhah fil Haid'; }
                } else {
                    hukumSahbi = hukumLaqti = 'Suci';
                }
            } else {
                // Dalam masa Nifas (60 hari dari melahirkan)
                if (seg.end <= BATAS_NIFAS_DATE) {
                    if (seg.type === 'DARAH') {
                        hukumSahbi = hukumLaqti = 'Nifas';
                    } else if (seg.type === 'BERSIH') {
                        if (seg.start === waktuLahir) {
                            hukumSahbi = hukumLaqti = 'Masa Kosong (Suci)';
                        } else {
                            if (seg.durasi < 15*HARI) {
                                hukumSahbi = 'Nifas (Khilaf)';
                                hukumLaqti = 'Suci (Khilaf)';
                            } else {
                                hukumSahbi = hukumLaqti = 'Suci (Nifas Putus)';
                                nifasEnded = true;
                                isKD1Haid = true; // Sisa segmen jadi Haid
                            }
                        }
                    }
                } else {
                    // Melewati 60 hari
                    if (seg.start < BATAS_NIFAS_DATE && seg.end > BATAS_NIFAS_DATE) {
                        // Darah menyambung lewati batas 60 hari
                        hukumSahbi = `Mustahadhah fin Nifas. Nifas dikembalikan ke Adat (${adatNifasHari} Hari). Sisanya Suci/Haid sesuai Adat.`;
                        hukumLaqti = hukumSahbi;
                    } else {
                        // Darah baru setelah 60 hari
                        if (seg.type === 'DARAH') {
                            if (seg.durasi < HARI) { hukumSahbi = hukumLaqti = 'Darah Fasad (Haid < 24j)'; }
                            else if (seg.durasi <= 15*HARI) { hukumSahbi = hukumLaqti = 'Haid Baru'; }
                            else { hukumSahbi = hukumLaqti = 'Mustahadhah fil Haid'; }
                        } else {
                            hukumSahbi = hukumLaqti = 'Suci';
                        }
                    }
                }
            }

            hasilSahbi.push({label: seg.label, type: seg.type, durasi: seg.durasi, hukum: hukumSahbi});
            hasilLaqti.push({label: seg.label, type: seg.type, durasi: seg.durasi, hukum: hukumLaqti});
        });

        // Tampilkan Hasil
        let htmlOutput = `
            <p style="font-size:11px; color:#555; margin-bottom:15px; line-height:1.5;">
                Berikut adalah hasil analisis hukum nifas berdasarkan kaidah Madzhab Syafi'i. Untuk kasus darah yang terputus-putus (Taqathu'), terdapat perbedaan pendapat ulama (Qaul Sahbi dan Qaul Laqti).
            </p>
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:11px; border: 1px solid #eaeaea;">
                    <thead>
                        <tr style="background:#fff0f5; color:#d3557d; font-weight:bold;">
                            <th style="padding:10px; border:1px solid #eaeaea;">Segmen Waktu</th>
                            <th style="padding:10px; border:1px solid #eaeaea;">Durasi</th>
                            <th style="padding:10px; border:1px solid #eaeaea;">Hukum (Qaul Sahbi)</th>
                            <th style="padding:10px; border:1px solid #eaeaea;">Hukum (Qaul Laqti)</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        for(let i=0; i<hasilSahbi.length; i++) {
            let hS = hasilSahbi[i];
            let hL = hasilLaqti[i];
            let typeColor = hS.type === 'DARAH' ? '#ffebee' : '#fcfcfc';
            let textColor = hS.type === 'DARAH' ? '#c62828' : '#333';
            let icon = hS.type === 'DARAH' ? '<i class="fas fa-tint"></i>' : '<i class="far fa-circle"></i>';

            let diffText = '';
            if (hS.hukum !== hL.hukum) {
                // Highlight difference
                diffText = 'background:#fff8e1;';
            }

            htmlOutput += `
                <tr style="background:${typeColor}; color:${textColor}; text-align:center;">
                    <td style="padding:10px; border:1px solid #eaeaea; font-weight:bold;">${icon} ${hS.label}</td>
                    <td style="padding:10px; border:1px solid #eaeaea;">${formatDurasi(hS.durasi)}</td>
                    <td style="padding:10px; border:1px solid #eaeaea; ${diffText}"><strong>${hS.hukum}</strong></td>
                    <td style="padding:10px; border:1px solid #eaeaea; ${diffText}"><strong>${hL.hukum}</strong></td>
                </tr>
            `;
        }

        htmlOutput += `</tbody></table></div>`;

        successBox.innerHTML = htmlOutput;
        resultCard.style.display = 'block';
        successBox.style.display = 'block';
        resultCard.scrollIntoView({behavior: 'smooth'});

    });

})();
