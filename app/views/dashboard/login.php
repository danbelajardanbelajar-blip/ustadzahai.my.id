<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background: #fff0f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 320px; text-align: center; }
        h2 { color: #fb5c82; margin-top: 0; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ffd1df; border-radius: 8px; box-sizing: border-box; font-family: inherit; }
        button { background: linear-gradient(135deg, #ff7e9e, #fb5c82); color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; cursor: pointer; font-weight: bold; font-family: inherit; transition: 0.2s; }
        button:hover { opacity: 0.9; }
        .error { color: #e74c3c; font-size: 13px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Ustadzah AI Admin</h2>
        <?php if (!empty($data['error'])): ?>
            <div class="error"><?= $data['error'] ?></div>
        <?php endif; ?>
        <form action="index.php?url=dashboard/login" method="POST">
            <input type="password" name="password" placeholder="Masukkan Password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
