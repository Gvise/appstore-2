<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
    <?php if (session('user')->type > 1): ?>
        <ul class="nav nav-pills">
            <li><a href=<?= url('myapps') ?>>Purchased</a></li>
            <li><a href=<?= url('myapps/published') ?>>Published</a></li>
            <li class="active"><a href=<?= url('myapps/statistics') ?>>Statistics</a></li>
            <li><a href=<?= url('myapps/inappropirate') ?>>Inappropirate Apps</a></li>
            <li><a href=<?= url('myapps/publish') ?>>Publish</a></li>
        </ul>
        <hr>
    <?php endif; ?>
        <ul class="nav nav-pills nav-stacked pull-left"  style="width:200px">
            <li class="active"><a href=<?= url('myapps/statistics')?>>Today</a></li>
            <li><a href=<?= url('myapps/statistics/week')?>>This Week</a></li>
            <li><a href=<?= url('myapps/statistics/month')?>>This Month</a></li>
        </ul>
        <div class="stats">
            <form style="margin-bottom:10px;" action=<?= url('myapps/statistics/filter') ?> method="post"  class="form-inline pull-right">
                <select class="form-control" name="month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <input type="submit" name="name" value="Filter" class="btn btn-default">
            </form>
            <div class="clear">
                <table class="table table-hover">
                <?php if (isset($apps)): ?>
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>APP NAME</th>
                            <th>PLATFORM</th>
                            <th>PRICE (MMK)</th>
                            <th>QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $totleincome = null ?>
                    <?php for($i = 0; $i < count($apps); $i++): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><a href=<?= url('app/'.$apps[$i]['id']) ?> data-toggle="tooltips" data-placement="right" title="Review App"><?= $apps[$i]['name'] ?></a> <i class="glyphicon glyphicon-share-alt"></i></td>
                            <td><?= $apps[$i]['platform'] ?></td>
                            <td><?= $apps[$i]['price'] ?></td>
                            <td><?= $apps[$i]['quantity'] ?></td>
                            <?php $totleincome += $apps[$i]['price'] ?>
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
                <?php if (isset($totleincome)): ?>
                    <b>Totle income today (5% Tax) - <?= ($totleincome - ($totleincome * 0.05)) ?> MMK</b>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
require __ROOT__.'templates/master/foot.php';
?>
