let currentDate = new Date(2026, 5, 10); // Default to June 2026 as in image
const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
const hijriMonths = ["Muharram", "Safar", "Rabi'ul Awal", "Rabi'ul Akhir", "Jumadil Awal", "Jumadil Akhir", "Rajab", "Sya'ban", "Ramadhan", "Syawal", "Dzulqa'dah", "Dzulhijjah"];

function initCalendar() {
    renderCalendar();
    loadNotes();
    loadYearNote();
    
    document.getElementById('btn-prev').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });
    
    document.getElementById('btn-next').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });
    
    document.getElementById('btn-today').addEventListener('click', () => {
        currentDate = new Date();
        renderCalendar();
    });
    
    initSholatPanel();
}

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    // Convert to Hijri roughly for the label (using Intl API)
    const hijriFormatter = new Intl.DateTimeFormat('id-TN-u-ca-islamic', {month: 'long', year: 'numeric'});
    const hijriString = hijriFormatter.format(currentDate);
    
    document.getElementById('month-label').innerHTML = `<strong>${monthNames[month]} ${year}</strong><br>${hijriString}`;
    document.getElementById('year-note-title').innerText = `Catatan Tahun ${year} M / ${hijriString.split(' ')[1]} H`;
    
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    
    // Get last month's days
    const prevMonthDays = new Date(year, month, 0).getDate();
    
    const grid = document.getElementById('calendar-grid');
    grid.innerHTML = '';
    
    // Pad previous month (starting from Sunday = 0, but calendar shows Min=0)
    for (let i = 0; i < firstDay; i++) {
        let dayNum = prevMonthDays - firstDay + i + 1;
        grid.innerHTML += `<div class="k-day-cell k-empty-cell"><span class="k-hijri-date">${getApproxHijriDay(new Date(year, month-1, dayNum))}</span>${dayNum}</div>`;
    }
    
    // Fill current month
    for (let i = 1; i <= daysInMonth; i++) {
        let isNifas = (year === 2026 && month === 5 && i === 10) ? 'nifas' : ''; // Mock styling for 10 Juni as in image
        let hijriD = getApproxHijriDay(new Date(year, month, i));
        grid.innerHTML += `<div class="k-day-cell ${isNifas}"><span class="k-hijri-date">${hijriD}</span>${i}</div>`;
    }
    
    // Pad next month
    const totalCellsFilled = firstDay + daysInMonth;
    const paddingNext = (totalCellsFilled % 7 === 0) ? 0 : 7 - (totalCellsFilled % 7);
    for (let i = 1; i <= paddingNext; i++) {
        grid.innerHTML += `<div class="k-day-cell k-empty-cell"><span class="k-hijri-date">${getApproxHijriDay(new Date(year, month+1, i))}</span>${i}</div>`;
    }
}

// Simple approximation for UI purposes
function getApproxHijriDay(date) {
    const formatter = new Intl.DateTimeFormat('en-US-u-ca-islamic', {day: 'numeric'});
    return formatter.format(date);
}

// Notes Logic using LocalStorage
function loadNotes() {
    ['sholat', 'puasa', 'mandi'].forEach(type => {
        const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
        renderNoteList(type, notes);
    });
}

function renderNoteList(type, notes) {
    const list = document.getElementById(`list-${type}`);
    list.innerHTML = '';
    notes.forEach((note, index) => {
        let titleStyle = '';
        if (note.isDone) {
            titleStyle = 'text-decoration: line-through; color: #888;';
        }
        
        list.innerHTML += `
            <div class="k-item">
                <div class="k-item-info">
                    <div class="k-item-time">${note.time}</div>
                    <div class="k-item-title" style="${titleStyle}">${note.title}</div>
                </div>
                <div class="k-item-actions">
                    <button class="k-btn-read" onclick="markRead('${type}', ${index})">${note.isRead ? 'Sudah Dibaca' : 'Tandai Dibaca'}</button>
                    <button class="k-btn-done" onclick="markDone('${type}', ${index})">${note.isDone ? 'Batal Selesai' : 'Selesai'}</button>
                    <button class="k-btn-delete" onclick="deleteNote('${type}', ${index})"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>
        `;
    });
}

function showAddNoteForm(type, buttonElement) {
    // Hide the button
    buttonElement.style.display = 'none';
    
    let placeholderText = '';
    if (type === 'sholat') {
        placeholderText = 'Catatan Qadha Sholat...';
    } else if (type === 'puasa') {
        placeholderText = 'Catatan Qadha Puasa...';
    } else if (type === 'mandi') {
        placeholderText = 'Catatan Mandi Wajib...';
    }
    
    // Create form container
    const formHtml = `
        <div class="k-add-form" id="form-${type}">
            <textarea class="k-add-form-input" id="input-${type}" placeholder="${placeholderText}"></textarea>
            <div class="k-add-form-actions">
                <button class="k-add-btn-cancel" onclick="cancelAddNote('${type}')">Batal</button>
                <button class="k-add-btn-save" onclick="saveNewNote('${type}')">Simpan</button>
            </div>
        </div>
    `;
    
    // Insert form before the button
    buttonElement.insertAdjacentHTML('beforebegin', formHtml);
    document.getElementById(`input-${type}`).focus();
}

function cancelAddNote(type) {
    const form = document.getElementById(`form-${type}`);
    if (form) form.remove();
    // Show the Add button again
    const box = document.getElementById(`box-${type}`);
    const btn = box.querySelector('.k-btn-add');
    if (btn) btn.style.display = 'block';
}

function saveNewNote(type) {
    const input = document.getElementById(`input-${type}`);
    const title = input ? input.value : '';
    if (title && title.trim() !== '') {
        const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
        const now = new Date();
        const timeStr = `${now.getDate()} ${monthNames[now.getMonth()].substring(0,3)} ${now.getFullYear()}, ${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
        
        notes.push({ title: title, time: timeStr });
        localStorage.setItem('notes_' + type, JSON.stringify(notes));
        renderNoteList(type, notes);
    }
    cancelAddNote(type);
}

function deleteNote(type, index) {
    if(confirm('Hapus catatan ini?')) {
        const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
        notes.splice(index, 1);
        localStorage.setItem('notes_' + type, JSON.stringify(notes));
        renderNoteList(type, notes);
    }
}

function markRead(type, index) {
    const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
    notes[index].isRead = !notes[index].isRead;
    localStorage.setItem('notes_' + type, JSON.stringify(notes));
    renderNoteList(type, notes);
}

function markDone(type, index) {
    const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
    notes[index].isDone = !notes[index].isDone;
    localStorage.setItem('notes_' + type, JSON.stringify(notes));
    renderNoteList(type, notes);
}

function loadYearNote() {
    const note = localStorage.getItem('year_note');
    const placeholder = document.getElementById('year-note-placeholder');
    const textDiv = document.getElementById('year-note-text');
    
    if (note && note.trim() !== '') {
        placeholder.style.display = 'none';
        textDiv.style.display = 'block';
        textDiv.innerText = note;
    } else {
        placeholder.style.display = 'inline';
        textDiv.style.display = 'none';
    }
}

function editYearNote() {
    document.getElementById('year-note-area').style.display = 'none';
    const textarea = document.getElementById('year-note-textarea');
    const btn = document.getElementById('btn-save-year-note');
    
    textarea.style.display = 'block';
    btn.style.display = 'block';
    textarea.value = localStorage.getItem('year_note') || '';
    textarea.focus();
}

function saveYearNote() {
    const textarea = document.getElementById('year-note-textarea');
    localStorage.setItem('year_note', textarea.value);
    
    textarea.style.display = 'none';
    document.getElementById('btn-save-year-note').style.display = 'none';
    document.getElementById('year-note-area').style.display = 'block';
    
    loadYearNote();
}

// Add a default mock item if completely empty to match image
if(!localStorage.getItem('notes_sholat')) {
    localStorage.setItem('notes_sholat', JSON.stringify([{
        title: "Qodo sholat isya",
        time: "8 Jun 2026, 18:33"
    }]));
}

let sholatData = null;

function initSholatPanel() {
    const btnSholat = document.getElementById('btn-sholat');
    const panel = document.getElementById('sholat-panel');
    const btnClose = document.getElementById('btn-close-sholat');
    const btnRefresh = document.getElementById('btn-refresh-sholat');
    const btnChangeCity = document.getElementById('btn-change-city');

    btnSholat.addEventListener('click', () => {
        if (panel.style.display === 'none') {
            panel.style.display = 'block';
            btnSholat.classList.add('active');
            btnSholat.innerHTML = '<i class="far fa-clock"></i> Tutup Jadwal Sholat';
            
            if (!sholatData) {
                fetchLocationAndSholat();
            }
        } else {
            panel.style.display = 'none';
            btnSholat.classList.remove('active');
            btnSholat.innerHTML = '<i class="far fa-clock"></i> Jadwal Sholat';
        }
    });

    btnClose.addEventListener('click', () => {
        panel.style.display = 'none';
        btnSholat.classList.remove('active');
        btnSholat.innerHTML = '<i class="far fa-clock"></i> Jadwal Sholat';
    });

    btnRefresh.addEventListener('click', fetchLocationAndSholat);
    btnChangeCity.addEventListener('click', (e) => {
        e.preventDefault();
        const city = prompt("Masukkan nama kota:");
        if (city) {
            document.getElementById('sholat-city').innerText = city;
            fetchSholatByCity(city);
        }
    });
}

function fetchLocationAndSholat() {
    const cityEl = document.getElementById('sholat-city');
    cityEl.innerText = 'Meminta lokasi...';
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                fetchCityName(lat, lng);
                fetchSholatByCoords(lat, lng);
            },
            (error) => {
                const city = prompt("Gagal mendapatkan lokasi otomatis. Masukkan nama kota:");
                if (city) {
                    cityEl.innerText = city;
                    fetchSholatByCity(city);
                } else {
                    cityEl.innerText = 'Lokasi tidak diketahui';
                    document.getElementById('sholat-grid').innerHTML = '<div style="grid-column:1/span 2;text-align:center;padding:20px;font-size:12px;color:#888;">Izin lokasi ditolak atau gagal. Silakan ganti kota.</div>';
                }
            }
        );
    } else {
        const city = prompt("Geolocation tidak didukung browser ini. Masukkan nama kota:");
        if (city) {
            cityEl.innerText = city;
            fetchSholatByCity(city);
        }
    }
}

function fetchCityName(lat, lng) {
    fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lng}&localityLanguage=id`)
        .then(res => res.json())
        .then(data => {
            const city = data.city || data.locality || 'Lokasi Anda';
            document.getElementById('sholat-city').innerText = city;
        })
        .catch(() => {
            document.getElementById('sholat-city').innerText = 'Lokasi Anda';
        });
}

function fetchSholatByCoords(lat, lng) {
    const ts = Math.floor(Date.now() / 1000);
    fetch(`https://api.aladhan.com/v1/timings/${ts}?latitude=${lat}&longitude=${lng}&method=20`)
        .then(res => res.json())
        .then(data => renderSholat(data.data))
        .catch(err => {
            document.getElementById('sholat-grid').innerHTML = '<div style="grid-column:1/span 2;text-align:center;padding:20px;font-size:12px;color:#888;">Gagal memuat jadwal sholat.</div>';
        });
}

function fetchSholatByCity(city) {
    document.getElementById('sholat-grid').innerHTML = '<div style="grid-column:1/span 2;text-align:center;padding:20px;font-size:12px;color:#888;">Memuat data jadwal sholat...</div>';
    fetch(`https://api.aladhan.com/v1/timingsByCity?city=${city}&country=Indonesia&method=20`)
        .then(res => res.json())
        .then(data => renderSholat(data.data))
        .catch(err => {
            document.getElementById('sholat-grid').innerHTML = '<div style="grid-column:1/span 2;text-align:center;padding:20px;font-size:12px;color:#888;">Gagal memuat jadwal untuk kota tersebut.</div>';
        });
}

function renderSholat(data) {
    sholatData = data;
    const timings = data.timings;
    
    const formatter = new Intl.DateTimeFormat('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    document.getElementById('sholat-date').innerText = formatter.format(new Date());

    let dhuhaTime = timings.Dhuha;
    if (!dhuhaTime) {
        const [sh, sm] = timings.Sunrise.split(':').map(Number);
        let dMin = sm + 20;
        let dHr = sh + Math.floor(dMin / 60);
        dMin = dMin % 60;
        dhuhaTime = `${String(dHr).padStart(2, '0')}:${String(dMin).padStart(2, '0')}`;
    }

    const items = [
        { name: 'Imsak', time: timings.Imsak, icon: '🌙' },
        { name: 'Subuh', time: timings.Fajr, icon: '🌅' },
        { name: 'Terbit', time: timings.Sunrise, icon: '☀️' },
        { name: 'Dhuha', time: dhuhaTime, icon: '⛅' },
        { name: 'Dzuhur', time: timings.Dhuhr, icon: '🕛' },
        { name: 'Ashar', time: timings.Asr, icon: '🕓' },
        { name: 'Maghrib', time: timings.Maghrib, icon: '🌆' },
        { name: 'Isya', time: timings.Isha, icon: '🌃' },
    ];

    const now = new Date();
    const currentMins = now.getHours() * 60 + now.getMinutes();
    
    let lastPassedIndex = -1;
    for(let i=0; i<items.length; i++) {
        const [h, m] = items[i].time.split(':').map(Number);
        const mins = h * 60 + m;
        if(currentMins >= mins) {
            lastPassedIndex = i;
        }
    }
    
    let html = '';
    items.forEach((item, index) => {
        const isActive = (index === lastPassedIndex) ? 'active' : '';
        html += `
            <div class="k-sholat-item ${isActive}">
                <div class="k-sholat-item-name">${item.icon} ${item.name}</div>
                <div class="k-sholat-item-time">${item.time}</div>
            </div>
        `;
    });
    
    document.getElementById('sholat-grid').innerHTML = html;
}

document.addEventListener('DOMContentLoaded', initCalendar);
