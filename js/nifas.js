document.addEventListener('DOMContentLoaded', () => {

    // Toggle logic for inputs
    const togglePertama = document.getElementById('toggle-pertama-nifas');
    const inputAdatNifas = document.getElementById('input-adat-nifas');

    togglePertama.addEventListener('change', (e) => {
        if(e.target.checked) {
            inputAdatNifas.value = 40;
            inputAdatNifas.disabled = true;
        } else {
            inputAdatNifas.value = '';
            inputAdatNifas.disabled = false;
        }
    });

    const toggleBelumHaid = document.getElementById('toggle-belum-haid');
    const inputAdatSuci = document.getElementById('input-adat-suci');
    const inputAdatHaid = document.getElementById('input-adat-haid');

    toggleBelumHaid.addEventListener('change', (e) => {
        if(e.target.checked) {
            inputAdatSuci.value = 29;
            inputAdatHaid.value = 1;
            inputAdatSuci.disabled = true;
            inputAdatHaid.disabled = true;
        } else {
            inputAdatSuci.value = '';
            inputAdatHaid.value = '';
            inputAdatSuci.disabled = false;
            inputAdatHaid.disabled = false;
        }
    });


    // Dynamic 'Periode Darah' Block Logic
    let periodeCount = 1;
    const btnTambah = document.getElementById('n-btn-add-periode');
    const container = document.getElementById('n-darah-container');

    btnTambah.addEventListener('click', () => {
        periodeCount++;
        const newBlock = document.createElement('div');
        newBlock.className = 'n-darah-block';
        newBlock.innerHTML = `
            <div class="n-darah-header">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-tint"></i> <strong>Keluar Darah ke-<span class="n-darah-index">${periodeCount}</span></strong>
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
        `;
        container.appendChild(newBlock);

        // Add delete logic
        const deleteBtn = newBlock.querySelector('.n-btn-delete');
        deleteBtn.addEventListener('click', () => {
            newBlock.remove();
            reindexDarahBlocks();
        });
    });

    function reindexDarahBlocks() {
        const blocks = container.querySelectorAll('.n-darah-block');
        periodeCount = blocks.length;
        blocks.forEach((block, index) => {
            block.querySelector('.n-darah-index').innerText = index + 1;
        });
    }

    // Reset Logic
    const btnReset = document.getElementById('n-btn-reset');
    btnReset.addEventListener('click', () => {
        if(confirm('Apakah Anda yakin ingin mereset formulir nifas?')) {
            // Reset toggles
            togglePertama.checked = false;
            togglePertama.dispatchEvent(new Event('change'));
            toggleBelumHaid.checked = false;
            toggleBelumHaid.dispatchEvent(new Event('change'));

            // Reset standard inputs
            const inputs = document.querySelectorAll('.n-input, .n-textarea');
            inputs.forEach(input => {
                if (input.type === 'time' && input.id !== 'input-adat-nifas') {
                    // if there's a default, maybe leave it, but let's just clear
                    input.value = '';
                } else if(input.type === 'date' || input.type === 'number' || input.type === 'textarea') {
                    input.value = '';
                }
            });
            // Restore default time for Melahirkan 12:00
            document.querySelector('.n-time-picker').value = '12:00';

            // Remove all dynamically added Darah blocks except the first one
            const blocks = container.querySelectorAll('.n-darah-block');
            for (let i = 1; i < blocks.length; i++) {
                blocks[i].remove();
            }
            periodeCount = 1;
        }
    });
});
