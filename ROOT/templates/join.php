<?php View::render('master.head', compact('title', 'subtitle')) ?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
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
        <div class="alert alert-danger">
            <ul>
                <li>Error</li>
            </ul>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="text-success">Login</span>
            </div>
            <div class="panel-body">
                <div class="col-md-11">
                    <form action=<?= App::url('login') ?> class="form-horizontal" style="padding-left:40px;">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" placeholder="email" class="form-control">
                                <div class="input-group-addon">@</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" placeholder="password" class="form-control">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox col-md-6">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-default pull-right" type="submit">Login</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href=<?= App::url('recover') ?>>Forget Password ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php if ($loginOnly == NULL): ?>
    <div class="col-md-6">
        <div class="alert alert-danger">
            <ul>
                <li>Error</li>
            </ul>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="text-success">Register</span>
            </div>
            <div class="panel-body">
                <form action=<?= App::url('login') ?> class="form-horizontal">
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Confirm</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">NRC</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="NRC">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Billing Info</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Billing Info"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Address"></textarea>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-default" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
<?php endif; ?>
</div>
<?php View::render('master.foot')?>
