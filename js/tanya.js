document.addEventListener('DOMContentLoaded', () => {

    const chatArea = document.getElementById('t-chat-area');
    const inputField = document.getElementById('t-input');
    const btnSend = document.getElementById('t-btn-send');
    const sugChips = document.querySelectorAll('.t-sug-chip');

    // KNOWLEDGE BASE (From BAB 1 and BAB 2)
    const knowledgeBase = [
        {
            keywords: ['pengertian haid', 'apa itu haid', 'definisi haid', 'dalil haid'],
            answer: `<b>Haid</b> adalah darah watak yang keluar dari farji wanita yang berasal dari rahim yang paling dalam, dengan proses yang sehat, tanpa ada sebab dan pada waktu-waktu tertentu.<br><br>Dalilnya antara lain firman Allah dalam QS. Al-Baqarah: 222 dan hadits Nabi kepada Fathimah binti Abi Hubaisy: <i>"Maka jika datang haid, tinggalkanlah shalat..."</i>`
        },
        {
            keywords: ['syarat haid', 'syarat darah haid'],
            answer: `<b>Syarat-syarat darah dihukumi Haid:</b><br>1. Keluarnya di masa memungkinkan haid (usia 9 tahun qomariyah taqribiyah).<br>2. Waktu keluar darah mencapai minimal sehari semalam (24 jam), baik terus-menerus maupun terputus-putus dalam rentang 15 hari.<br>3. Waktu keluar darah tidak melebihi 15 hari 15 malam.`
        },
        {
            keywords: ['warna darah', 'darah kuning', 'darah keruh', 'flek', 'warna haid'],
            answer: `<b>Warna darah haid ada 5</b> (dari terkuat ke terlemah): Hitam, Merah, Coklat, Kuning, Keruh.<br><br>Menurut <i>Qaul Ashoh</i>, darah kuning dan keruh hukumnya adalah haid, meskipun tidak didahului darah kuat. Namun bila keluarnya melebihi 15 hari, maka haidnya hanya darah kuatnya saja.`
        },
        {
            keywords: ['nifas', 'pengertian nifas', 'batas nifas'],
            answer: `<b>Nifas</b> adalah darah yang keluar setelah kosongnya rahim dari hamil. Umumnya masa nifas adalah 40 hari. Paling sedikitnya nifas adalah sesaat, dan batas paling lama nifas adalah 60 hari.`
        },
        {
            keywords: ['istihadoh', 'istihadah', 'istihadhah', 'darah penyakit', 'fasad'],
            answer: `<b>Istihadoh</b> adalah darah yang keluar dari farji wanita yang berasal dari bagian rahim paling bawah di selain hari-hari haid dan hari-hari nifas. Disebut juga darah fasad.<br><br>Bila darah tidak memenuhi syarat haid atau melebihi batas maksimal (15 hari), maka itu adalah istihadoh.`
        },
        {
            keywords: ['keputihan', 'rutubatul farji', 'cairan bening', 'cairan putih'],
            answer: `<b>Rutubatul Farji (Keputihan putih/bening)</b> hukumnya dirinci:<br>1. Jika keluar dari farji luar (tampak saat jongkok): <b>Suci & tidak membatalkan wudhu.</b><br>2. Jika keluar dari farji dalam (tidak tampak saat jongkok):<br>- Terjangkau dzakar saat jima: <b>Suci, TAPI membatalkan wudhu.</b><br>- Tidak terjangkau dzakar: <b>Najis & membatalkan wudhu.</b><br>Bila ragu, dikembalikan ke hukum asal yakni <b>suci & tidak batal wudhu</b>.`
        },
        {
            keywords: ['waktu suci', 'batas suci', 'awal suci', 'menghitung suci', 'minimal suci'],
            answer: `<b>Masa Suci:</b> Minimal masa suci adalah 15 hari 15 malam. Rata-rata 23/24 hari, dan tidak ada batas maksimalnya.<br><br><b>Awal waktu suci</b> dihitung sejak melihat kapas bersih saat dicek ke dalam farji, bukan keesokan harinya. Awal waktu suci = Akhir waktu haid.`
        },
        {
            keywords: ['menghitung darah', 'keluar darah', 'terputus-putus', 'waktu haid', 'batas haid'],
            answer: `<b>Cara menghitung waktu keluar darah:</b> Dihitung dari saat pertama kali melihat darah hingga melihat bersih (dicek dengan kapas).<br><br>Jika darah keluar terputus-putus, durasi saat keluar darah diakumulasikan. Jika totalnya mencapai 24 jam dalam rentang 15 hari, maka semuanya (darah & jeda bersih) dihukumi haid.`
        },
        {
            keywords: ['qodho', 'qadha sholat', 'tindakan keluar darah', 'wajib sholat', 'telat sholat'],
            answer: `<b>Kewajiban Qadha Sholat:</b> Jika masuk waktu sholat namun belum sholat, lalu keburu keluar haid (dengan jarak waktu yang cukup untuk sholat yang paling ringan), maka <b>wajib mengqadha sholat tersebut</b> setelah suci nanti.`
        }
    ];

    function appendMessage(text, isUser = false) {
        const msgRow = document.createElement('div');
        msgRow.className = isUser ? 't-msg-row t-msg-row-user' : 't-msg-row';
        
        if (isUser) {
            msgRow.innerHTML = `
                <div class="t-msg t-msg-user">
                    <div class="t-bubble t-bubble-user">${text}</div>
                </div>
            `;
        } else {
            msgRow.innerHTML = `
                <div class="t-avatar"><i class="fas fa-book-reader"></i></div>
                <div class="t-msg t-msg-ai">
                    <div class="t-bubble">${text}</div>
                </div>
            `;
        }
        
        chatArea.appendChild(msgRow);
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    function showTypingIndicator() {
        const msgRow = document.createElement('div');
        msgRow.className = 't-msg-row t-typing-indicator-wrapper';
        msgRow.id = 'typing-indicator';
        msgRow.innerHTML = `
            <div class="t-avatar"><i class="fas fa-book-reader"></i></div>
            <div class="t-msg t-msg-ai">
                <div class="t-bubble typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `;
        chatArea.appendChild(msgRow);
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    function removeTypingIndicator() {
        const ind = document.getElementById('typing-indicator');
        if (ind) ind.remove();
    }

    function processAIResponse(question) {
        let bestMatch = null;
        const qLower = question.toLowerCase();

        for (let item of knowledgeBase) {
            for (let kw of item.keywords) {
                if (qLower.includes(kw)) {
                    bestMatch = item.answer;
                    break;
                }
            }
            if (bestMatch) break;
        }

        if (!bestMatch) {
            bestMatch = "Maaf, Ustadzah AI tidak menemukan jawaban yang tepat dari materi fiqih yang tersedia. Coba tanyakan dengan kata kunci seperti: <b>syarat haid, keputihan, waktu suci, nifas, istihadoh, warna darah</b>.";
        }

        setTimeout(() => {
            removeTypingIndicator();
            appendMessage(bestMatch, false);
        }, 1000); // 1 sec simulated thinking time
    }

    function handleSend() {
        const val = inputField.value.trim();
        if (!val) return;

        appendMessage(val, true);
        inputField.value = '';
        
        showTypingIndicator();
        processAIResponse(val);
    }

    btnSend.addEventListener('click', handleSend);
    inputField.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSend();
    });

    sugChips.forEach(chip => {
        chip.addEventListener('click', () => {
            inputField.value = chip.innerText;
            handleSend();
        });
    });

    const btnReload = document.getElementById('btn-reload');
    if (btnReload) {
        btnReload.addEventListener('click', () => {
            // Remove all message rows
            const messageRows = chatArea.querySelectorAll('.t-msg-row');
            messageRows.forEach(row => row.remove());
            
            // Re-create initial messages
            const msg1 = document.createElement('div');
            msg1.className = 't-msg-row';
            msg1.innerHTML = `
                <div class="t-avatar"><i class="fas fa-book-reader"></i></div>
                <div class="t-msg t-msg-ai">
                    <div class="t-bubble">Assalamu'alaikum warahmatullah, perkenalkan saya Ustadzah AI 🌸</div>
                </div>
            `;
            
            const msg2 = document.createElement('div');
            msg2.className = 't-msg-row';
            msg2.innerHTML = `
                <div class="t-avatar"><i class="fas fa-book-reader"></i></div>
                <div class="t-msg t-msg-ai">
                    <div class="t-bubble">Silakan pilih topik yang ingin Anda pelajari:</div>
                </div>
            `;
            
            chatArea.appendChild(msg1);
            chatArea.appendChild(msg2);
            
            chatArea.scrollTop = 0;
        });
    }

});
