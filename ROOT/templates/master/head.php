<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href=<?= App::assets('assets/css/bootstrap.min.css') ?>>
        <link rel="stylesheet" href=<?= App::assets('assets/css/non-responsive.css') ?>>
        <link rel="stylesheet" href=<?= App::assets('assets/css/style.css') ?>>
        <title>
            <?=$title?>
            <?php if(isset($subtitle)): ?>
            <?=' | '. $subtitle;?>
            <?php endif; ?>
        </title>
    </head>
    <body>
