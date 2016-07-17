<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

<div class="contents">
    <div class="container">
        <div class="col-md-6">
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
                        <td><?= $value['amount'] ?></td>
                        <td><?= $value['date'] ?></td>
                        <td>
                        <?php if ($value['completed']): ?>
                            <i class="glyphicon glyphicon-ok"></i>
                        <?php else: ?>
                            <i class="glyphicon glyphicon-remove"></i>
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
                                <td><?= $value['amount'] ?></td>
                                <td><?= $value['date'] ?></td>
                                <td>
                                <?php if ($value['completed']): ?>
                                    <i class="glyphicon glyphicon-ok"></i>
                                <?php else: ?>
                                    <i class="glyphicon glyphicon-remove"></i>
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
        </div>
    </div>
</div>

<?php render('master.foot') ?>
