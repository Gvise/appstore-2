<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

<div class="contents">
    <div class="container">
        <ul class="nav nav-tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href=<?= url('admin') ?>>Users</a></li>
                <li><a href=<?= url('admin/transitions') ?>>Transitions</a></li>
                <li><a href=<?= url('admin/inappropirate') ?>>Inappropirate Apps</a></li>
                <li><a href=<?= url('admin/notify') ?>>Notify</a></li>
            </ul>
        </ul>
        <div class="col-md-12">
            <table class="table table-hover">
                <caption>Admins</caption>
            <?php if (isset($admins)): ?>
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NAME</th>
                        <th>E-MAIL</th>
                        <th>APP COUNT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($developers); $i++): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $admins[$i]['name'] ?></td>
                        <td><?= $admins[$i]['email'] ?></td>
                        <td><?= $admins[$i]['appcount'] ?></td>
                        <td>
                            <div class="btn-group">
                                <a href=<?= url('admin/notify/?id=') . $admins[$i]['id'] ?> class="unround btn btn-default btn-xs"><small><i class="glyphicon glyphicon-info-sign"></i> NOTIFY</small></a>
                                <a href=<?= url('users/delete/') . $admins[$i]['id'] ?> class="unround btn btn-default btn-xs"><small><i class="glyphicon glyphicon-trash"></i> REMOVE</small></a>
                            </div>
                        </td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            <?php else: ?>
                <thead>
                    <tr>
                        <th>
                            NO RECORDS
                        </th>
                    </tr>
                </thead>
            <?php endif; ?>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-hover">
                <caption>Users</caption>
            <?php if (isset($users)): ?>
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NAME</th>
                        <th>E-MAIL</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($users); $i++): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $users[$i]['name'] ?></td>
                        <td><?= $users[$i]['email'] ?></td>
                        <td>
                            <div class="btn-group">
                                <a href=<?= url('admin/notify/?id=') . $admins[$i]['id'] ?> class="unround btn btn-default btn-xs"><small><i class="glyphicon glyphicon-info-sign"></i> NOTIFY</small></a>
                                <a href=<?= url('users/delete/') . $admins[$i]['id'] ?> class="unround btn btn-default btn-xs"><small><i class="glyphicon glyphicon-trash"></i> REMOVE</small></a>
                            </div>
                        </td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            <?php else: ?>
                <thead>
                    <tr>
                        <th>
                            NO RECORDS
                        </th>
                    </tr>
                </thead>
            <?php endif; ?>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-hover">
                <caption>Developers</caption>
            <?php if (isset($developers)): ?>
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NAME</th>
                        <th>E-MAIL</th>
                        <th>APP COUNT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($developers); $i++): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $developers[$i]['name'] ?></td>
                        <td><?= $developers[$i]['email'] ?></td>
                        <td><?= $developers[$i]['appcount'] ?></td>
                        <td>
                            <div class="btn-group">
                                <a href=<?= url('admin/notify/?id=') . $admins[$i]['id'] ?> class="unround btn btn-default btn-xs"><small><i class="glyphicon glyphicon-info-sign"></i> NOTIFY</small></a>
                                <a href=<?= url('users/delete/') . $admins[$i]['id'] ?> class="unround btn btn-default btn-xs"><small><i class="glyphicon glyphicon-trash"></i> REMOVE</small></a>
                            </div>
                        </td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            <?php else: ?>
                <thead>
                    <tr>
                        <th>
                            NO RECORDS
                        </th>
                    </tr>
                </thead>
            <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<?php render('master.foot') ?>
