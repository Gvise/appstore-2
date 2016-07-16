<!-- Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav c-navbar-nav">
            <li class=<?=isset($selectHome) ? $selectHome : '' ?>><a href=<?= url('') ?>><b>Home</b></a></li>
            <li class=<?=isset($selectNewReleases) ? $selectNewReleases : '' ?>><a href=<?= url('newreleases') ?>><b>New Releases</b></a></li>
        <?php if(isset($currentPage) && $currentPage != null) : ?>
            <li class="custom-active"><a><b><?=$currentPage ?></b></a></li>
        <?php endif; ?>
        </ul>

        <form action=<?= url('search') ?> class="navbar-form navbar-right" method="get">
            <div class="form-group">
              <input type="text" class="form-control unround" placeholder="Search an Application" name="q">
            </div>
            <button type="submit" class="btn btn-default unround"><i class="glyphicon glyphicon-search"></i></button>
        <?php if (session('user') != null): ?>
            <button class="unround btn btn-default notifications-toggle" data-toggle="dropdown" style="margin-left:100px;">
                <i class="glyphicon glyphicon-bell"></i>
            </button>
            <div class="btn-group">
                <a class="unround btn btn-default"><?= session('user')['name'] ?></a>
                <a class="unround btn btn-default" data-toggle="tooltip" data-placement="left" title="Sign Out" href=<?= url('logout') ?>>
                    <i class="glyphicon glyphicon-off"></i>
                </a>
            </div>
        <?php else: ?>
            <a class="unround btn btn-default" href=<?=url('join') ?>>Join Now</a>
        <?php endif; ?>
        </form>
    <?php if (session('user') != null): ?>
        <div class="notifications hidden">
            <p class="text-info notifications-toggle">Notifications <a class="pull-right btn btn-xs btn-default">Close</a></p>
            <hr class="custom-divider">
            <ul class="nav">
            <?php foreach ($notifications as $key => $value) : ?>
                <li><a href="#"><?=$value?></a></li>
            <?php endforeach; ?>
            </ul>
            <div style="position:absolute;bottom:0;width:100%">
                <a class="btn btn-default btn-xs unround" style="width:inherit;" href=<?= url('notifications/clear') ?>>Clear All</a>
            </div>
        </div>
    <?php endif; ?>
    </div>
</nav>
<div class="custom-dialog-filter hidden"></div>
