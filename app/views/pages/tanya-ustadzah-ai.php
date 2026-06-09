<div class="header">
    <div class="badge"><i class="far fa-comment-dots"></i> Tanya Ustadzah AI</div>
    <h1>Tanya Jawab Fiqih</h1>
    <p>Dapatkan jawaban singkat tentang haid, nifas, dan istihadhoh.</p>
</div>

<div class="content">
    <div class="page-card">
        <h2>Pertanyaan Umum (FAQ)</h2>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <div style="background: white; padding: 12px; border-radius: 8px; border-left: 4px solid #4bd1b6; cursor: pointer;" onclick="toggleAnswer(this)">
                <h4 style="margin: 0 0 8px 0; color: #333; font-size: 13px;">Q: Berapa lama durasi haid yang normal?</h4>
                <p class="answer" style="margin: 0; font-size: 12px; color: #666; display: none;">
                    A: Menurut Madzhab Syafi'i, haid berlangsung antara 1-10 hari. Jika melebihi 10 hari disebut istihadhoh.
                </p>
            </div>
            
            <div style="background: white; padding: 12px; border-radius: 8px; border-left: 4px solid #4bd1b6; cursor: pointer;" onclick="toggleAnswer(this)">
                <h4 style="margin: 0 0 8px 0; color: #333; font-size: 13px;">Q: Berapa lama masa istirahat setelah haid?</h4>
                <p class="answer" style="margin: 0; font-size: 12px; color: #666; display: none;">
                    A: Masa istirahat (tuhr) minimal 15 hari. Setelah itu, jika ada pendarahan lagi, dianggap haid baru.
                </p>
            </div>
            
            <div style="background: white; padding: 12px; border-radius: 8px; border-left: 4px solid #4bd1b6; cursor: pointer;" onclick="toggleAnswer(this)">
                <h4 style="margin: 0 0 8px 0; color: #333; font-size: 13px;">Q: Bolehkah shalat dan puasa saat haid?</h4>
                <p class="answer" style="margin: 0; font-size: 12px; color: #666; display: none;">
                    A: Tidak. Wanita haid tidak shalat dan tidak puasa. Kewajiban shalat dan puasa gugur sementara sampai haid selesai.
                </p>
            </div>
            
            <div style="background: white; padding: 12px; border-radius: 8px; border-left: 4px solid #4bd1b6; cursor: pointer;" onclick="toggleAnswer(this)">
                <h4 style="margin: 0 0 8px 0; color: #333; font-size: 13px;">Q: Apa itu istihadhoh?</h4>
                <p class="answer" style="margin: 0; font-size: 12px; color: #666; display: none;">
                    A: Istihadhoh adalah pendarahan abnormal yang melebihi 15 hari. Penderita tetap shalat, puasa, dan wudhu disetiap shalat.
                </p>
            </div>
            
            <div style="background: white; padding: 12px; border-radius: 8px; border-left: 4px solid #4bd1b6; cursor: pointer;" onclick="toggleAnswer(this)">
                <h4 style="margin: 0 0 8px 0; color: #333; font-size: 13px;">Q: Berapa lama nifas setelah melahirkan?</h4>
                <p class="answer" style="margin: 0; font-size: 12px; color: #666; display: none;">
                    A: Nifas maksimal 40 hari menurut Madzhab Syafi'i. Jika pendarahan berhenti sebelum 40 hari, nifas dihitung dari hari berhentinya pendarahan.
                </p>
            </div>
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
function toggleAnswer(element) {
    const answer = element.querySelector('.answer');
    if (answer.style.display === 'none') {
        answer.style.display = 'block';
        element.style.background = '#f0fffe';
    } else {
        answer.style.display = 'none';
        element.style.background = 'white';
    }
}
</script>
