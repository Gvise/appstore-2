<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
    <?php if (session('user')->type > 1): ?>
        <ul class="nav nav-pills">
            <li><a href=<?= url('myapps') ?>>Purchased</a></li>
            <li><a href=<?= url('myapps/published') ?>>Published</a></li>
            <li><a href=<?= url('myapps/statistics') ?>>Statistics</a></li>
            <li class="active"><a href=<?= url('myapps/inappropirate') ?>>Inappropirate Apps</a></li>
            <li><a href=<?= url('myapps/publish') ?>>Publish</a></li>
        </ul>
        <hr>
    <?php endif; ?>
        <table class="table table-hover">
        <?php if (isset($apps)): ?>
            <thead>
                <tr>
                    <th>APP NAME</th>
                    <th>PLATFORM</th>
                    <th>REPORT COUNT</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($apps as $key => $value): ?>
                <tr>
                    <td><a href=<?= url('app/'.$value->id) ?> data-toggle="tooltips" data-placement="right" title="Review App"><?= $value->appName ?></a> <i class="glyphicon glyphicon-share-alt"></i></td>
                    <td><?= $value->platformName ?></td>
                    <td><span class="badge"><?= $value->reportCount ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        <?php else: ?>
            <tbody>
                <tr>
                    <td>
                        You have no inappropirate application.
                    </td>
                </tr>
            </tbody>
        <?php endif; ?>
        </table>
    </div>
</div>
<?php
require __ROOT__.'templates/master/foot.php';
?>
