<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
    <?php if (isset($apps)): ?>
        <div class="panel panel-default unround app-feed-panel">
            <div class="panel-body">
            <?php foreach ($apps as $key => $value): ?>
                <div class="app-card">
                    <a href=<?= url('wishlist/delete/' . $value->id); ?> data-toggle="tooltips" data-placement="left" title="Remove from wishlist" class="app-card-del unround btn btn-xs btn-default glyphicon glyphicon-remove"></a>
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
        <div class="col-md-6 col-md-offset-3">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            There is no application in your wishlist
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
