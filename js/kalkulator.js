// Initialization logic
(function() {
    // Tab Switching Logic
    const tabs = document.querySelectorAll('.c-tab');
    const sections = document.querySelectorAll('.c-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active from all tabs and sections
            tabs.forEach(t => t.classList.remove('active'));
            sections.forEach(s => s.classList.remove('active'));

            // Add active to clicked tab
            tab.classList.add('active');

            // Show corresponding section
            const targetId = 'section-' + tab.getAttribute('data-tab');
            document.getElementById(targetId).classList.add('active');
        });
    });

    // Dynamic Birth Date Logic
    const tglLahirInput = document.querySelector('#section-mubtadaah .date-picker');
    const jamLahirInput = document.querySelector('#section-mubtadaah .time-picker');

    function updateMinHaid() {
        const payload = {
            tglLahir: tglLahirInput.value,
            jamLahir: jamLahirInput.value
        };

        if(!payload.tglLahir || !payload.jamLahir) return;

        fetch('index.php?url=kalkulator/hitungMinHaid', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('result-tgl-lahir').innerHTML = data.lahirMasehi + '<br><span class="c-text-pink">' + data.lahirHijriah + '</span>';
            document.getElementById('result-min-haid').innerHTML = data.minHaidMasehi + '<br><span class="c-text-pink">' + data.minHaidHijriah + '</span>';
        })
        .catch(err => console.error('Error fetching min haid:', err));
    }

    if (tglLahirInput) tglLahirInput.addEventListener('change', updateMinHaid);
    if (jamLahirInput) jamLahirInput.addEventListener('change', updateMinHaid);
    
    // Call once to initialize
    updateMinHaid();

    // Adat Preset Buttons Logic
    const adatBtns = document.querySelectorAll('.c-adat-btn');
    adatBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Find parent container and the parent card
            const container = btn.closest('.c-adat-options');
            const card = btn.closest('.c-card');
            
            // Remove active from all buttons in this container
            container.querySelectorAll('.c-adat-btn').forEach(b => b.classList.remove('active'));
            // Add active to clicked button
            btn.classList.add('active');

            // Update summary text
            const summaryDiv = card.querySelector('.adat-summary-text');
            if (summaryDiv) {
                const text = btn.querySelector('strong').innerText; // e.g., "6 / 24"
                const parts = text.split('/');
                if (parts.length === 2) {
                    const haid = parts[0].trim();
                    const suci = parts[1].trim();
                    summaryDiv.innerHTML = `Haid <strong style="color:#333">${haid} hari</strong> &middot; Suci <strong style="color:#333">${suci} hari</strong>`;
                }
            }
        });
    });

    // Dynamic 'Keluar Darah' Block Logic
    let darahCount = 1;
    const btnTambah = document.getElementById('btn-tambah-darah');
    const container = document.getElementById('darah-blocks-container');

    btnTambah.addEventListener('click', () => {
        darahCount++;
        const newBlock = document.createElement('div');
        newBlock.className = 'c-card c-card-pink c-darah-block c-mt-15';
        newBlock.innerHTML = `
            <div class="c-card-header c-text-dark c-space-between">
                <div style="display:flex; align-items:center; gap:8px;">
                    <div class="c-icon-circle-red"><i class="fas fa-history"></i></div>
                    <strong>Keluar Darah <span class="darah-index">${darahCount}</span></strong>
                </div>
                <button class="btn-delete-darah" style="background:none;border:none;color:#d3557d;cursor:pointer"><i class="fas fa-times"></i></button>
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
        `;
        container.appendChild(newBlock);

        // Add delete logic for the new block
        const deleteBtn = newBlock.querySelector('.btn-delete-darah');
        deleteBtn.addEventListener('click', () => {
            newBlock.remove();
            reindexDarahBlocks();
        });
    });

    function reindexDarahBlocks() {
        const blocks = container.querySelectorAll('.c-darah-block');
        darahCount = blocks.length;
        blocks.forEach((block, index) => {
            block.querySelector('.darah-index').innerText = index + 1;
        });
    }

    // Update Ringkasan Keluar Darah dynamically
    container.addEventListener('change', (e) => {
        if (e.target.classList.contains('date-picker') || e.target.classList.contains('time-picker')) {
            updateRingkasan();
        }
    });

    function updateRingkasan() {
        const content = document.getElementById('ringkasan-content');
        if (!content) return;

        const blocks = document.querySelectorAll('.c-darah-block');
        let html = '';
        let lastBersihDate = null;

        blocks.forEach((block, index) => {
            const datePickers = block.querySelectorAll('.date-picker');
            const timePickers = block.querySelectorAll('.time-picker');
            
            const tglKeluar = datePickers[0]?.value;
            const jamKeluar = timePickers[0]?.value;
            const tglBersih = datePickers[1]?.value;
            const jamBersih = timePickers[1]?.value;

            if (tglKeluar && jamKeluar) {
                const keluarDate = new Date(`${tglKeluar}T${jamKeluar}`);
                
                // Calculate Bersih if there's a previous block
                if (lastBersihDate) {
                    const diffMs = keluarDate - lastBersihDate;
                    if (diffMs > 0) {
                        const { days, hours } = msToDaysHours(diffMs);
                        html += `<div style="font-size:12px; margin-bottom:5px; color:#2ecc71;"><strong>B ${index}:</strong> ${days} hari ${hours} jam</div>`;
                    }
                }

                if (tglBersih && jamBersih) {
                    const bersihDate = new Date(`${tglBersih}T${jamBersih}`);
                    const diffMs = bersihDate - keluarDate;
                    if (diffMs > 0) {
                        const { days, hours } = msToDaysHours(diffMs);
                        html += `<div style="font-size:12px; margin-bottom:5px; color:#d3557d;"><strong>KD ${index+1}:</strong> ${days} hari ${hours} jam</div>`;
                    }
                    lastBersihDate = bersihDate;
                } else {
                    lastBersihDate = null;
                }
            }
        });

        if (html === '') {
            content.innerHTML = '<div class="c-text-center c-text-gray" style="font-size: 11px;">Belum ada data lengkap untuk dihitung.</div>';
        } else {
            content.innerHTML = html;
        }
    }

    function msToDaysHours(ms) {
        const totalHours = Math.floor(ms / (1000 * 60 * 60));
        const days = Math.floor(totalHours / 24);
        const hours = totalHours % 24;
        return { days, hours };
    }

    // Toggle logic for Ringkasan
    const btnToggle = document.getElementById('btn-toggle-ringkasan');
    const iconToggle = document.getElementById('icon-toggle-ringkasan');
    const ringkasanContent = document.getElementById('ringkasan-content');
    
    if (btnToggle) {
        btnToggle.addEventListener('click', () => {
            if (ringkasanContent.style.display === 'none') {
                ringkasanContent.style.display = 'block';
                iconToggle.style.transform = 'rotate(180deg)';
                updateRingkasan();
            } else {
                ringkasanContent.style.display = 'none';
                iconToggle.style.transform = 'rotate(0deg)';
            }
        });
    }

    // Paste Ringkasan Logic
    const btnPaste = document.getElementById('btn-paste-ringkasan');
    const pasteContainer = document.getElementById('paste-ringkasan-container');
    const closePaste = document.getElementById('close-paste-ringkasan');
    const btnProsesPaste = document.getElementById('btn-proses-paste');
    const textareaPaste = document.getElementById('paste-ringkasan-textarea');

    if (btnPaste && pasteContainer && closePaste) {
        btnPaste.addEventListener('click', () => {
            btnPaste.style.display = 'none';
            pasteContainer.style.display = 'block';
        });

        closePaste.addEventListener('click', () => {
            pasteContainer.style.display = 'none';
            btnPaste.style.display = 'block';
        });
        
        btnProsesPaste.addEventListener('click', () => {
            if (textareaPaste.value.trim() === '') {
                alert('Silakan paste data ringkasan terlebih dahulu.');
                return;
            }
            alert('Fitur sinkronisasi otomatis sedang dikembangkan. Silakan masukkan data Keluar Darah secara manual melalui tombol "Tambah Keluar Darah" di atas.');
            // TODO: Parse text area logic
            pasteContainer.style.display = 'none';
            btnPaste.style.display = 'block';
        });
    }

    // Reset Logic
    const btnReset = document.getElementById('btn-reset');
    btnReset.addEventListener('click', () => {
        if(confirm('Apakah Anda yakin ingin mereset semua data?')) {
            // Reset all inputs
            const inputs = document.querySelectorAll('.c-input');
            inputs.forEach(input => {
                // If it's a date input, set to empty or default. If time, set to 12:00 AM.
                if (input.placeholder === 'mm/dd/yyyy' || input.value.includes('/202')) {
                    input.value = '';
                } else if (input.value.includes('AM') || input.value.includes('PM')) {
                    input.value = '12:00 AM';
                } else if (!isNaN(input.value)) {
                    input.value = ''; // Clear number inputs
                }
            });

            // Remove all dynamically added Darah blocks except the first one
            const blocks = container.querySelectorAll('.c-darah-block');
            for (let i = 1; i < blocks.length; i++) {
                blocks[i].remove();
            }
            darahCount = 1;
            
            // Hide result
            document.getElementById('result-container').style.display = 'none';

            // Go back to first tab
            document.getElementById('tab-mubtadaah').click();
        }
    });

    // Analisa Logic
    const btnAnalisa = document.getElementById('btn-analisa');
    btnAnalisa.addEventListener('click', () => {
        // Collect data
        let kategori = 'mubtadaah';
        const activeTab = document.querySelector('.c-tab.active');
        if (activeTab) {
            kategori = activeTab.getAttribute('data-tab');
        }

        let adatHaid = 0;
        let adatSuci = 0;

        if (kategori === 'mutadah') {
            adatHaid = document.querySelector('#section-mutadah input[type="number"]').value || 0;
            adatSuci = document.querySelectorAll('#section-mutadah input[type="number"]')[1]?.value || 0;
        } else {
            // For mubtadaah or mutahayyiroh, get the active preset button
            const activeAdatBtn = document.querySelector(`#section-${kategori} .c-adat-btn.active`);
            if (activeAdatBtn) {
                const text = activeAdatBtn.querySelector('strong').innerText; // e.g., "6 / 24"
                const parts = text.split('/');
                if (parts.length === 2) {
                    adatHaid = parts[0].trim();
                    adatSuci = parts[1].trim();
                }
            }
        }

        const payload = {
            kategori: kategori,
            tglLahir: document.querySelector('#section-mubtadaah .date-picker').value,
            jamLahir: document.querySelector('#section-mubtadaah .time-picker').value,
            adatHaid: adatHaid,
            adatSuci: adatSuci,
            darah: []
        };

        let isValid = true;
        const blocks = document.querySelectorAll('.c-darah-block');
        blocks.forEach(block => {
            const datePickers = block.querySelectorAll('.date-picker');
            const timePickers = block.querySelectorAll('.time-picker');
            
            const tglKeluar = datePickers[0].value;
            const jamKeluar = timePickers[0].value;
            const tglBersih = datePickers[1].value;
            const jamBersih = timePickers[1].value;
            
            if (!tglKeluar || !jamKeluar || !tglBersih || !jamBersih) {
                isValid = false;
            } else {
                payload.darah.push({
                    tgl_keluar: tglKeluar,
                    jam_keluar: jamKeluar,
                    tgl_bersih: tglBersih,
                    jam_bersih: jamBersih
                });
            }
        });

        if (!isValid || payload.darah.length === 0) {
            alert('Mohon lengkapi semua data TANGGAL dan JAM pada blok Keluar Darah.');
            return;
        }

        // Send AJAX request
        fetch('index.php?url=kalkulator/analisa', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                renderVisualisasi(data);
            } else {
                alert('Terjadi kesalahan dalam analisa data.');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Gagal menghubungi server.');
        });
    });

    function renderVisualisasi(data) {
        const resultContainer = document.getElementById('result-container');
        const kesimpulanText = document.getElementById('kesimpulan-text');
        const visualBox = document.getElementById('visualisasi-blocks');
        const badgeKesimpulan = document.getElementById('badge-kesimpulan');
        
        resultContainer.style.display = 'block';
        
        // Determine Badge text
        let mainBadge = data.kesimpulan.split('(')[0].trim().toUpperCase();
        if (mainBadge.includes('FASAD') && mainBadge.includes('HAID')) {
            mainBadge = 'DARAH FASAD + HAID';
        } else if (mainBadge.includes('ISTIHADHAH')) {
            mainBadge = 'MUSTAHADOH FIL HAID'; // Use text from screenshot if it is Istihadhah
        } else if (mainBadge === 'HAID NORMAL') {
            mainBadge = 'HAID';
        }
        
        if (badgeKesimpulan) {
            badgeKesimpulan.innerText = mainBadge;
        }
        
        if (kesimpulanText) {
            kesimpulanText.innerHTML = `HUKUM: ${mainBadge}`;
        }

        visualBox.innerHTML = '';

        // If this is a special Fasad check (like screenshot 2), but backend only returns simple siklus,
        // we just render what we can. If the backend actually returns "Darah sebelum usia minimal" inside siklus, it will be mapped.
        // For standard data, we group by "Siklus" (every KD starts a new Siklus)
        
        let cycleHtml = '';
        let currentCycle = 0;
        let cycleContent = '';
        
        // Optional: specific check for "ANALISA DENGAN CEK USIA MINIMAL HAID" pattern
        // The backend doesn't output this yet, but if it did we'd catch it.
        // For now, we just map everything to Siklus blocks.
        
        data.siklus.forEach((item, index) => {
            if (item.type === 'KD') {
                if (currentCycle > 0) {
                    // Close previous cycle
                    cycleHtml += `<div style="border-left: 3px solid #8e44ad; padding-left: 15px; margin-bottom: 20px;">
                        <div style="font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #333;">Siklus ${currentCycle}:</div>
                        <div style="font-size: 13px; color: #555; line-height: 1.6;">
                            ${cycleContent}
                        </div>
                    </div>`;
                    cycleContent = '';
                }
                currentCycle++;
            } else if (currentCycle === 0) {
                // Failsafe if first item is not KD for some reason
                currentCycle = 1;
            }
            
            // Format dates
            const startDate = new Date(item.start.date);
            const endDate = new Date(item.end.date);
            
            const sdParts = startDate.toLocaleDateString('id-ID', {day:'numeric', month:'long', year:'numeric'});
            const stParts = startDate.toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit'}).replace(':', '.');
            const edParts = endDate.toLocaleDateString('id-ID', {day:'numeric', month:'long', year:'numeric'});
            const etParts = endDate.toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit'}).replace(':', '.');
            
            const startFmt = `${sdParts} jam ${stParts}`;
            const endFmt = `${edParts} jam ${etParts}`;
            
            let color = '#555';
            let label = item.status.toUpperCase();
            
            if (item.status.toLowerCase().includes('haid')) {
                color = '#d3557d';
            } else if (item.status.toLowerCase().includes('suci') || item.status.toLowerCase().includes('bersih')) {
                color = '#2ecc71';
            } else if (item.status.toLowerCase().includes('fasad') || item.status.toLowerCase().includes('istihadhah')) {
                color = '#8e44ad'; // purple for istihadoh
                if (item.status.toLowerCase().includes('fasad')) {
                    color = '#d3557d'; // red for fasad
                }
            }
            
            // If item has a custom label in status like "HAID (Adat 10 hari)", the backend should provide it. 
            // We just print whatever the status is.
            cycleContent += `<div style="margin-bottom: 5px;">&bull; <span style="color: ${color}; font-weight: bold;">${label}:</span> ${startFmt} s/d ${endFmt}</div>`;
        });
        
        // Add the last cycle
        if (currentCycle > 0) {
            cycleHtml += `<div style="border-left: 3px solid #8e44ad; padding-left: 15px; margin-bottom: 20px;">
                <div style="font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #333;">Siklus ${currentCycle}:</div>
                <div style="font-size: 13px; color: #555; line-height: 1.6;">
                    ${cycleContent}
                </div>
            </div>`;
        }
        
        // If data indicates a Fasad split
        if (data.is_fasad_split && data.fasad_data) {
            visualBox.innerHTML = `
                <div style="margin-bottom: 15px;">
                    <div style="font-weight: bold; text-transform: uppercase; margin-bottom: 10px; font-size: 14px; color: #333;">ANALISA DENGAN CEK USIA MINIMAL HAID</div>
                    <div style="font-size: 13px; color: #555; line-height: 1.6;">
                        <div style="margin-bottom: 5px;">&bull; Usia minimal haid: <strong>${data.fasad_data.min_haid_str}</strong></div>
                        <div style="margin-bottom: 5px;">&bull; Darah sebelum usia minimal (${data.fasad_data.fasad_hours} jam): <strong style="color:#d3557d;">DARAH FASAD</strong></div>
                        <div style="margin-bottom: 5px;">&bull; Darah setelah usia minimal (${data.fasad_data.haid_hours} jam): dianalisa sebagai siklus baru</div>
                    </div>
                </div>
                <hr style="border: none; border-top: 1px solid #fce4ec; margin: 15px 0;">
                <div style="margin-bottom: 15px;">
                    <div style="font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #333;">Analisa Darah Setelah Usia Minimal:</div>
                    <div style="font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #d3557d; text-transform: uppercase;">HUKUM: ${data.fasad_data.hukum_haid}</div>
                    <div style="font-size: 13px; color: #555;">${data.fasad_data.hukum_desc}</div>
                </div>
            `;
        } else if (data.kesimpulan.toLowerCase().includes('usia memungkinkan haid')) {
            visualBox.innerHTML = `
                <div style="margin-bottom: 15px;">
                    <div style="font-weight: bold; text-transform: uppercase; margin-bottom: 10px; font-size: 14px; color: #333;">ANALISA DENGAN CEK USIA MINIMAL HAID</div>
                    <div style="font-size: 13px; color: #555; line-height: 1.6;">
                        &bull; Hasil: <strong style="color:#d3557d;">${data.kesimpulan}</strong>
                    </div>
                </div>
                <hr style="border: none; border-top: 1px solid #fce4ec; margin: 15px 0;">
                <div style="font-weight: bold; margin-bottom: 10px; font-size: 14px; color: #333;">Rincian Darah:</div>
                ${cycleHtml}
            `;
        } else if (data.kesimpulan.toUpperCase() === 'HAID NORMAL') {
            const haidHours = data.siklus.reduce((sum, item) => item.type === 'KD' ? sum + item.hours : sum, 0);
            const haidDays = Math.round((haidHours / 24) * 10) / 10;
            visualBox.innerHTML = `
                <div style="font-size: 15px; color: #555;">Darah ${haidDays.toFixed(1)} hari (&le; 15 hari) = Haid.</div>
            `;
        } else {
            visualBox.innerHTML = cycleHtml;
        }
    }

})();
