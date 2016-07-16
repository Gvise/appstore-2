<?php View::render('master.head', compact('title', 'subtitle')) ?>

<?php View::render('master.sidebar', compact('user','title', 'categories', 'categoryGames')) ?>
<?php View::render('master.navbar', compact('user', 'notifications', 'selectHome')) ?>

<div class="contents">
    <div class="container">
        <div class="panel panel-default unround app-feed-panel">
        <?php foreach ($apps as $key => $value): ?>
            <div class="app-feed-heading panel-heading">
                <a href="#" class="category-name"><?=$key?></a>
            <?php if ($value['appcount'] > 6): ?>
                <a class="pull-right btn btn-default btn-xs unround" style="margin-right:8px" href=<?=$value['url']?> >See More</a>
            <?php endif; ?>
            </div>
            <div class="panel-body">
            <?php foreach ($value['apps'] as $appkey => $appvalue): ?>
                <div class="app-card">
                    <a href=<?=$appvalue['url']?>>

                        <img src=<?= App::assets('assets/images/app-icons/' . $appvalue['icon']) ?> alt="..." class="img-thumbnail unround">
                    </a>
                    <p><a class="app-card-link" href=<?=$appvalue['url']?>><?=$appvalue['name'] ?></a></p>
                    <div>
                        <div>
                        <?php for ($i=0; $i < $appvalue['stars']; $i++): ?>
                            <i class="glyphicon glyphicon-star"></i>
                        <?php endfor; ?>
                        <?php for ($i=0; $i < 5-$appvalue['stars']; $i++): ?>
                            <i class="glyphicon glyphicon-star-empty"></i>
                        <?php endfor; ?>
                        </div>
                        <a class="text-success" href=<?=$appvalue['url']?>><small><?=$appvalue['price'] == 0 ? 'Free' : $appvalue['price'].' MMK'?></small></a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<?php View::render('master.foot') ?>
