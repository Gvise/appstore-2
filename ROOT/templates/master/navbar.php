<!-- Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav c-navbar-nav">
            <li><a href=""><b>Home</b></a></li>
            <li><a href=""><b>New Releases</b></a></li>
        <?php if($data->get('currentPage')) : ?>
            <li class="custom-active"><a href=""><b><?=$data->get('currentPage'); ?></b></a></li>
        <?php endif; ?>
        </ul>

        <form action="" class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" class="form-control unround" placeholder="Search an Application">
            </div>
            <button type="submit" class="btn btn-default unround"><i class="glyphicon glyphicon-search"></i></button>
            <button class="unround btn btn-default notifications-toggle" data-toggle="dropdown" style="margin-left:100px;">
                <i class="glyphicon glyphicon-bell"></i>
            </button>
            <button class="unround btn btn-danger" data-toggle="tooltip" data-placement="left" title="Sign Out">
                    <i class="glyphicon glyphicon-off"></i>
            </button>
        </form>
        <div class="notifications hidden">
            <p class="bg-info text-info">Notifications <a class="notifications-toggle glyphicon glyphicon-remove pull-right"></a></p>
            <ul class="nav">
            <?php if($data->get('notifications')) : ?>
            <?php foreach ($data->get('notifications') as $key => $value) : ?>
                <li><a href="#">$value</a></li>
            <?php endforeach; ?>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
