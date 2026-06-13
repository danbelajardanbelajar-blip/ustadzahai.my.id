<?php
if (strpos($viewPath, 'dashboard/') !== false) {
    require $viewPath;
    return;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Ustadzah AI' ?></title>
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?= filemtime('css/style.css') ?>">
    <?php if (isset($css)) foreach($css as $file): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($file) ?>?v=<?= filemtime($file) ?>">
    <?php endforeach; ?>
</head>
<body>
    <div class="app-container">
        <?php require $viewPath; ?>
    </div>
    
    <?php if (isset($js)) foreach($js as $file): ?>
    <script src="<?= htmlspecialchars($file) ?>?v=<?= filemtime($file) ?>"></script>
    <?php endforeach; ?>
    <script src="js/spa.js?v=<?= filemtime('js/spa.js') ?>"></script>
</body>
</html>
