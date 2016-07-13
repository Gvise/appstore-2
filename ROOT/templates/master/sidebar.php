<!-- Sidebar -->
<div class="sidebar">
    <div class="brand">
        <a href=""><?=$data->get('title'); ?></a>
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

        <hr class="custom-divider">

        <li role="presentation">
            <a>
                <i class="glyphicon glyphicon-th-large"></i>
                <b>My Apps</b> <span class="pull-right badge">10</span>
            </a>
        </li>

        <hr class="custom-divider">

        <li role="presentation">
            <a data-toggle="collapse" href="#collapse-account">
                <i class="glyphicon glyphicon-user"></i>
                Account <span class="pull-right badge"><span id="balance">1000</span> MMK</span>
            </a>
            <ul class="nav nav-stacked collapse" id="collapse-account">
                <li><a href="">Setting</a></li>
            </ul>
        </li>
        <li role="presentation">
            <a>
                <i class="glyphicon glyphicon-heart"></i>
                Wishlist <span class="pull-right badge">10</span>
            </a>
        </li>
        <hr class="custom-divider">
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-collapse-down"></i> Deposit</a>
        </li>
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-collapse-up"></i> Withdraw</a>
        </li>
        <li role="presentation">
            <a href=""><i class="glyphicon glyphicon-book"></i> Logs</a>
        </li>
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
    </ul>
    <div class="copyright dropup">
        <span>Copyright @ 2016</span>
        <button class="btn btn-xs btn-default unround"  data-toggle="dropdown">English <span class="caret"></span></button>
        <ul class="dropdown-menu unround">
            <li><a href="">ျမန္မာ</a></li>
        </ul>
    </div>
</div>
<!-- Categories -->
<div id="collapse-categories" style="display:none;">
    <div>
        <ul class="nav nav-stacked">
            <li><a href="">Book and References</a></li>
            <li><a href="">Business</a></li>
            <li><a href="">Comic</a></li>
            <li><a href="">Communication</a></li>
            <li><a href="">Education</a></li>
            <li><a href="">Entertainment</a></li>
            <li><a href="">Finance</a></li>
            <li><a href="">Health and Fitness</a></li>
            <li><a href="">Libraries and Demo</a></li>
            <li><a href="">Lifestyle</a></li>
            <li><a href="">Music and Video</a></li>
            <li><a href="">Medical</a></li>
            <li><a href="">Music and Audio</a></li>
            <li><a href="">News and Magazines</a></li>
            <li><a href="">Personalizatoin</a></li>
            <li><a href="">Photography</a></li>
            <li><a href="">Productivity</a></li>
            <li><a href="">Social</a></li>
            <li><a href="">Sports</a></li>
            <li><a href="">Tools</a></li>
            <li><a href="">Transportation</a></li>
            <li><a href="">Weather</a></li>
        </ul>
    </div>
    <div>
        <p style="padding:10px;">Games</p>
        <hr class="custom-divider">
        <ul class="nav nav-stacked">
            <li><a href="">Action</a></li>
            <li><a href="">Adventure</a></li>
            <li><a href="">Arcade</a></li>
            <li><a href="">Board</a></li>
            <li><a href="">Card</a></li>
            <li><a href="">Casino</a></li>
            <li><a href="">Casual</a></li>
            <li><a href="">Educational</a></li>
            <li><a href="">Music</a></li>
            <li><a href="">Puzzle</a></li>
            <li><a href="">Racing</a></li>
            <li><a href="">Roll Playing</a></li>
            <li><a href="">Simulaton</a></li>
            <li><a href="">Sport</a></li>
            <li><a href="">Strategy</a></li>
            <li><a href="">Trivia</a></li>
            <li><a href="">World</a></li>
        </ul>
    </div>
</div>
