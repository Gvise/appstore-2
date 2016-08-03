<!-- Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href=<?= url('') ?> class="navbar-brand">
                <img alt="" src=<?= assets('assets/images/favicon.ico') ?> class="brand-icon" style="display: inline;"/> <?=$title ?>
            </a>
        </div>

        <ul class="nav navbar-nav c-navbar-nav">
            <li class=<?=isset($selectHome) ? $selectHome : '' ?>><a href=<?= url('') ?>><b>Home</b></a></li>
            <li class=<?=isset($selectNewReleases) ? $selectNewReleases : '' ?>><a href=<?= url('newreleases') ?>><b>New Releases</b></a></li>
        <?php if(isset($currentPage) && $currentPage != null) : ?>
            <li class="custom-active"><a><b><?=$currentPage ?></b></a></li>
        <?php endif; ?>
        </ul>

        <div class="navbar-right" style="margin-right:inherit">
            <form action="" class="navbar-form" method="get" style="display:inline-block">
                <div class="form-group">
                  <input type="text" class="form-control unround" placeholder="Search an Application" name="q">
                  <button type="submit" class="unround btn btn-default">
                      <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
            </form>
        <?php if (session('user') != null): ?>
            <button class="unround btn btn-default notifications-toggle">
                <i class="glyphicon glyphicon-bell"></i>
            </button>
            <div class="btn-group">
                <a class="unround btn btn-default" href=<?= url('user') ?>><?= session('user')->name ?></a>
                <a class="unround btn btn-danger" href=<?= url('logout') ?>><i class="glyphicon glyphicon-off"></i></a>
            </div>
        <?php else: ?>
            <a class="unround btn btn-info" href=<?= url('join')?>>Sign In</a>
        <?php endif; ?>
        </div>
    <?php if (session('user') != null): ?>
        <div class="notifications hidden">
            <p class="text-info notifications-toggle">Notifications <a class="pull-right btn btn-xs btn-default">Close</a></p>
            <hr class="custom-divider">
            <ul class="nav">
        <?php if (isset($notifications)): ?>
            <?php foreach ($notifications as $key => $value) : ?>
                <?php if ($value->proirity == 1): ?>
                    <li class="bg-danger" style="margin:0 5px 1px 5px"><a href="#"><?=$value->content ?></a></li>
                <?php elseif ($value->proirity == 2): ?>
                    <li class="bg-warning" style="margin:0 5px 1px 5px"><a href="#"><?=$value->content ?></a></li>
                <?php else: ?>
                    <li style="margin:0 5px 1px 5px"><a href="#"><?=$value->content ?></a></li>
                <?php endif ?>
            <?php endforeach; ?>
            </ul>
            <div style="position:absolute;bottom:0;width:100%">
                <a class="btn btn-default btn-xs unround" style="width:inherit;" href=<?= url('notifications/clear') ?>>Clear All</a>
            </div>
        <?php endif; ?>
        </div>
    <?php endif; ?>
    </div>
</nav>

<div class="custom-dialog-filter hidden"></div>
