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
            <li class="active"><a href=<?= url('myapps/published') ?>>Published</a></li>
            <li><a href=<?= url('myapps/statistics') ?>>Statistics</a></li>
            <li><a href=<?= url('myapps/inappropirate') ?>>Inappropirate Apps</a></li>
            <li><a href=<?= url('myapps/publish') ?>>Publish</a></li>
        </ul>
        <hr>
    <?php endif; ?>
    <?php if (isset($apps)): ?>
        <div class="panel panel-default unround app-feed-panel">
            <div class="panel-body">
            <?php foreach ($apps as $key => $value): ?>
                <div class="app-card">
                    <a href=<?= url('myapps/delete/' . $value->id); ?> data-toggle="tooltips" data-placement="left" title="Delete this application" class="app-card-del unround btn btn-xs btn-default glyphicon glyphicon-trash"></a>
                    <a href=<?=url('app/'.$value->id)?>>
                        <img src=<?= assets('storage/icons/' . $value->icon) ?> alt="..." class="img-thumbnail unround">
                    </a>
                    <p><a class="app-card-link" href=<?=url('app/'.$value->id)?>><?=$value->name ?></a></p>
                    <div>
                        <div>
                            <i class="glyphicon glyphicon-star"></i> <?= $value->rating ?>
                            <span class="pull-right"><?=str_replace('G_', '', $value->categoryName)?></span>
                        </div>
                        <hr class="custom-divider">
                        <a class="text-success" href=<?=url('app/'.$value->id)?>><small><?=$value->price == 0 ? 'Free App' : $value->price.' MMK'?></small></a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="com-md-6 col-md-offset-3">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            There is no application in your published list
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
