<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';
?>

<div class="contents">
    <div class="container">
    <?php if (session('user')->type < 2): ?>
        <div class="col-md-offset-1 col-md-10">
    <?php else: ?>
        <div class="col-md-6">
    <?php endif ?>
        <?php if (isset($deposit)): ?>
            <table class="table table-hover table-condensed">
                <caption>Deposit Logs</caption>
                <thead class="text-info">
                    <tr>
                        <th>AMOUNT (MMK)</th>
                        <th>DATE</th>
                        <th>PROCESSED</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($deposit as $key => $value): ?>
                    <tr>
                        <td><?= $value->amount ?></td>
                        <td><?= (new DateTime($value->date))->format('M d, Y') ?></td>
                        <td>
                        <?php if ($value->completed): ?>
                            <a class="btn btn-default btn-xs glyphicon glyphicon-ok"></a>
                        <?php else: ?>
                            <a class="btn btn-default btn-xs glyphicon glyphicon-remove"></a>
                            <a href=<?= url('logs/report/' . $value->id) ?> class="btn btn-warning btn-xs glyphicon glyphicon-info-sign" title="Report this transaction."></a>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table table-hover table-condensed">
                <caption>Deposit Logs</caption>
                <thead class="text-info">
                    <tr>
                        <th>NO RECORDS</th>
                    </tr>
                </thead>
            </table>
        <?php endif; ?>
        </div>
    <?php if (session('user')->type > 1): ?>
        <div class="col-md-6">
            <?php if (isset($withdraw)): ?>
                <table class="table table-hover table-condensed">
                    <caption>Withdraw Logs</caption>
                    <thead class="text-info">
                        <tr>
                            <th>AMOUNT (MMK)</th>
                            <th>DATE</th>
                            <th>PROCESSED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($withdraw as $key => $value): ?>
                            <tr>
                                <td><?= $value->amount ?></td>
                                <td><?= (new DateTime($value->date))->format('M d, Y') ?></td>
                                <td>
                                <?php if ($value->completed): ?>
                                    <a class="btn btn-default btn-xs glyphicon glyphicon-ok"></a>
                                <?php else: ?>
                                    <a class="btn btn-default btn-xs glyphicon glyphicon-remove"></a>
                                    <a href=<?= url('logs/report/' . $value->id) ?> class="btn btn-warning btn-xs glyphicon glyphicon-info-sign" title="Report this transaction."></a>
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <table class="table table-hover table-condensed">
                    <caption>Withdraw Logs</caption>
                    <thead class="text-info">
                        <tr>
                            <th>NO RECORDS</th>
                        </tr>
                    </thead>
                </table>
            <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php
require __ROOT__.'templates/master/foot.php';
?>
