<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dashboard Admin - Ustadzah AI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Quicksand', sans-serif; 
            margin: 0; 
            min-height: 100vh;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            background: #fff;
            background-image: 
                radial-gradient(at 40% 20%, hsla(339,100%,85%,0.5) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(339,100%,80%,0.3) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(339,100%,88%,0.5) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(339,100%,82%,0.4) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(339,100%,85%,0.3) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(339,100%,75%,0.3) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(339,100%,85%,0.2) 0px, transparent 50%);
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            box-sizing: border-box;
            animation: floatUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes floatUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-box { 
            background: rgba(255, 255, 255, 0.75); 
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 40px 35px; 
            border-radius: 24px; 
            box-shadow: 0 10px 40px rgba(251, 92, 130, 0.12), inset 0 0 0 1px rgba(255, 255, 255, 0.5); 
            text-align: center;
        }

        .icon-circle {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #fb5c82, #ff7e9e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            margin: 0 auto 20px auto;
            box-shadow: 0 8px 16px rgba(251, 92, 130, 0.25);
        }

        h2 { 
            font-family: 'Outfit', sans-serif;
            color: #1f2937; 
            margin: 0 0 8px 0; 
            font-size: 26px;
            font-weight: 700;
        }

        p.subtitle {
            color: #6b7280;
            margin: 0 0 30px 0;
            font-size: 15px;
            font-weight: 500;
        }

        .input-group {
            position: relative;
            margin-bottom: 24px;
        }

        .input-group i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
            transition: 0.3s;
        }

        input { 
            width: 100%; 
            padding: 16px 16px 16px 48px; 
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid transparent;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border-radius: 14px; 
            box-sizing: border-box; 
            font-family: inherit; 
            font-size: 15px;
            font-weight: 600;
            color: #1f2937;
            transition: all 0.3s ease;
        }

        input::placeholder {
            color: #9ca3af;
            font-weight: 500;
        }

        input:focus {
            outline: none;
            border-color: #fb5c82;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(251, 92, 130, 0.1);
        }

        input:focus + i, input:not(:placeholder-shown) + i {
            color: #fb5c82;
        }

        /* Hack to reorder icon visually without breaking HTML flow for absolute positioning */
        input { z-index: 1; position: relative; background: transparent; }
        .input-bg { position: absolute; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.9); border-radius:14px; z-index:0; transition: 0.3s; border: 2px solid transparent;}
        input:focus ~ .input-bg { border-color: #fb5c82; background: #fff; box-shadow: 0 4px 12px rgba(251, 92, 130, 0.1);}

        button { 
            background: linear-gradient(135deg, #fb5c82, #f43f5e); 
            color: white; 
            border: none; 
            padding: 16px; 
            width: 100%; 
            border-radius: 14px; 
            cursor: pointer; 
            font-weight: 700; 
            font-family: 'Outfit', sans-serif; 
            font-size: 16px;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(251, 92, 130, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        button:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(251, 92, 130, 0.4);
        }

        button:active {
            transform: translateY(1px);
            box-shadow: 0 2px 8px rgba(251, 92, 130, 0.3);
        }

        .error { 
            background: #fee2e2;
            color: #dc2626; 
            font-size: 13px; 
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px; 
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .back-link:hover {
            color: #fb5c82;
        }

        /* Decorative circles behind the card */
        .decoration {
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            background: linear-gradient(135deg, #fb5c82, #ff7e9e);
            opacity: 0.15;
            filter: blur(20px);
        }
        .dec-1 { width: 150px; height: 150px; top: -40px; left: -40px; }
        .dec-2 { width: 200px; height: 200px; bottom: -60px; right: -60px; background: linear-gradient(135deg, #a78bfa, #c084fc); }

        /* Responsive */
        @media (max-width: 480px) {
            .login-box {
                padding: 35px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="decoration dec-1"></div>
            <div class="decoration dec-2"></div>

            <div class="icon-circle">
                <i class="fas fa-lock"></i>
            </div>
            
            <h2>Admin Dasbor</h2>
            <p class="subtitle">Kelola konten Ustadzah AI</p>

            <?php if (!empty($data['error'])): ?>
                <div class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $data['error'] ?>
                </div>
            <?php endif; ?>

            <form action="index.php?url=dashboard/login" method="POST">
                <div class="input-group">
                    <div class="input-bg"></div>
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                    <i class="fas fa-key"></i>
                </div>
                
                <button type="submit">
                    Masuk ke Dasbor <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
    <script src="js/spa.js"></script>
</body>
</html>
