<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
        <ul class="nav nav-tabs">
            <li><a href=<?= url('admin') ?>>Users</a></li>
            <li><a href=<?= url('admin/cateplat') ?>>Categories &amp; Platforms</a></li>
            <li><a href=<?= url('admin/transitions') ?>>Transitions</a></li>
            <li><a href=<?= url('admin/transitionreports') ?>>Transition Reports</a></li>
            <li class="active"><a href=<?= url('admin/inappropirate') ?>>Inappropirate Apps</a></li>
            <li><a href=<?= url('admin/notify') ?>>Notify</a></li>
        </ul>
        <br>
        <div class="col-md-4">
        <?php if (($error = with('error')) != null): ?>
            <div class="unround alert alert-danger">
                <ul>
                <?php foreach ($error as $key => $value): ?>
                    <li><?= $value ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
            <div class="unround panel panel-default">
                <div class="panel-heading">
                    Filter
                </div>
                <div class="panel-body">
                    <form method="get" action=<?= url('admin/inappropirate')?>>
                        <div class="form-group">
                            <label for="Platform">Platform</label>
                            <select class="unround form-control" name="platform">
                                <option value="-1"> No Selection </option>
                            <?php foreach (session('platforms') as $key => $value): ?>
                                    <option value=<?= $value->id ?>> <?= $value->name ?> </option>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <?php $cats = array_merge($categoryGames, $categories); ?>
                            <label for="category">Category</label>
                            <select class="unround form-control" name="category">
                                <option value="-1"> No Selection </option>
                            <?php foreach ($cats as $key => $value) : ?>
                                <option value=<?= $value->id ?>> <?= str_replace('G_', 'Game: ', $value->name)?> </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-default pull-right">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
        <?php if (isset($apps)): ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>APP NAME</th>
                        <th>PLATFORM</th>
                        <th>CATEGORY</th>
                        <th>REPORT COUNT</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($apps as $key => $value): ?>
                    <tr>
                        <td>
                            <a href=<?= url('app/'.$value->id) ?> data-toggle="tooltips" data-placement="right" title="Review App">
                                <?= $value->name ?>
                            </a> <i class="glyphicon glyphicon-share-alt"></i>
                        </td>
                        <td><?= $value->platform ?></td>
                        <td><?= $value->category ?></td>
                        <td><span class="badge"><?= $value->reportCount ?></span></td>
                        <td>
                            <a href=<?= url('admin/warn/'. $value->userId . '/' . $value->id .  '/'  . $value->reportCount) ?> class="unround btn btn-warning btn-xs glyphicon glyphicon-info-sign" data-toggle="tooltips" data-placement="right" title="Warn to owner."></a>
                            <a href=<?= url('admin/inappropirate/delete/' . $value->id) ?> class="unround btn btn-info btn-xs glyphicon glyphicon-remove" data-toggle="tooltips" data-placement="right" title="Delete this report"></a>
                            <a href="" class="unround btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="tooltips" data-placement="right" title="Delete this application."></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>NO DATA</th>
                    </tr>
                </thead>
            </table>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php
require __ROOT__.'templates/master/foot.php';
?>
