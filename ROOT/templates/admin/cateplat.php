<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

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
            <div class="unround alert alert-danger">
                <ul>
                    <li>Error</li>
                </ul>
            </div>

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
                    <tr>
                        <td>Strategy</td>
                        <td><i class="glyphicon glyphicon-ok"></i></td>
                        <td><span class="badge">10</span></td>
                        <td>
                            <a class="unround btn btn-danger btn-xs glyphicon glyphicon-remove" data-toggle="tooltips" data-placement="right" title="Delete this category."  href=<?= url('admin/category/delcategory/catid') ?>></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
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
                    <tr>
                        <td>Windows</td>
                        <td><span class="badge">10</span></td>
                        <td>
                            <a class="unround btn btn-danger btn-xs glyphicon glyphicon-remove" data-toggle="tooltips" data-placement="right" title="Delete this category."  href=<?= url('admin/category/delplatform/catid') ?>></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php render('master.foot') ?>
