<?php render('master.head', compact('title', 'subtitle')) ?>

<?php render('master.sidebar', compact('title', 'categories', 'categoryGames', 'wishlistCount')) ?>
<?php render('master.navbar', compact('notifications','selectHome', 'selectNewReleases', 'currentPage')) ?>

<div class="contents">
    <div class="container"  style="padding-top:30px;">
        <div class="col-sm-6">
            <form method="post" action=<?= url('user') ?> class="form-horizontal">
                <p><i class="glyphicon glyphicon-user"></i> <b>Profile</b></p>
                <hr>
                <div class="form-group">
                    <lable for="name" class="control-label col-sm-2">Name</lable>
                    <div class="col-sm-10">
                        <input value="<?= isset($name) ? $name : null ?>" type="text" name="name" class="unround form-control" placeholder="User Name">
                    </div>
                </div>
                <div class="form-group">
                    <lable for="email" class="control-label col-sm-2">Email</lable>
                    <div class="col-sm-10">
                        <input value="<?= isset($email) ? $email : null ?>" type="text" name="email" class="unround form-control" placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group">
                    <lable for="nrc" class="control-label col-sm-2">NRC</lable>
                    <div class="col-sm-10">
                        <input value="<?= isset($nrc) ? $nrc : null ?>" type="text" name="nrc" class="unround form-control" placeholder="NRC">
                    </div>
                </div>
                <div class="form-group">
                    <lable for="billing-info" class="control-label col-sm-2">Billing Info</lable>
                    <div class="col-sm-10">
                        <textarea name="billingInfo" class="unround form-control" placeholder="Billing Informations"><?= isset($billingInfo) ? $billingInfo : null ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <lable for="Address" class="control-label col-sm-2">Address</lable>
                    <div class="col-sm-10">
                        <textarea name="address" class="unround form-control" placeholder="Address"><?= isset($address) ? $address : null ?></textarea>
                    </div>
                </div>
                <button type="submit" class="unround btn btn-default pull-right" style="width:100%"><i class="glyphicon glyphicon-ok"> Save</i></button>
            </form>
            <br><br>
        <?php if (($profileError = with('profileError')) != null): ?>
            <div class="unround alert alert-danger">
            <?php foreach ($profileError as $key => $value): ?>
                <ul>
                    <li><?=$value ?></li>
                </ul>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
        <div class="col-sm-6">
            <form method="post" action=<?= url('user/password') ?> class="form-horizontal">
                <p><i class="glyphicon glyphicon-cog"></i> <b>Password Setting</b></p>
                <hr>
                <div class="form-group">
                    <lable for="oldPassword" class="control-label col-sm-4">Old Password</lable>
                    <div class="col-sm-8">
                        <input type="password" name="oldPassword" class="unround form-control" placeholder="Old Password">
                    </div>
                </div>
                <div class="form-group">
                    <lable for="password" class="control-label col-sm-4">New Password</lable>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="unround form-control" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group">
                    <lable for="confirmPassword" class="control-label col-sm-4">Confirm Password</lable>
                    <div class="col-sm-8">
                        <input type="password" name="confirmPassword" class="unround form-control" placeholder="Confirm Password">
                    </div>
                </div>
                <button type="submit" class="unround btn btn-default pull-right" style="width:100%"><i class="glyphicon glyphicon-ok"> Update</i></button>
            </form>
            <br><br>
        <?php if (($passwordError = with('passwordError')) != null): ?>
            <div class="unround alert alert-danger">
            <?php foreach ($passwordError as $key => $value): ?>
                <ul>
                    <li><?=$value ?></li>
                </ul>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php render('master.foot') ?>
