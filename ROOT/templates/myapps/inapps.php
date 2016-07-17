<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

<div class="contents">
    <div class="container">
        <ul class="nav nav-pills">
            <li><a href=<?= url('myapps') ?>>Purchased</a></li>
            <li><a href=<?= url('myapps/published') ?>>Published</a></li>
            <li><a href=<?= url('myapps/statistics') ?>>Statistics</a></li>
            <li class="active"><a href=<?= url('myapps/inappropirate') ?>>Inappropirate Apps</a></li>
            <li><a href=<?= url('myapps/publish') ?>>Publish</a></li>
        </ul>
        <hr>
        <table class="table table-hover">
        <?php if (isset($apps)): ?>
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>APP NAME</th>
                    <th>PLATFORM</th>
                    <th>REPORT COUNT</th>
                </tr>
            </thead>
            <tbody>
            <?php for($i = 0; $i < count($apps); $i++): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><a href=<?= url('app/'.$apps[$i]['id']) ?> data-toggle="tooltips" data-placement="right" title="Review App"><?= $apps[$i]['name'] ?></a> <i class="glyphicon glyphicon-share-alt"></i></td>
                    <td><?= $apps[$i]['platform'] ?></td>
                    <td><?= $apps[$i]['reportcount'] ?></td>
                </tr>
            <?php endfor; ?>
            </tbody>
        <?php else: ?>
            <thead>
                <tr>
                    <th>
                        NO ROWS
                    </th>
                </tr>
            </thead>
        <?php endif; ?>
        </table>
    </div>
</div>

<?php render('master.foot') ?>
