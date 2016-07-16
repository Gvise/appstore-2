<?php if (($status = with('status')) != null): ?>
    <div class="alert alert-success alert-dismissible" role="alert" style="position:fixed;bottom:50px;right:5px;z-index:1033;margin:0">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $status ?>
    </div>
<?php endif; ?>
    <script type="text/javascript" src=<?=assets('assets/js/jquery-2.1.4.min.js') ?>></script>
    <script type="text/javascript" src=<?=assets('assets/js/bootstrap.min.js') ?>></script>
    <script src=<?=assets('assets/js/starrr.js') ?> type="text/javascript"></script>
    <script src=<?=assets('assets/js/script.js') ?> type="text/javascript"></script>
    </body>
</html>
