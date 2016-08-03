<?php if (($status = with('status')) != null): ?>
    <div class="unround success-bar alert alert-default alert-dismissible" id="successBar">
        <button class="close" type="button" data-dismiss="alert">
            <i class="glyphicon glyphicon-remove-circle"></i>
        </button>
        <div class="alert-body" style="ovarflow:hidden">
            <span id="output-successBody"><?= $status ?></span>
        </div>
    </div>
<?php endif; ?>

    <script type="text/javascript" src=<?=assets('assets/js/jquery-2.1.4.min.js') ?>></script>
    <script type="text/javascript" src=<?=assets('assets/js/bootstrap.min.js') ?>></script>
    <script src=<?=assets('assets/js/script.js') ?> type="text/javascript"></script>
    </body>
</html>
