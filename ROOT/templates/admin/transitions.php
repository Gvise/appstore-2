<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

<div class="contents">
    <div class="container">
        <ul class="nav nav-tabs">
            <li><a href=<?= url('admin') ?>>Users</a></li>
            <li><a href=<?= url('admin/cateplat') ?>>Categories &amp; Platforms</a></li>
            <li class="active"><a href=<?= url('admin/transitions') ?>>Transitions</a></li>
            <li><a href=<?= url('admin/transitionreports') ?>>Transition Reports</a></li>
            <li><a href=<?= url('admin/inappropirate') ?>>Inappropirate Apps</a></li>
            <li><a href=<?= url('admin/notify') ?>>Notify</a></li>
        </ul>
        <br>
        <div class="unround alert alert-danger">
            <ul>
                <li>Error</li>
            </ul>
        </div>
        <div class="col-md-4">
            <table class="table table-hover table-condensed">
                <caption>Deposit Transitions <a class="unround pull-right btn btn-default btn-xs"><small>DELETE ALL</small></a></caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>AMOUNT</th>
                        <th>FROM</th>
                        <th>DATE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>10000</td>
                        <td>KBZ ATM 112239494949</td>
                        <td>11/11/1111</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-hover table-condensed">
                <caption>Withdraw Transitions <a class="unround pull-right btn btn-default btn-xs"><small>DELETE ALL</small></a></caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>AMOUNT</th>
                        <th>TO</th>
                        <th>DATE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>10000</td>
                        <td>KBZ ATM 112239494949</td>
                        <td>11/11/1111</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-hover table-condensed">
                <caption>Pending Transitons</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>AMOUNT</th>
                        <th>ADDRESS</th>
                        <th>DATE</th>
                        <th>TYPE</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>10000</td>
                        <td>KBZ ATM 112239494949</td>
                        <td>11/11/1111</td>
                        <td><strong>D</strong></td>
                        <td>
                            <a class="unround btn btn-success btn-xs glyphicon glyphicon-ok" data-toggle="tooltips" data-placement="right" title="Confirm this transition."></a>
                            <a class="unround btn btn-danger btn-xs glyphicon glyphicon-remove" data-toggle="tooltips" data-placement="right" title="Delete this transition."></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php render('master.foot') ?>
