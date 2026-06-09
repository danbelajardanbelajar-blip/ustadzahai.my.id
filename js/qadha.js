document.addEventListener('DOMContentLoaded', () => {

    // Year selection logic
    const yearCards = document.querySelectorAll('.q-year-card');
    const selectedYearBox = document.getElementById('q-selected-year-box');
    const selectedTitle = document.getElementById('q-selected-title');
    const selectedDesc = document.getElementById('q-selected-desc');

    yearCards.forEach(card => {
        card.addEventListener('click', () => {
            // Remove active from all
            yearCards.forEach(c => c.classList.remove('active'));
            // Add active to clicked
            card.classList.add('active');

            // Show and populate the selected box
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

    // Toggle dropdown
    selectTrigger.addEventListener('click', (e) => {
        e.stopPropagation();
        selectOptions.classList.toggle('open');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', () => {
        selectOptions.classList.remove('open');
    });

    // Handle option selection
    const options = document.querySelectorAll('.q-option');
    options.forEach(option => {
        option.addEventListener('click', () => {
            // Copy HTML from option (icon + text) to trigger, minus the specific active background classes if needed
            selectText.innerHTML = option.innerHTML;
            
            // Adjust styling if 'haid' was picked (which has white text on pink bg in the menu)
            if(option.getAttribute('data-value') === 'haid') {
                selectText.style.color = '#333'; // ensure text is visible on the light trigger bg
            } else {
                selectText.style.color = '#333';
            }
        });
    });

    // Reset Logic
    const btnMulaiUlang = document.getElementById('q-btn-mulai-ulang');
    const btnResetSemua = document.getElementById('q-btn-reset-semua');

    function resetForm() {
        if(confirm('Apakah Anda yakin ingin mereset data qadha?')) {
            // Deselect years
            yearCards.forEach(c => c.classList.remove('active'));
            selectedYearBox.style.display = 'none';

            // Reset dropdown
            selectText.innerText = 'Pilih alasan...';
        }
    }

    btnMulaiUlang.addEventListener('click', resetForm);
    btnResetSemua.addEventListener('click', resetForm);

});
