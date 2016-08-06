<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href=<?= assets('assets/images/favicon.ico') ?> type="image/x-icon">
        <link rel="stylesheet" href=<?= assets('assets/css/bootstrap.min.css') ?>>
        <link rel="stylesheet" href=<?= assets('assets/css/style.css') ?>>
        <title>
            <?=$title?>
            <?php if(isset($subtitle)): ?>
            <?=' | '. $subtitle;?>
            <?php endif; ?>
        </title>
    </head>
    <body>
