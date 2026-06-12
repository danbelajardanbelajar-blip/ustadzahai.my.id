document.addEventListener('DOMContentLoaded', () => {

    // Year selection logic
    const yearCards = document.querySelectorAll('.q-year-card');
    const selectedYearBox = document.getElementById('q-selected-year-box');
    const selectedTitle = document.getElementById('q-selected-title');
    const selectedDesc = document.getElementById('q-selected-desc');

    yearCards.forEach(card => {
        card.addEventListener('click', () => {
            yearCards.forEach(c => c.classList.remove('active'));
            card.classList.add('active');

            const yearH = card.getAttribute('data-year-h');
            const yearM = card.getAttribute('data-year-m');
            const startStr = card.getAttribute('data-start');

            selectedTitle.innerText = 'Ramadhan ' + yearH;
            selectedDesc.innerText = yearM + 'asehi • ' + startStr;
            
            selectedYearBox.style.display = 'flex';
        });
    });

    // Custom Dropdown Logic
    const selectTrigger = document.getElementById('q-select-trigger');
    const selectOptions = document.getElementById('q-select-options');
    const selectText = document.getElementById('q-select-text');
    const hiddenAlasan = document.getElementById('q-hidden-alasan');

    selectTrigger.addEventListener('click', (e) => {
        e.stopPropagation();
        selectOptions.classList.toggle('open');
    });

    document.addEventListener('click', () => {
        selectOptions.classList.remove('open');
    });

    const options = document.querySelectorAll('.q-option');
    options.forEach(option => {
        option.addEventListener('click', () => {
            selectText.innerHTML = option.innerHTML;
            hiddenAlasan.value = option.getAttribute('data-value');
            selectText.style.color = '#333';
        });
    });

    // Reset Logic
    const btnMulaiUlang = document.getElementById('q-btn-mulai-ulang');
    const btnResetSemua = document.getElementById('q-btn-reset-semua');

    function resetForm() {
        if(confirm('Apakah Anda yakin ingin mereset data qadha?')) {
            yearCards.forEach(c => c.classList.remove('active'));
            selectedYearBox.style.display = 'none';
            selectText.innerText = 'Pilih alasan...';
            hiddenAlasan.value = '';
            document.getElementById('q-input-hari').value = '';
            document.getElementById('q-result-card').style.display = 'none';
        }
    }

    btnMulaiUlang.addEventListener('click', resetForm);
    if(btnResetSemua) btnResetSemua.addEventListener('click', resetForm);

    // CALCULATION LOGIC
    const btnHitung = document.getElementById('btn-hitung-qadha');
    
    btnHitung.addEventListener('click', () => {
        const alasan = hiddenAlasan.value;
        const hariStr = document.getElementById('q-input-hari').value;
        
        if (!alasan) {
            alert('Silakan pilih alasan meninggalkan puasa terlebih dahulu.');
            return;
        }
        
        const hari = parseInt(hariStr);
        if (isNaN(hari) || hari <= 0) {
            alert('Masukkan jumlah hari meninggalkan puasa yang valid (misal: 1, 2, 7).');
            return;
        }

        let qadha = false;
        let fidyah = false;
        let kifarah = false;

        switch (alasan) {
            case 'anak_kecil':
            case 'gila_tidak_sengaja':
                qadha = false; fidyah = false; break;
            case 'gila_sengaja':
            case 'sakit_harapan':
            case 'musafir':
            case 'hamil_diri':
            case 'hamil_diri_bayi':
            case 'haid':
            case 'nifas':
                qadha = true; fidyah = false; break;
            case 'sakit_tanpa_harapan':
            case 'sangat_tua':
                qadha = false; fidyah = true; break;
            case 'hamil_bayi':
                qadha = true; fidyah = true; break;
            case 'jima':
                qadha = true; fidyah = false; kifarah = true; break;
        }

        // Render Results
        const resQadha = document.getElementById('res-qadha');
        const resFidyah = document.getElementById('res-fidyah');
        const resKifarah = document.getElementById('res-kifarah');
        
        if (qadha) {
            resQadha.innerHTML = `<span class="q-wajib"><i class="fas fa-check-circle"></i> Wajib (${hari} hari)</span>`;
        } else {
            resQadha.innerHTML = `<span class="q-tidak-wajib"><i class="fas fa-times-circle"></i> Tidak Wajib</span>`;
        }

        if (fidyah) {
            resFidyah.innerHTML = `<span class="q-wajib"><i class="fas fa-check-circle"></i> Wajib (${hari} hari)</span>`;
        } else {
            resFidyah.innerHTML = `<span class="q-tidak-wajib"><i class="fas fa-times-circle"></i> Tidak Wajib</span>`;
        }

        if (kifarah) {
            resKifarah.style.display = 'block';
        } else {
            resKifarah.style.display = 'none';
        }

        document.getElementById('q-result-card').style.display = 'block';
        
        // Scroll slightly down to show result clearly
        setTimeout(() => {
            document.getElementById('q-result-card').scrollIntoView({behavior: 'smooth', block: 'end'});
        }, 50);
    });

});
