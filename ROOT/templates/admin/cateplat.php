<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
        <ul class="nav nav-tabs">
            <li><a href=<?= url('admin') ?>>Users</a></li>
            <li class="active"><a href=<?= url('admin/cateplat') ?>>Categories &amp; Platforms</a></li>
            <li><a href=<?= url('admin/transitions') ?>>Transitions</a></li>
            <li><a href=<?= url('admin/transitionreports') ?>>Transition Reports</a></li>
            <li><a href=<?= url('admin/inappropirate') ?>>Inappropirate Apps</a></li>
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
                    Add Category
                </div>
                <div class="panel-body">
                    <form method="post" action=<?= url('admin/addcategory') ?>>
                        <div class="form-group">
                            <input type="text" name="categoryName" class="unround form-control" placeholder="Category Name"  value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="isGame"> This category is Game.
                            </label>
                        </div>
                        <input type="submit" class="pull-right unround btn btn-default">
                    </form>
                </div>
            </div>

            <div class="unround panel panel-default">
                <div class="panel-heading">
                    Add Platform
                </div>
                <div class="panel-body">
                    <form method="post" action=<?= url('admin/addplatform') ?>>
                        <div class="form-group">
                            <input type="text" name="platformName" class="unround form-control" placeholder="Platform Name"  value="">
                        </div>
                        <input type="submit" class="pull-right unround btn btn-default">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <?php if(isset($mainCategories)): ?>
            <table class="table table-hover table-condensed">
                <caption>Categories</caption>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>GAME ?</th>
                        <th>COUNT</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($mainCategories as $key => $value): ?>
                    <tr>
                        <td><?= str_replace('G_', '', $value->name) ?></td>
                        <td>
                            <?php if (strstr($value->name, 'G_')): ?>
                                <i class="glyphicon glyphicon-ok"></i>
                            <?php else: ?>
                                <i class="glyphicon glyphicon-remove"></i>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge"> <?= $value->count ?> </span></td>
                        <td>
                            <a class="unround btn btn-danger btn-xs glyphicon glyphicon-remove" data-toggle="tooltips" data-placement="right" title="Delete this category."  href=<?= url('admin/delcategory/' . $value->id) ?>></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table table-hover table-condensed">
                <caption>Categories</caption>
                <thead>
                    <tr>
                        <th>NO RECORDS</th>
                    </tr>
                </thead>
            </table>
        <?php endif ?>
        </div>
        <div class="col-md-4">
        <?php if(isset($mainPlatforms)): ?>
            <table class="table table-hover table-condensed">
                <caption>Platforms</caption>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>COUNT</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($mainPlatforms as $key => $value): ?>
                    <tr>
                        <td><?= $value->name ?></td>
                        <td><span class="badge"> <?= $value->count ?> </span></td>
                        <td>
                            <a class="unround btn btn-danger btn-xs glyphicon glyphicon-remove" data-toggle="tooltips" data-placement="right" title="Delete this category."  href=<?= url('admin/delplatform/' . $value->id) ?>></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table table-hover table-condensed">
                <caption>Platforms</caption>
                <thead>
                    <tr>
                        <th>NO RECORDS</th>
                    </tr>
                </thead>
            </table>
        <?php endif ?>
        </div>
    </div>
</div>

<?php
require __ROOT__.'templates/master/foot.php';
?>
