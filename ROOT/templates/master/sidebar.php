<!-- Sidebar -->
<!--  title, myAppCount, accountBalance, wishlistCount, categories, categoryGames-->
<div class="sidebar">
    <div class="brand">
        <a href=""><?=$title ?></a>
    </div>

    <ul class="nav nav-stacked sidebar-p-nav">
        <li role="presentation">
            <a data-toggle="collapse" href="#collapse-platform" style="background-color: white;">Android Apps <i class="glyphicon glyphicon-chevron-down"></i></a>
            <ul class="nav nav-stacked sidebar-p-nav collapse" id="collapse-platform">
                <li><a href="">Windows Apps</a></li>
                <li><a href="">Linux Apps</a></li>
            </ul>
        </li>
    </ul>

    <ul class="nav nav-stacked">
        <li role="presentation" class="h-collapse-opener" data-target="#collapse-categories">
            <a class="categories">
                <i class="glyphicon glyphicon-th-list"></i>
                Categories
                <i style="margin-top:2px;" class="pull-right glyphicon glyphicon-chevron-right"></i>
            </a>
        </li>

<?php if (session('user') != null): ?>
        <hr class="custom-divider">
        <li role="presentation">
            <a href=<?= url('myapps') ?>>
                <i class="glyphicon glyphicon-th-large"></i>
                <b>My Apps</b>
                <?php if(isset($myAppCount)) : ?>
                <span class="pull-right badge"><?=$myAppCount?></span>
                <?php endif; ?>
            </a>
        </li>

        <hr class="custom-divider">

        <li role="presentation">
            <a data-toggle="collapse" href="#collapse-account">
                <i class="glyphicon glyphicon-user"></i>
                Account <span class="pull-right badge">
                <span id="balance"><?=isset($accountBalance) ? $accountBalance : '0' ;?></span>
                 MMK</span>
            </a>
            <ul class="nav nav-stacked collapse" id="collapse-account">
                <li><a href="">Setting</a></li>
            </ul>
        </li>
        <li role="presentation">
            <a href=<?= url('wishlist') ?>>
                <i class="glyphicon glyphicon-heart"></i>
                Wishlist
                <?php if(isset($wishlistCount) && $wishlistCount > 0) : ?>
                <span class="pull-right badge"><?=$wishlistCount?></span>
                <?php endif; ?>
            </a>
        </li>
        <hr class="custom-divider">
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-collapse-down"></i> Deposit</a>
        </li>

    <!--  allows only develover or above-->
    <?php if (session('user')['type'] >= 2): ?>
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-collapse-up"></i> Withdraw</a>
        </li>
    <?php endif; ?>
    <!--  allows only develover or above-->
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-book"></i> Logs</a>
        </li>

        <!--  allows only admin-->
    <?php if (session('user')['type'] == 3): ?>
        <hr class="custom-divider">
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-user"></i> Users</a>
        </li>
        <li role="presentation"><a href=""><i class="glyphicon glyphicon-transfer"></i> Transactions</a></li>
        <li role="presentation"><a href=""><i class="glyphicon glyphicon-transfer"></i> Transaction Reports</a></li>
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-file"></i> Inappropirate Apps</a>
        </li>
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-bell"></i> Notify</a>
        </li>
    <?php endif; ?>
        <!--  allows only admin-->
    </ul>

    <!-- <div class="copyright dropup">
        <span>Copyright @ 2016</span>
        <button class="btn btn-xs btn-default unround"  data-toggle="dropdown">English <span class="caret"></span></button>
        <ul class="dropdown-menu unround">
            <li><a href="">ျမန္မာ</a></li>
        </ul>
    </div> -->
<?php endif ?>
</div>

<!-- Categories -->
<div id="collapse-categories" style="display:none;">
    <div>
        <ul class="nav nav-stacked">
            <?php foreach ($categories as $key => $value) : ?>
            <li><a href=<?= url('categories/'. $value['id']) ?>><?= $value['name']?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div>
        <p style="padding:10px;">Games</p>
        <hr class="custom-divider">
        <ul class="nav nav-stacked">
            <?php foreach ($categoryGames as $key => $value) : ?>
            <li><a href=<?= url('categories/'. $value['id']) ?>><?=str_replace('G_', '', $value['name'])?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
