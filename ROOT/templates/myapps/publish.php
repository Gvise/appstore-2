<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>
<div class="contents">
    <div class="container">
    <?php if (session('user')->type > 1): ?>
        <ul class="nav nav-pills">
            <li><a href=<?= url('myapps') ?>>Purchased</a></li>
            <li><a href=<?= url('myapps/published') ?>>Published</a></li>
            <li><a href=<?= url('myapps/statistics') ?>>Statistics</a></li>
            <li><a href=<?= url('myapps/inappropirate') ?>>Inappropirate Apps</a></li>
            <li class="active"><a href=<?= url('myapps/publish') ?>>Publish</a></li>
        </ul>
        <hr>
    <?php endif; ?>
        <form method="post" action=<?= url('myapps/publish') ?> enctype="multipart/form-data">
            <div class="col-md-6">
                <?php if (($error = with('error')) != null): ?>
                    <div class="unround alert alert-danger">
                        <ul>
                        <?php foreach ($error as $key => $value): ?>
                            <li><?= $value ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name" class="control-label">Application name</label>
                    <input type="text" class="unround form-control" name="name" placeholder="Application name" value="">
                </div>
                <div class="form-group col-md-5">
                    <label for="name" class="control-label">Platform</label>
                    <select class="unround form-control" name="appPlatform">
                    <?php foreach (session('platforms') as $key => $value): ?>
                        <option value=<?= $value->id ?> > <?= $value->name ?> </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="name" class="control-label">Category</label>
                    <select class="unround form-control" name="appCategory">
                    <?php foreach (array_merge($categories, $categoryGames) as $key => $value): ?>
                        <option value=<?= $value->id ?> > <?= str_replace('G_', 'Game:', $value->name) ?> </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="price" class="control-label">Price</label>
                    <div class="input-group">
                        <input type="text" name="price" class="unround form-control" value="" placeholder="Price">
                        <span class="input-group-addon">MMK</span>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label for="version" class="control-label">Version</label>
                    <input type="text" name="version" class="unround form-control" value="" placeholder="Version">
                </div>
                <div class="form-group">
                    <label for="details" class="control-label">Details</label>
                    <textarea name="details" class="unround form-control" value="" placeholder="Details"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="extra" class="control-label">Extra Details</label>
                    <textarea name="extra" class="unround form-control" value="" placeholder="Extra Details"></textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="file" accept=".png,.jpg,.jpeg,.webp,.ico" name="icon" class="btn btn-default unround" style="width:100%">
                </div>
                <div class="form-group">
                    <label for="screenshots">Screenshots</label>
                    <input type="file" accept=".png,.jpg,.jpeg,.webp" name="screenshots[]" class="btn btn-default unround" style="width:100%" multiple>
                </div>
                <div class="form-group">
                    <label for="screenshots">Application</label>
                    <input type="file"  name="app" class="btn btn-default unround" style="width:100%" multiple>
                </div>
                <input type="submit" class="btn btn-default unroun" value="Submit" style="width:100%">
            </div>
        </form>
    </div>
</div>

<?php
require __ROOT__.'templates/master/foot.php';
?>
