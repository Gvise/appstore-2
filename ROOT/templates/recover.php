<?php View::render('master.head', compact('title', 'subtitle')) ?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="home" class="navbar-brand"><?=$title?></a>
        </div>
    </div>
</nav>
<div class="container" style="padding-top:60px;">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="text-success">Recover</span>
            </div>
            <div class="panel-body">
                <div class="col-md-11">
                    <form action=<?= App::url('recover') ?> class="form-inline" style="padding-left:30px;">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" placeholder="email" class="form-control">
                                <div class="input-group-addon">@</div>
                            </div>
                        </div>
                        <button class="btn btn-default pull-right" type="submit">Login</button>
                    </form>
                </div>
                <div class="alert alert-success" style="margin-top:50px;margin-bottom:0;">
                    <p>
                        Your password will be sent to your email adddress.
                    </p>
                </div>
            </div>
        </div>
        <div class="alert alert-danger" style="margin-top:10px;margin-bottom:0;">
            <ul>
                <li>Error</li>
            </ul>
        </div>
    </div>
</div>
<?php View::render('master.foot')?>
