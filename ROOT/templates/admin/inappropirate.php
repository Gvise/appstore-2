<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

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
            <div class="unround panel panel-default">
                <div class="panel-heading">
                    Filter
                </div>
                <div class="panel-body">
                    <form method="post" action=<?= url('admin/inappropirate/filter')?>>
                        <div class="form-group">
                            <label for="Platform">Platform</label>
                            <select class="unround form-control" name="platform">
                                <option value="0">None</option>
                                <option value="1">Android</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="unround form-control" name="category">
                                <option value="0">None</option>
                                <option value="1">Strategy</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-default pull-right">
                    </form>
                </div>
            </div>
            <div class="unround alert alert-danger">
                <ul>
                    <li>Error</li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
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
                    <tr>
                        <td>
                            <a href=<?= url('app/appid') ?> data-toggle="tooltips" data-placement="right" title="Review App">
                                Warlings
                            </a> <i class="glyphicon glyphicon-share-alt"></i>
                        </td>
                        <td>Android</td>
                        <td>Strategy Game</td>
                        <td><span class="badge">10</span></td>
                        <td>
                            <a class="unround btn btn-info btn-xs glyphicon glyphicon-info-sign" data-toggle="tooltips" data-placement="right" title="Warn to owner."></a>
                            <a class="unround btn btn-info btn-xs glyphicon glyphicon-remove" data-toggle="tooltips" data-placement="right" title="Delete reports."></a>
                            <a class="unround btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="tooltips" data-placement="right" title="Delete this application."></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php render('master.foot') ?>
