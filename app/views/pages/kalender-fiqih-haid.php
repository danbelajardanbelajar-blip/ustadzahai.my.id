<div class="header">
    <div class="badge"><i class="fas fa-calendar-alt"></i> Kalender Fiqih Haid</div>
    <h1>Kalender Fiqih Haid</h1>
    <p>Pantau siklus haid dengan kalender interaktif.</p>
</div>

<div class="content">
    <div class="page-card">
        <h2>Pilih Bulan & Tahun</h2>
        <form style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px;">
            <input type="month" id="monthYear" style="padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
        </form>
        <div id="calendar" style="background: white; padding: 16px; border-radius: 12px; border: 1px solid #eee;">
            <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                <thead>
                    <tr style="background: #f0f0f0;">
                        <th style="padding: 8px; border: 1px solid #ddd;">Sn</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Sl</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Rb</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Km</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Jm</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Sb</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Mg</th>
                    </tr>
                </thead>
                <tbody id="calendarBody">
                </tbody>
            </table>
        </div>
        <div style="margin-top: 16px; font-size: 12px; color: #666;">
            <p><strong>Panduan:</strong></p>
            <ul style="margin-left: 20px;">
                <li>Catat hari pertama haid untuk tracking akurat</li>
                <li>Haid biasanya 1-10 hari, istirahat minimal 15 hari</li>
                <li>Perbarui kalender setiap bulan</li>
            </ul>
        </div>
    </div>

    <a href="index.php?page=home" class="list-card">
        <div class="list-icon" style="background: linear-gradient(135deg, #7c4dff, #536dfe);">
            <i class="fas fa-arrow-left"></i>
        </div>
        <div class="list-text">
            <h3>Kembali ke Home</h3>
            <p>Halaman utama Ustadzah AI</p>
        </div>
    </a>
</div>

<script>
const today = new Date();
document.getElementById('monthYear').valueAsDate = today;
renderCalendar(today);

document.getElementById('monthYear').addEventListener('change', (e) => {
    const date = new Date(e.target.value);
    renderCalendar(date);
});

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const tbody = document.getElementById('calendarBody');
    tbody.innerHTML = '';
    let dayCounter = 1;
    
    for (let i = 0; i < 6; i++) {
        const row = document.createElement('tr');
        for (let j = 0; j < 7; j++) {
            const cell = document.createElement('td');
            cell.style.cssText = 'padding: 8px; border: 1px solid #ddd; text-align: center; cursor: pointer; height: 40px;';
            if ((i === 0 && j < firstDay) || dayCounter > daysInMonth) {
                cell.textContent = '';
            } else {
                cell.textContent = dayCounter;
                const cellDate = new Date(year, month, dayCounter);
                if (cellDate.getTime() === today.setHours(0,0,0,0)) {
                    cell.style.background = '#ff6b9d';
                    cell.style.color = 'white';
                    cell.style.fontWeight = 'bold';
                }
                dayCounter++;
            }
            row.appendChild(cell);
        }
        tbody.appendChild(row);
    }
}
</script>
