<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
        <ul class="nav nav-tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href=<?= url('admin') ?>>Users</a></li>
                <li><a href=<?= url('admin/cateplat') ?>>Categories &amp; Platforms</a></li>
                <li><a href=<?= url('admin/transitions') ?>>Transitions</a></li>
                <li><a href=<?= url('admin/transitionreports') ?>>Transition Reports</a></li>
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
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($admins); $i++): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $admins[$i]->name ?></td>
                        <td><?= $admins[$i]->email ?></td>
                        <td><?= $admins[$i]->appcount ?></td>
                        <td>
                            <a href=<?= url('admin/notify/?id=') . $admins[$i]->id ?> class="unround btn btn-info btn-xs"><small><i class="glyphicon glyphicon-info-sign"></i> NOTIFY</small></a>
                            <a href=<?= url('user/delete/') . $admins[$i]->id ?> class="unround btn btn-danger btn-xs"><small><i class="glyphicon glyphicon-trash"></i> REMOVE</small></a>
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
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($users); $i++): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $users[$i]->name ?></td>
                        <td><?= $users[$i]->email ?></td>
                        <td>
                            <a href=<?= url('admin/notify/?id=') . $users[$i]->id ?> class="unround btn btn-info btn-xs"><small><i class="glyphicon glyphicon-info-sign"></i> NOTIFY</small></a>
                            <a href=<?= url('user/delete/') . $users[$i]->id ?> class="unround btn btn-danger btn-xs"><small><i class="glyphicon glyphicon-trash"></i> REMOVE</small></a>
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
                        <th>APPS</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($developers); $i++): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $developers[$i]->name ?></td>
                        <td><?= $developers[$i]->email ?></td>
                        <td><?= $developers[$i]->appcount ?></td>
                        <td>
                            <a href=<?= url('admin/notify/?id=') . $developers[$i]->id ?> class="unround btn btn-info btn-xs"><small><i class="glyphicon glyphicon-info-sign"></i> NOTIFY</small></a>
                            <a href=<?= url('user/delete/') . $developers[$i]->id ?> class="unround btn btn-danger btn-xs"><small><i class="glyphicon glyphicon-trash"></i> REMOVE</small></a>
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

<?php
require __ROOT__.'templates/master/foot.php';
?>
