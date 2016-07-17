<?php render('master.head', compact('title', 'subtitle')) ?>

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
        <div class="unround alert alert-danger">
            <ul>
                <li>Error</li>
            </ul>
        </div>
        <div class="unround panel panel-default">
            <div class="panel-heading">
                <span class="text-success">Login</span>
            </div>
            <div class="panel-body">
                <div class="col-md-11">
                    <form action=<?= url('login') ?> class="form-horizontal" style="padding-left:40px;">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" placeholder="email" class="unround form-control">
                                <div class="unround input-group-addon">@</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" placeholder="password" class="unround form-control">
                                <div class="unround input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox col-md-6">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                            <div class="col-md-6">
                                <button class="unround btn btn-default pull-right" type="submit">Login</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href=<?= url('recover') ?>>Forget Password ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php if ($loginOnly == NULL): ?>
    <div class="col-md-6">
        <div class="unround alert alert-danger">
            <ul>
                <li>Error</li>
            </ul>
        </div>
        <div class="unround panel panel-default">
            <div class="panel-heading">
                <span class="text-success">Register</span>
            </div>
            <div class="panel-body">
                <form action=<?= url('login') ?> class="form-horizontal">
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="unround form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="unround form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Confirm</label>
                        <div class="col-sm-8">
                            <input type="password" class="unround form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="unround form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">NRC</label>
                        <div class="col-sm-8">
                            <input type="password" class="unround form-control" placeholder="NRC">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Billing Info</label>
                        <div class="col-sm-8">
                            <textarea class="unround form-control" placeholder="Billing Info"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <textarea class="unround form-control" placeholder="Address"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox col-md-offset-1 col-md-6">
                            <label>
                                <input type="checkbox"> I am developer
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
<?php render('master.foot')?>
