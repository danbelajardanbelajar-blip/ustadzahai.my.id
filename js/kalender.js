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
        list.innerHTML += `
            <div class="k-item">
                <div class="k-item-info">
                    <div class="k-item-time">${note.time}</div>
                    <div class="k-item-title">${note.title}</div>
                </div>
                <button class="k-btn-delete" onclick="deleteNote('${type}', ${index})"><i class="far fa-trash-alt"></i></button>
            </div>
        `;
    });
}

function addNote(type) {
    const title = prompt(`Masukkan catatan untuk Qadha ${type}:`);
    if (title && title.trim() !== '') {
        const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
        const now = new Date();
        const timeStr = `${now.getDate()} ${monthNames[now.getMonth()].substring(0,3)} ${now.getFullYear()}, ${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
        
        notes.push({ title: title, time: timeStr });
        localStorage.setItem('notes_' + type, JSON.stringify(notes));
        renderNoteList(type, notes);
    }
}

function deleteNote(type, index) {
    if(confirm('Hapus catatan ini?')) {
        const notes = JSON.parse(localStorage.getItem('notes_' + type)) || [];
        notes.splice(index, 1);
        localStorage.setItem('notes_' + type, JSON.stringify(notes));
        renderNoteList(type, notes);
    }
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

document.addEventListener('DOMContentLoaded', initCalendar);
