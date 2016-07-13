<?php View::render('master.head', ['title' => Config::get('title')]) ?>
<?php View::render('master.sidebar', ['title' => Config::get('title')]) ?>
<?php View::render('master.navbar', ['currentPage' => '', 'notifications' => []]) ?>

<?php View::render('master.foot') ?>
