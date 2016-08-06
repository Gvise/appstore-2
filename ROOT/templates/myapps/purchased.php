<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
    <?php if (session('user')->type > 1): ?>
        <ul class="nav nav-pills">
            <li class="active"><a href=<?= url('myapps') ?>>Purchased</a></li>
            <li><a href=<?= url('myapps/published') ?>>Published</a></li>
            <li><a href=<?= url('myapps/statistics') ?>>Statistics</a></li>
            <li><a href=<?= url('myapps/inappropirate') ?>>Inappropirate Apps</a></li>
            <li><a href=<?= url('myapps/publish') ?>>Publish</a></li>
        </ul>
        <hr>
    <?php endif; ?>
    <?php if (isset($apps)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>APP NAME</th>
                    <th>DEVELOPER</th>
                    <th>CATEGORY</th>
                    <th>PLATFORM</th>
                    <th>PRICE</th>
                    <th>DATE</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($apps as $key => $value): ?>
                <tr>
                    <td><a href=<?= url('app/'.$value->id) ?> data-toggle="tooltips" data-placement="right" title="View App"><?= $value->name ?></a> <i class="glyphicon glyphicon-share-alt"></i></td>
                    <td><?=$value->developerName?></td>
                    <td><?=str_replace('G_','Game: ',$value->categoryName)?></td>
                    <td><?=$value->platformName?></td>
                    <td><?=$value->price?></td>
                    <td> <?= (new DateTime($value->date))->format('M d, Y') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="col-md-6 col-md-offset-3">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            There is no application in your purchased list
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php
require __ROOT__.'templates/master/foot.php';
?>
