<?php if (($status = with('status')) != null): ?>
    <div class="unround alert alert-default alert-dismissible unround" role="alert" style="-webkit-box-shadow: 0 0 1px 1px #BFBFBF;box-shadow: 0 0 1px 1px #BFBFBF;position:fixed;top:50px;right:5px;z-index:1033;margin:0;min-width:300px;background-color:white">
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
