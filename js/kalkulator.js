document.addEventListener('DOMContentLoaded', () => {
    
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
                        <input type="text" placeholder="mm/dd/yyyy" class="c-input">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="c-input-with-icon">
                        <input type="text" value="12:00 AM" class="c-input">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
            </div>

            <div class="c-input-group c-mt-10">
                <label class="c-label-small">TANGGAL & JAM BERSIH</label>
                <div class="c-input-row">
                    <div class="c-input-with-icon">
                        <input type="text" placeholder="mm/dd/yyyy" class="c-input">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="c-input-with-icon">
                        <input type="text" value="12:00 AM" class="c-input">
                        <i class="far fa-clock"></i>
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
            
            // Go back to first tab
            document.getElementById('tab-mubtadaah').click();
        }
    });

});
