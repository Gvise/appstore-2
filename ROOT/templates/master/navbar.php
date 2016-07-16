<!-- Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav c-navbar-nav">
            <li class=<?=isset($selectHome) ? $selectHome : '' ?>><a href=""><b>Home</b></a></li>
            <li class=<?=isset($selectNewReleases) ? $selectNewReleases : '' ?>><a href=""><b>New Releases</b></a></li>
        <?php if(isset($currentPage)) : ?>
            <li class="custom-active"><a href=""><b><?=$currentPage ?></b></a></li>
        <?php endif; ?>
        </ul>

        <form action=<?= App::url('search') ?> class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" class="form-control unround" placeholder="Search an Application">
            </div>
            <button type="submit" class="btn btn-default unround"><i class="glyphicon glyphicon-search"></i></button>
            <button class="unround btn btn-default notifications-toggle" data-toggle="dropdown" style="margin-left:100px;">
                <i class="glyphicon glyphicon-bell"></i>
            </button>
            <div class="btn-group">
                <a class="unround btn btn-default"><?=$user['name'] ?></a>
                <a class="unround btn btn-default" data-toggle="tooltip" data-placement="left" title="Sign Out">
                        <i class="glyphicon glyphicon-off"></i>
                </a>
            </div>
            <a class="unround btn btn-default" href=<?=App::url('join') ?>>Join Now</a>
        </form>
        <div class="notifications hidden">
            <p class="text-info notifications-toggle">Notifications <a class="pull-right btn btn-xs btn-default">Close</a></p>
            <hr class="custom-divider">
            <ul class="nav">
            <?php foreach ($notifications as $key => $value) : ?>
                <li><a href="#">$value</a></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="custom-dialog-filter hidden"></div>
