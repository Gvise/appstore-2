<div class="sidebar">
<?php if (session('platforms') != null): ?>
    <ul class="nav nav-stacked sidebar-p-nav">
        <li role="presentation">
            <a data-toggle="collapse" href="#collapse-platform" style="background-color: white;"><?= session('currentPlatform')->name ?> <i class="glyphicon glyphicon-chevron-down"></i></a>
    <?php foreach (session('platforms') as $key => $value): ?>
        <?php if ($value->id != session('currentPlatform')->id): ?>
            <ul class="nav nav-stacked sidebar-p-nav collapse" id="collapse-platform">
                <li><a href=<?= url('changeplatform/'. $value->id) ?>> <?= $value->name ?></a></li>
            </ul>
        <?php endif; ?>
    <?php endforeach; ?>
        </li>
    </ul>
<?php endif; ?>
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
                <li><a href=<?= url('user') ?>>Setting</a></li>
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
            <a href=<?= url('deposit') ?>><i class="glyphicon glyphicon-collapse-down"></i> Deposit</a>
        </li>

    <!--  allows only develover or above-->
    <?php if (session('user')->type >= 2): ?>
        <li role="presentation">
            <a href=<?= url('withdraw') ?>><i class="glyphicon glyphicon-collapse-up"></i> Withdraw</a>
        </li>
    <?php endif; ?>
    <!--  allows only develover or above-->
        <li role="presentation">
            <a href=<?= url('logs') ?>><i class="glyphicon glyphicon-book"></i> Logs</a>
        </li>

        <!--  allows only admin-->
    <?php if (session('user')->type == 3): ?>
        <hr class="custom-divider">
        <li role="presentation">
            <a href=<?= url('admin') ?>><i class="glyphicon glyphicon-cog"></i> Administration</a>
        </li>
    <?php endif; ?>
        <!--  allows only admin-->
    </ul>

    <!-- <div class="copyright">
        <span>Copyright @ 2016</span>
    </div> -->
<?php endif ?>
</div>

<!-- Categories -->
<div id="collapse-categories" style="display:none;">
    <div>
        <ul class="nav nav-stacked">
        <?php foreach ($categories as $key => $value) : ?>
            <li><a href=<?= url('categories/'. $value->id) ?>><?= $value->name ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div>
        <p style="padding:10px;">Games</p>
        <hr class="custom-divider">
        <ul class="nav nav-stacked">
            <?php foreach ($categoryGames as $key => $value) : ?>
            <li><a href=<?= url('categories/'. $value->id) ?>><?=str_replace('G_', '', $value->name)?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
