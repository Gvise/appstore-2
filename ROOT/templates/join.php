<?php
require __ROOT__.'templates/master/head.php';
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header" >
            <a href="home" class="navbar-brand"><?=$title?></a>
        </div>
    </div>
</nav>
<div class="container" style="padding-top:20px;">
<?php $loginOnly = App::with('loginOnly'); ?>
<?php if ($loginOnly == NULL): ?>
    <div class="col-md-6">
<?php else: ?>
    <div class="col-md-6 col-md-offset-3">
<?php endif; ?>
    <?php if (($lerror = with('lerror')) != null): ?>
        <div class="unround alert alert-danger">
            <ul>
                <?php foreach ($lerror as $key => $value): ?>
                    <li><?= $value ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
        <div class="unround panel panel-default">
            <div class="panel-heading">
                <span class="text-success">Login</span>
            </div>
            <div class="panel-body">
                <div class="col-md-11">
                    <form action=<?= url('login') ?> class="form-horizontal" style="padding-left:40px;" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" placeholder="email" name="email" class="unround form-control">
                                <div class="unround input-group-addon">@</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" placeholder="password" name="password" class="unround form-control">
                                <div class="unround input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href=<?= url('recover') ?>>Forget Password ?</a>
                            <button class="unround btn btn-default pull-right" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php if ($loginOnly == NULL): ?>
    <div class="col-md-6">
    <?php if (($rerror = with('rerror')) != null): ?>
        <div class="unround alert alert-danger">
            <ul>
                <?php foreach ($rerror as $key => $value): ?>
                    <li><?= $value ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
        <div class="unround panel panel-default">
            <div class="panel-heading">
                <span class="text-success">Register</span>
            </div>
            <div class="panel-body">
                <form action=<?= url('register') ?> class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="unround form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="unround form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Confirm</label>
                        <div class="col-sm-8">
                            <input type="password" name="confirmPassword" class="unround form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="unround form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">NRC</label>
                        <div class="col-sm-8">
                            <input type="text" name="nrc" class="unround form-control" placeholder="NRC">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Billing Info</label>
                        <div class="col-sm-8">
                            <textarea class="unround form-control" name="billingInfo" placeholder="Billing Info"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <textarea class="unround form-control" name="address" placeholder="Address"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox col-md-offset-1 col-md-6">
                            <label>
                                <input type="checkbox" name="developer"> I am developer
                            </label>
                        </div>
                        <div class="col-md-5">
                            <button class="unround btn btn-default pull-right" type="submit">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php endif; ?>
</div>
<?php
require __ROOT__.'templates/master/foot.php';
?>
