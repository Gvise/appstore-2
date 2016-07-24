<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

<div class="contents">
    <div class="container">
        <div class="unround panel panel-default unround" style="margin:50px 0 0 240px;width:500px;">
            <div class="panel-heading" style="background-color:white">
                Withdraw
            </div>
            <div class="panel-body">
                <form method="post" action=<?= url('withdraw') ?> class="form-inline" style="margin-left:20px;">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="unround input-group-addon">Amount </div>
                            <input type="text" class="unround form-control" name="withdrawAmount">
                            <div class="unround input-group-addon"> MMK</div>
                        </div>
                    </div>
                    <button type="submit" class="unround btn btn-default">Request</button>
                </form>
                <br>
                <code class="text-info bg-info unround" style="margin:0 20px 0 20px;display:block;width:90%;">
                    <span>We will send withdraw amount to your billing address.</span><br>
                    <span>You can review or change your billing address in <a href=<?= url('user') ?>>Account Settings</a>.</span>
                </code>
            </div>
        </div>
        <?php if (($error = with('error')) != null): ?>
            <div class="unround alert alert-danger" style="margin:10px 0 0 240px;width:500px;">
            <?php foreach ($error as $key => $value): ?>
                <ul>
                    <li><?=$value ?></li>
                </ul>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php render('master.foot') ?>
