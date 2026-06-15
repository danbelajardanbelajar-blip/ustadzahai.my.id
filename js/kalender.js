var currentDate = new Date();
var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
var hijriMonths = ["Muharram", "Safar", "Rabi'ul Awal", "Rabi'ul Akhir", "Jumadil Awal", "Jumadil Akhir", "Rajab", "Sya'ban", "Ramadhan", "Syawal", "Dzulqa'dah", "Dzulhijjah"];

function getHijriParts(date) {
    try {
        const formatter = new Intl.DateTimeFormat('en-US-u-ca-islamic', {day: 'numeric', month: 'numeric', year: 'numeric'});
        const str = formatter.format(date);
        const matches = str.match(/(\d+)[^\d]+(\d+)[^\d]+(\d+)/);
        if (matches) {
            return { month: parseInt(matches[1], 10), day: parseInt(matches[2], 10), year: parseInt(matches[3], 10) };
        }
    } catch(e) {}
    return { day: 1, month: 1, year: 1447 };
}

function updateTodayLabel() {
    const today = new Date();
    const day = today.getDate();
    const month = today.getMonth();
    
    const hParts = getHijriParts(today);
    const hijriString = `${hParts.day} ${hijriMonths[hParts.month - 1]}`;
    
    const todayLabel = document.getElementById('today-label');
    if (todayLabel) {
        todayLabel.innerHTML = `${day} ${monthNames[month]}<br>${hijriString}`;
    }
}

function initCalendar() {
    updateTodayLabel();
    renderRingkasan();
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
    
    // Convert to Hijri roughly for the label
    const hParts = getHijriParts(currentDate);
    const hijriString = `${hijriMonths[hParts.month - 1]} ${hParts.year} H`;
    
    document.getElementById('month-label').innerHTML = `<strong>${monthNames[month]} ${year}</strong><br>${hijriString}`;
    document.getElementById('year-note-title').innerText = `Catatan Tahun ${year} M / ${hParts.year} H`;
    
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
    
    // Get dynamic intervals
    const intervals = getFiqhIntervals();

    // Fill current month
    for (let i = 1; i <= daysInMonth; i++) {
        let classes = [];
        let hasRed = false;

        let dStart = new Date(year, month, i, 0, 0, 0).getTime();
        let dEnd = new Date(year, month, i, 23, 59, 59).getTime();

        intervals.forEach(inv => {
            let iStart = inv.start.getTime();
            let iEnd = inv.end.getTime();

            // Overlap check
            if (iStart < dEnd && iEnd > dStart) {
                if (inv.type === 'haid') {
                    classes.push('k-bg-haid');
                    hasRed = true;
                } else if (inv.type === 'nifas') {
                    classes.push('k-bg-nifas');
                    hasRed = true;
                } else if (inv.type === 'suci') {
                    let suciDayStart = new Date(inv.originalSuciStart.getFullYear(), inv.originalSuciStart.getMonth(), inv.originalSuciStart.getDate(), 0, 0, 0).getTime();
                    if (dStart >= suciDayStart) {
                        classes.push('k-bg-suci');
                        if (dStart === suciDayStart) {
                            // On the exact day of suci, remove any red backgrounds
                            classes = classes.filter(c => c !== 'k-bg-haid' && c !== 'k-bg-nifas');
                            hasRed = false;
                        }
                    }
                }
            }
            
            if (inv.type === 'melahirkan_mark') {
                let sDay = new Date(inv.start.getFullYear(), inv.start.getMonth(), inv.start.getDate(), 0, 0, 0).getTime();
                if (dStart === sDay) classes.push('k-mark-melahirkan-start');
                
                let eDay = new Date(inv.end.getFullYear(), inv.end.getMonth(), inv.end.getDate(), 0, 0, 0).getTime();
                if (dStart === eDay) classes.push('k-mark-melahirkan-end');
            }
        });

        if (hasRed) {
            classes = classes.filter(c => c !== 'k-bg-suci');
        }
        
        const tObj = new Date();
        if (year === tObj.getFullYear() && month === tObj.getMonth() && i === tObj.getDate()) {
            classes.push('k-today');
        }
        
        let hasDotStart = false;
        let hasDotEnd = false;
        
        // 1. Explicit fiqh event exists on this day
        fiqhEvents.forEach(e => {
            if (e.datetime >= dStart && e.datetime <= dEnd) {
                hasDotStart = true;
            }
        });
        
        // 2. End of a colored interval falls on this day
        intervals.forEach(inv => {
            if (['haid', 'nifas', 'suci'].includes(inv.type)) {
                let adjustedEnd = inv.end.getTime() - 1;
                if (adjustedEnd >= dStart && adjustedEnd <= dEnd) {
                    hasDotEnd = true;
                }
            }
        });
        
        if (hasDotStart) {
            classes.push('k-has-dot-start');
        }
        if (hasDotEnd) {
            classes.push('k-has-dot-end');
        }
        
        // Remove duplicates
        classes = [...new Set(classes)];
        let classString = classes.join(' ');

        let hijriD = getApproxHijriDay(new Date(year, month, i));
        grid.innerHTML += `<div class="k-day-cell ${classString}" onclick="openEventModal(${year}, ${month}, ${i})"><span class="k-hijri-date">${hijriD}</span>${i}</div>`;
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
    showCustomConfirm('Hapus catatan ini?', function() {
        const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
        notes.splice(index, 1);
        localStorage.setItem('notes_' + type, JSON.stringify(notes));
        renderNoteList(type, notes);
    });
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

var sholatData = null;

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

// Fiqh State Management
var fiqhEvents = JSON.parse(localStorage.getItem('fiqh_events')) || [];

function saveFiqhEvent(dateStr, type, hour, minute) {
    const idx = fiqhEvents.findIndex(e => e.date === dateStr);
    const newEvent = { date: dateStr, type: type, hour: hour, minute: minute, datetime: new Date(`${dateStr}T${hour}:${minute}:00`).getTime() };
    
    if (idx !== -1) {
        fiqhEvents[idx] = newEvent;
    } else {
        fiqhEvents.push(newEvent);
    }
    
    fiqhEvents.sort((a, b) => a.datetime - b.datetime);
    localStorage.setItem('fiqh_events', JSON.stringify(fiqhEvents));
}

function deleteFiqhEvent(dateStr) {
    fiqhEvents = fiqhEvents.filter(e => e.date !== dateStr);
    localStorage.setItem('fiqh_events', JSON.stringify(fiqhEvents));
}

function getEventForDate(dateStr) {
    return fiqhEvents.find(e => e.date === dateStr);
}

function getFiqhIntervals() {
    let intervals = [];
    let melahirkanLimit = null;
    
    for (let i = 0; i < fiqhEvents.length; i++) {
        let e = fiqhEvents[i];
        let eDate = new Date(e.datetime);
        
        if (e.type === 'melahirkan_belum_kd' || e.type === 'melahirkan_kd_nifas') {
            melahirkanLimit = new Date(eDate.getTime() + 60 * 24 * 60 * 60 * 1000);
            intervals.push({ type: 'melahirkan_mark', start: eDate, end: melahirkanLimit });
        }
        
        if (e.type === 'melahirkan_kd_nifas' || e.type === 'kd_nifas' || e.type === 'kd_haid') {
            let isNifas = (e.type === 'melahirkan_kd_nifas' || e.type === 'kd_nifas');
            let typeColor = isNifas ? 'nifas' : 'haid';
            
            let maxEnd;
            if (isNifas) {
                if (melahirkanLimit && melahirkanLimit > eDate) {
                    maxEnd = melahirkanLimit;
                } else {
                    maxEnd = new Date(eDate.getTime() + 60 * 24 * 60 * 60 * 1000);
                }
            } else {
                maxEnd = new Date(eDate.getTime() + 15 * 24 * 60 * 60 * 1000);
            }
            
            let actualEnd = maxEnd;
            for (let j = i + 1; j < fiqhEvents.length; j++) {
                if (fiqhEvents[j].type === 'suci') {
                    let suciDate = new Date(fiqhEvents[j].datetime);
                    if (suciDate < maxEnd) {
                        actualEnd = suciDate;
                    }
                    break;
                }
            }
            
            intervals.push({ type: typeColor, start: eDate, end: actualEnd });
        }
        
        if (e.type === 'suci') {
            let maxEnd = new Date(eDate.getTime() + 15 * 24 * 60 * 60 * 1000);
            
            let actualEnd = maxEnd;
            for (let j = i + 1; j < fiqhEvents.length; j++) {
                if (['melahirkan_kd_nifas', 'kd_nifas', 'kd_haid'].includes(fiqhEvents[j].type)) {
                    let nextDate = new Date(fiqhEvents[j].datetime);
                    if (nextDate < maxEnd) {
                        actualEnd = nextDate;
                    }
                    break;
                }
            }
            intervals.push({ type: 'suci', start: eDate, end: actualEnd, originalSuciStart: eDate });
        }
    }
    return intervals;
}

// Event Modal Logic
window.selectedEventDateStr = null;

window.openEventModal = function(year, month, day) {
    window.selectedEventDateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
    
    // Set title
    const formattedDate = `${day} ${monthNames[month]} ${year}`;
    document.getElementById('event-modal-date-title').innerText = formattedDate;
    
    // Load existing if any
    const existing = getEventForDate(window.selectedEventDateStr);
    const btnDel = document.getElementById('btn-delete-event');
    if (existing) {
        document.querySelector(`input[name="event_type"][value="${existing.type}"]`).checked = true;
        document.getElementById('event-hour').value = existing.hour;
        document.getElementById('event-minute').value = existing.minute;
        if(btnDel) btnDel.style.display = 'block';
    } else {
        document.querySelector(`input[name="event_type"][value="kd_nifas"]`).checked = true;
        document.getElementById('event-hour').value = "12";
        document.getElementById('event-minute').value = "00";
        if(btnDel) btnDel.style.display = 'none';
    }
    
    // Show modal
    document.getElementById('event-modal-overlay').style.display = 'flex';
    if(window.checkSuciWarning) window.checkSuciWarning();
}

window.checkSuciWarning = function() {
    const warningEl = document.getElementById('suci-warning');
    if (!warningEl) return;
    
    const eventTypeEl = document.querySelector('input[name="event_type"]:checked');
    if (!eventTypeEl || eventTypeEl.value !== 'suci') {
        warningEl.style.display = 'none';
        return;
    }
    
    const hour = document.getElementById('event-hour').value;
    const minute = document.getElementById('event-minute').value;
    const currentDateTime = new Date(`${window.selectedEventDateStr}T${hour}:${minute}:00`).getTime();
    
    let lastEventBefore = null;
    let maxTimeBefore = -1;
    
    for (let i = 0; i < fiqhEvents.length; i++) {
        let e = fiqhEvents[i];
        let eTime = new Date(`${e.date}T${e.hour}:${e.minute}:00`).getTime();
        // Exclude the event currently being edited if it's on the same date
        if (e.date !== window.selectedEventDateStr) {
            if (eTime <= currentDateTime && eTime > maxTimeBefore) {
                maxTimeBefore = eTime;
                lastEventBefore = e;
            }
        }
    }
    
    if (!lastEventBefore || lastEventBefore.type === 'suci' || lastEventBefore.type === 'melahirkan_belum_kd') {
        warningEl.style.display = 'flex';
    } else {
        warningEl.style.display = 'none';
    }
}

window.closeEventModal = function() {
    document.getElementById('event-modal-overlay').style.display = 'none';
}

window.deleteEventModal = function() {
    showCustomConfirm("Hapus catatan Fiqh di hari ini?", function() {
        deleteFiqhEvent(window.selectedEventDateStr);
        closeEventModal();
        renderCalendar();
        renderRingkasan();
    });
}

window.saveEventModal = function() {
    const eventTypeEl = document.querySelector('input[name="event_type"]:checked');
    if (!eventTypeEl) {
        alert("Silakan pilih jenis event terlebih dahulu.");
        return;
    }
    const eventType = eventTypeEl.value;
    const hour = document.getElementById('event-hour').value;
    const minute = document.getElementById('event-minute').value;
    
    saveFiqhEvent(window.selectedEventDateStr, eventType, hour, minute);
    closeEventModal();
    renderCalendar();
    renderRingkasan();
}

window.toggleRingkasan = function() {
    const body = document.getElementById('ringkasan-body');
    const chevron = document.getElementById('ringkasan-chevron');
    if (body.style.display === 'none') {
        body.style.display = 'block';
        chevron.className = 'fas fa-chevron-up';
    } else {
        body.style.display = 'none';
        chevron.className = 'fas fa-chevron-down';
    }
}

function formatRingkasanDate(dateObj) {
    let day = String(dateObj.getDate()).padStart(2, '0');
    let mth = monthNames[dateObj.getMonth()].substring(0,3);
    let yr = dateObj.getFullYear();
    let hr = String(dateObj.getHours()).padStart(2, '0');
    let mn = String(dateObj.getMinutes()).padStart(2, '0');
    return `${day} ${mth} ${yr}, ${hr}:${mn}`;
}

window.renderRingkasan = function() {
    const cardEl = document.getElementById('ringkasan-card');
    const statusEl = document.getElementById('status-bar');
    if (!cardEl || !statusEl) return;
    
    if (fiqhEvents.length === 0) {
        cardEl.style.display = 'none';
        statusEl.style.display = 'none';
        return;
    }
    
    cardEl.style.display = 'block';
    statusEl.style.display = 'flex';
    
    let episodes = [];
    let kdCount = 0;
    let bCount = 0;
    
    for (let i = 0; i < fiqhEvents.length; i++) {
        let e = fiqhEvents[i];
        let nextE = fiqhEvents[i+1] || null;
        
        let isKD = (e.type === 'kd_haid' || e.type === 'kd_nifas' || e.type === 'melahirkan_kd_nifas');
        let isBersih = (e.type === 'suci');
        
        let ep = {
            type: e.type,
            isKD: isKD,
            isBersih: isBersih,
            start: new Date(e.datetime),
            end: nextE ? new Date(nextE.datetime) : null
        };
        
        if (isKD) {
            kdCount++;
            let eventName = e.type === 'kd_haid' ? 'Keluar Darah Haid' : (e.type === 'kd_nifas' ? 'Keluar Darah Nifas' : 'Melahirkan + KD');
            ep.title = `KD ${kdCount} (${eventName})`;
        } else if (isBersih) {
            bCount++;
            ep.title = `B ${bCount} (Bersih)`;
        } else {
            ep.title = `Melahirkan (Belum KD)`;
        }
        
        if (ep.end) {
            let diffMs = ep.end - ep.start;
            let diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
            let diffHours = Math.floor((diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let durStr = [];
            if (diffDays > 0) durStr.push(`${diffDays} hari`);
            if (diffHours > 0) durStr.push(`${diffHours} jam`);
            if (durStr.length === 0) durStr.push(`0 jam`);
            ep.durationStr = durStr.join(' ');
        } else {
            ep.durationStr = 'berlangsung';
        }
        
        episodes.push(ep);
    }
    
    // Build HTML
    let html = '';
    episodes.forEach(ep => {
        let startStr = formatRingkasanDate(ep.start);
        let endStr = ep.end ? `&rarr; ${formatRingkasanDate(ep.end)}` : '';
        
        let blockClass = ep.isKD ? 'k-ringkasan-block-red' : (ep.isBersih ? 'k-ringkasan-block-green' : 'k-ringkasan-block-gray');
        let dotColor = ep.isKD ? '#d32f2f' : (ep.isBersih ? '#388e3c' : '#9932cc');
        let durClass = ep.isKD ? 'k-rb-duration-red' : (ep.isBersih ? 'k-rb-duration-green' : '');
        
        let durationText = ep.durationStr;
        if (!ep.end && ep.isBersih) {
            // "berlangsung" is italicized or just text, let's keep it styled
            durationText = `<i>${ep.durationStr}</i>`;
        }
        
        html += `
        <div class="k-ringkasan-block ${blockClass}">
            <div class="k-rb-header">
                <div class="k-rb-title"><span style="color:${dotColor}">●</span> ${ep.title}</div>
                <div class="k-rb-duration ${durClass}">${durationText}</div>
            </div>
            <div class="k-rb-dates">
                <div>${startStr}</div>
                ${endStr ? `<div>${endStr}</div>` : ''}
            </div>
        </div>
        `;
    });
    
    document.getElementById('ringkasan-list').innerHTML = html;
    document.getElementById('ringkasan-count-label').innerText = `(${episodes.length} episode)`;
    document.getElementById('total-kd-count').innerText = `${kdCount}x episode`;
    document.getElementById('total-b-count').innerText = `${bCount}x episode`;
    
    // Update Status Bar
    let lastEp = episodes[episodes.length - 1];
    let statusText = lastEp.isKD ? (lastEp.type === 'kd_haid' ? 'Haid' : 'Nifas') : (lastEp.isBersih ? 'Suci' : 'Melahirkan');
    document.getElementById('status-text').innerText = statusText;
    document.getElementById('status-date').innerText = `Mulai ${formatRingkasanDate(lastEp.start)}`;
    
    let dot = document.getElementById('status-dot');
    if (lastEp.isKD) {
        dot.className = 'k-dot k-haid';
        if (lastEp.type === 'kd_nifas' || lastEp.type === 'melahirkan_kd_nifas') {
            dot.className = 'k-dot k-nifas';
        }
    } else if (lastEp.isBersih) {
        dot.className = 'k-dot k-suci';
    } else {
        dot.className = 'k-dot k-melahirkan-outline';
    }
}

window.copyRingkasan = function() {
    if (fiqhEvents.length === 0) return;
    
    let episodes = [];
    let kdCount = 0;
    let bCount = 0;
    
    for (let i = 0; i < fiqhEvents.length; i++) {
        let e = fiqhEvents[i];
        let nextE = fiqhEvents[i+1] || null;
        let isKD = (e.type === 'kd_haid' || e.type === 'kd_nifas' || e.type === 'melahirkan_kd_nifas');
        let isBersih = (e.type === 'suci');
        
        let ep = {
            type: e.type, isKD: isKD, isBersih: isBersih,
            start: new Date(e.datetime),
            end: nextE ? new Date(nextE.datetime) : null
        };
        
        if (isKD) {
            kdCount++;
            let evName = e.type === 'kd_haid' ? 'Keluar Darah Haid' : 'Keluar Darah Nifas';
            ep.title = `KD ${kdCount} (${evName})`;
        } else if (isBersih) {
            bCount++;
            ep.title = `B ${bCount} (Bersih)`;
        } else {
            ep.title = `Melahirkan`;
        }
        
        if (ep.end) {
            let diffMs = ep.end - ep.start;
            let diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
            let diffHours = Math.floor((diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let durStr = [];
            if (diffDays > 0) durStr.push(`${diffDays} hari`);
            if (diffHours > 0) durStr.push(`${diffHours} jam`);
            if (durStr.length === 0) durStr.push(`0 jam`);
            ep.durationStr = durStr.join(' ');
        }
        
        episodes.push(ep);
    }
    
    // Exclude last Bersih if it's "berlangsung"
    let lastEp = episodes[episodes.length - 1];
    if (lastEp && lastEp.isBersih && !lastEp.end) {
        episodes.pop();
    }
    
    let textOut = '';
    episodes.forEach(ep => {
        let sStr = formatRingkasanDate(ep.start);
        let eStr = ep.end ? formatRingkasanDate(ep.end) : 'berlangsung';
        let dur = ep.durationStr || 'berlangsung';
        textOut += `${ep.title}\t\t${dur}\n${sStr}\n-> ${eStr}\n\n`;
    });
    
    textOut += `Total KD: ${kdCount}x episode\nTotal Bersih: ${bCount}x episode`;
    
    navigator.clipboard.writeText(textOut).then(() => {
        const btn = document.querySelector('.k-btn-salin-ringkasan');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
        setTimeout(() => { btn.innerHTML = originalText; }, 2000);
    }).catch(err => {
        alert("Gagal menyalin: " + err);
    });
}

window.showCustomConfirm = function(message, onConfirm) {
    const overlay = document.createElement('div');
    overlay.className = 'k-modal-overlay';
    overlay.style.display = 'flex';
    overlay.style.zIndex = '9999';
    
    const modal = document.createElement('div');
    modal.className = 'k-modal';
    modal.style.textAlign = 'center';
    
    const icon = document.createElement('div');
    icon.innerHTML = '<i class="fas fa-exclamation-triangle" style="font-size: 40px; color: #ff9800; margin-bottom: 15px;"></i>';
    
    const title = document.createElement('h3');
    title.innerText = 'Konfirmasi';
    title.style.margin = '0 0 10px 0';
    title.style.color = '#333';
    title.style.fontSize = '18px';
    
    const text = document.createElement('p');
    text.innerText = message;
    text.style.color = '#555';
    text.style.fontSize = '14px';
    text.style.marginBottom = '25px';
    text.style.lineHeight = '1.5';
    
    const footer = document.createElement('div');
    footer.style.display = 'flex';
    footer.style.gap = '10px';
    footer.style.justifyContent = 'center';
    
    const btnCancel = document.createElement('button');
    btnCancel.className = 'k-btn-outline';
    btnCancel.innerText = 'Batal';
    btnCancel.style.flex = '1';
    btnCancel.onclick = function() {
        document.body.removeChild(overlay);
    };
    
    const btnOk = document.createElement('button');
    btnOk.className = 'k-btn-solid';
    btnOk.innerText = 'Ya';
    btnOk.style.flex = '1';
    btnOk.style.backgroundColor = '#d32f2f';
    btnOk.style.borderColor = '#d32f2f';
    btnOk.onclick = function() {
        document.body.removeChild(overlay);
        onConfirm();
    };
    
    footer.appendChild(btnCancel);
    footer.appendChild(btnOk);
    
    modal.appendChild(icon);
    modal.appendChild(title);
    modal.appendChild(text);
    modal.appendChild(footer);
    overlay.appendChild(modal);
    document.body.appendChild(overlay);
};

window.showCustomAlert = function(message, type = 'success', onOk = null) {
    const overlay = document.createElement('div');
    overlay.className = 'k-modal-overlay';
    overlay.style.display = 'flex';
    overlay.style.zIndex = '9999';
    
    const modal = document.createElement('div');
    modal.className = 'k-modal';
    modal.style.textAlign = 'center';
    
    const icon = document.createElement('div');
    if (type === 'success') {
        icon.innerHTML = '<i class="fas fa-check-circle" style="font-size: 40px; color: #2e8f52; margin-bottom: 15px;"></i>';
    } else {
        icon.innerHTML = '<i class="fas fa-info-circle" style="font-size: 40px; color: #2d6bcf; margin-bottom: 15px;"></i>';
    }
    
    const title = document.createElement('h3');
    title.innerText = type === 'success' ? 'Berhasil' : 'Informasi';
    title.style.margin = '0 0 10px 0';
    title.style.color = '#333';
    title.style.fontSize = '18px';
    
    const text = document.createElement('p');
    text.innerText = message;
    text.style.color = '#555';
    text.style.fontSize = '14px';
    text.style.marginBottom = '25px';
    text.style.lineHeight = '1.5';
    
    const footer = document.createElement('div');
    footer.style.display = 'flex';
    footer.style.justifyContent = 'center';
    
    const btnOk = document.createElement('button');
    btnOk.className = 'k-btn-solid';
    btnOk.innerText = 'OK';
    btnOk.style.flex = '1';
    btnOk.style.backgroundColor = type === 'success' ? '#2e8f52' : '#2d6bcf';
    btnOk.style.borderColor = type === 'success' ? '#2e8f52' : '#2d6bcf';
    btnOk.onclick = function() {
        document.body.removeChild(overlay);
        if (onOk) onOk();
    };
    
    footer.appendChild(btnOk);
    
    modal.appendChild(icon);
    modal.appendChild(title);
    modal.appendChild(text);
    modal.appendChild(footer);
    overlay.appendChild(modal);
    document.body.appendChild(overlay);
};

window.resetSemuaData = function() {
    showCustomConfirm('Apakah Anda yakin ingin menghapus semua data kalender dan catatan? Tindakan ini tidak dapat dibatalkan.', function() {
        localStorage.removeItem('fiqh_events');
        localStorage.removeItem('notes_sholat');
        localStorage.removeItem('notes_puasa');
        localStorage.removeItem('notes_mandi');
        localStorage.removeItem('year_note');
        
        fiqhEvents = [];
        
        renderCalendar();
        renderRingkasan();
        loadNotes();
        loadYearNote();
        
        showCustomAlert('Semua data berhasil direset.', 'success', function() {
            location.reload();
        });
    });
}

initCalendar();

