<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustadzah AI - Panduan Fiqih Wanita</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #f8f9fa;
            --text-main: #333;
            --text-muted: #777;
            --card-bg: #ffffff;
            --warning-bg: #fff9e6;
            --warning-text: #b0703c;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
        }

        /* Mobile Container Container */
        .app-container {
            width: 100%;
            max-width: 480px;
            background-color: var(--bg-color);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow-x: hidden;
        }

        /* Header Section */
        .header {
            background: linear-gradient(135deg, #d85799, #a059b5);
            /* Fallback pattern simulation */
            background-image: radial-gradient(circle at top right, rgba(255,255,255,0.1) 0%, transparent 50%), linear-gradient(135deg, #d85799, #9c54b8);
            padding: 40px 20px 60px 20px;
            text-align: center;
            color: white;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 20px;
            backdrop-filter: blur(5px);
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .header p {
            font-size: 13px;
            opacity: 0.9;
            line-height: 1.4;
            max-width: 300px;
            margin: 0 auto;
        }

        /* Main Content */
        .content {
            padding: 0 20px;
            margin-top: -30px;
        }

        /* Grid Cards */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 25px;
        }

        .grid-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 15px 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-main);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 22px;
            margin-bottom: 12px;
            position: relative;
        }

        .icon-box .drop {
            position: absolute;
            bottom: -2px;
            right: -2px;
            color: #ff3b3b;
            font-size: 14px;
            background: white;
            border-radius: 50%;
            padding: 2px;
        }

        .grid-card span {
            font-size: 11px;
            font-weight: 600;
            line-height: 1.3;
        }

        /* Gradients for icons */
        .bg-pink { background: linear-gradient(135deg, #ff6b9d, #ff477e); }
        .bg-pink-purple { background: linear-gradient(135deg, #e85dcf, #c238b3); }
        .bg-purple { background: linear-gradient(135deg, #a76df0, #8a4af3); }
        .bg-orange { background: linear-gradient(135deg, #ffb347, #ff7b00); }
        .bg-teal { background: linear-gradient(135deg, #4bd1b6, #20b2aa); }
        .bg-blue { background: linear-gradient(135deg, #5ca0f2, #3b82f6); }

        /* List Items */
        .list-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding-bottom: 30px;
        }

        .list-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 16px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            text-decoration: none;
            color: inherit;
        }

        .list-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 18px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .list-text {
            flex-grow: 1;
        }

        .list-text h3 {
            font-size: 14px;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .list-text p {
            font-size: 12px;
            color: var(--text-muted);
        }

        .list-arrow {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Warning Box */
        .warning-box {
            background-color: var(--warning-bg);
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1px solid rgba(245, 203, 167, 0.5);
        }

        .warning-box i {
            color: var(--warning-text);
            font-size: 16px;
            margin-top: 2px;
        }

        .warning-box p {
            color: var(--warning-text);
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
        }

    </style>
</head>
<body>

<div class="app-container">
    <div class="header">
        <div class="badge">
            <i class="fas fa-sparkles" style="color: #ffd700;"></i> Panduan Fiqih Wanita Madzhab Syafi'i
        </div>
        <h1>Ustadzah AI</h1>
        <p>Kumpulan aplikasi fiqih haid, nifas, dan istihadhoh</p>
    </div>

    <div class="content">
        <div class="grid-container">
            <a href="#" class="grid-card">
                <div class="icon-box bg-pink">
                    <i class="far fa-calendar-alt"></i>
                    <i class="fas fa-tint drop"></i>
                </div>
                <span>Kalender<br>Fiqih Haid</span>
            </a>
            
            <a href="#" class="grid-card">
                <div class="icon-box bg-pink-purple">
                    <i class="fas fa-calculator"></i>
                    <i class="fas fa-tint drop"></i>
                </div>
                <span>Kalkulator<br>Fiqih Haid</span>
            </a>

            <a href="#" class="grid-card">
                <div class="icon-box bg-purple">
                    <i class="fas fa-calculator"></i>
                </div>
                <span>Kalkulator<br>Fiqih Nifas</span>
            </a>

            <a href="#" class="grid-card">
                <div class="icon-box bg-orange">
                    <i class="fas fa-utensils"></i> </div>
                <span>Kalkulator<br>Qodo Puasa &<br>Fidyah</span>
            </a>

            <a href="#" class="grid-card">
                <div class="icon-box bg-teal">
                    <i class="far fa-comment-dots"></i>
                </div>
                <span>Tanya<br>Ustadzah AI</span>
            </a>

            <a href="#" class="grid-card">
                <div class="icon-box bg-blue">
                    <i class="fas fa-book-open"></i>
                    <i class="fas fa-tint drop"></i>
                </div>
                <span>Maktabah<br>Haid, Nifas &<br>Istihadhoh</span>
            </a>
        </div>

        <div class="list-section">
            
            <a href="#" class="list-card">
                <div class="list-icon" style="background: linear-gradient(135deg, #7c4dff, #536dfe);">
                    <i class="fas fa-pen"></i>
                </div>
                <div class="list-text">
                    <h3>Alat Pembuat Tabel Haid</h3>
                    <p>Tabel haid, nifas, mutahayyiroh dan struktur</p>
                </div>
                <div class="list-arrow">
                    <i class="fas fa-chevron-up"></i>
                </div>
            </a>

            <div class="warning-box">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Ini hanya alat bantu menggambarkan kasus haid, nifas, dan istihadhoh. <strong>Tidak bisa untuk menganalisa hukum secara otomatis.</strong></p>
            </div>

            <a href="#" class="list-card">
                <div class="list-icon" style="background: linear-gradient(135deg, #8c52ff, #5e17eb);">
                    <i class="fas fa-table"></i>
                </div>
                <div class="list-text">
                    <h3>Tabel Haid</h3>
                    <p>Tabel haid dengan hukum</p>
                </div>
            </a>

            <a href="#" class="list-card">
                <div class="list-icon" style="background: linear-gradient(135deg, #009ffd, #2a2a72);">
                    <i class="fas fa-table"></i>
                </div>
                <div class="list-text">
                    <h3>Tabel Nifas</h3>
                    <p>Tabel nifas dengan hukum</p>
                </div>
            </a>

        </div>
    </div>
</div>

</body>
</html>