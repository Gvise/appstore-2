<?php
require __ROOT__.'templates/master/head.php';
require __ROOT__.'templates/master/sidebar.php';
require __ROOT__.'templates/master/navbar.php';

?>

<div class="contents">
    <div class="container">
        <?php if (!isset($app)): ?>
            <h4 class="col-md-offset-4 text-primary">
                Application does not exists !
            </h4>
        <?php exit(); ?>
        <?php endif; ?>
        <div class="app-detail-card" style="margin-left:125px">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src=<?= assets(Config::get('iconpath').$app->icon) ?> width="160" height="160">
                    </a>
                </div>
                <div class="media-body" style="position:relative">
                    <div class="media-heading">
                        <span><?= $app->name ?></span>
                    </div>
                    <div class="report">
                        <?php if (session('user') != null && isset($app->extra) && ($isOwn == true || session('user')->id == $app->developerId)): ?>
                            <a href="#extra-info-dialog" class="custom-dialog-opener btn btn-xs unround btn-default">Extra Info</a>
                            <div class="custom-dialog custom-dialog-md hidden" id="extra-info-dialog">
                                <p style="padding-left:20px;"><b>Extra Info</b></p>
                                <hr class="custom-divider">
                                <p><?= $app->extra ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (session('user') != null && !$reportedByMe): ?>
                            <a href=<?= url('app/report/' . $app->id)?> class="btn btn-xs unround btn-primary" data-toggle="tooltips" data-placement="left" title="Flag as inappropirate!"><i class="glyphicon glyphicon glyphicon-flag"></i></a>
                        <?php endif; ?>

                        <?php if (session('user') != null): ?>
                            <?php if (session('user')->id == $app->developerId): ?>
                                <?php if (session('user')->type == 3): ?>
                                    <a href=<?= url('app/delete/'. $app->id) ?> class="btn btn-xs unround btn-danger" data-toggle="tooltips" data-placement="left" title="Remove this application!"><i class="glyphicon glyphicon glyphicon-trash"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="dev-cat-plat">
                        <a href=""><b><?= $app->developer ?></b></a>
                        <a href=""><b><?= str_replace('G_', 'Game: ', $app->category)?></b></a>
                        <a href=""><b><?= $app->platform ?></b></a>
                    </div>
                    <div class="stars">
                    <?php if ($app->price > 0): ?>
                        <small class="label label-primary"><?= $app->price ?> MMK</small>
                    <?php else: ?>
                        <small class="label label-success">FREE</small>
                    <?php endif; ?>
                        <small class="label label-primary"><i class="glyphicon glyphicon-star"></i> <?= $app->rating ?></small>
                    </div>
                    <div style="position:absolute;bottom:0;right:0">
                        <?php if (session('user') != null && $alreadyInWL): ?>
                            <a href=<?= url('wishlist/delete/' . $app->id)?> class="text-danger"><i class="glyphicon glyphicon-bookmark"></i> Remove from wishlist</a>
                        <?php else: ?>
                            <a href=<?= url('wishlist/add/' . $app->id)?> class="text-success"><i class="glyphicon glyphicon-bookmark"></i> Add to wishlist</a>
                        <?php endif; ?>
                        <div class="dropup" style="display:inline">
                            <a href="" data-toggle="dropdown" class="dropdown-toggle btn btn-default unround btn-sm" style="min-width:50px"><i class="glyphicon glyphicon-star"></i> Rate</a>
                            <ul class="rate-dropup dropdown-menu" style="min-width:100px;">
                                <?php for ($j=0; $j < 5 ; $j++) : ?>
                                <li>
                                    <a href=<?= url('app/rate/' . $app->id . '/' . $j)?>>
                                        <small>
                                            <?php for ($i=0; $i < $j; $i++) : ?>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <?php endfor; ?>

                                            <?php for ($k=0; $k < 5 - $j; $k++) : ?>
                                            <i class="glyphicon glyphicon-star-empty"></i>
                                            <?php endfor; ?>
                                        </small>
                                    </a>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                        <?php if (session('user') != null && $app->price > 0 && $app->developerId != session('user')->id && $isOwn == false): ?>
                            <a href=<?= url('app/buy/'. $app->id )?> class="btn btn-default unround btn-sm">Buy</a>
                        <?php elseif(session('user') == null && $app->price > 0): ?>
                            <a href=<?= url('app/buy/'. $app->id )?> class="btn btn-default unround btn-sm">Buy</a>
                        <?php else: ?>
                            <a href=<?= url('app/download/' . $app->id) ?> class="btn btn-default unround btn-sm"><i class="glyphicon glyphicon-cloud-download"></i> Download</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <br>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <?php for ($i=1; $i < count($appScreenshots) ; $i++) : ?>
                    <li data-target="#carousel-example-generic" data-slide-to=<?= $i ?> ></li>
                    <?php endfor ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php $inactive = true ?>
                    <?php foreach ($appScreenshots as $key => $value): ?>
                        <?php if ($inactive): ?>
                        <?php $inactive = false ?>
                            <div class="item active">
                                <img class="img-responsive" src=<?= assets(Config::get('sspath').$value->path) ?>>
                            </div>
                        <?php else: ?>
                            <div class="item">
                                <img class="img-responsive" src=<?= assets(Config::get('sspath').$value->path) ?>>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
            <br>
            <div>
                <span><?= $app->details ?></span>
                <hr>
                <div class="row">
                    <ul class="col-md-4" style="list-style:none">
                        <li><b>Updated</b></li>
                        <li><?=(new DateTime($app->date))->format('M d, Y') ?></li>
                        <li><br></li>
                        <li><b>Current Version</b></li>
                        <li><?= $app->version ?></li>
                    </ul>
                    <ul class="col-md-4" style="list-style:none">
                        <li><b>Size</b></li>
                        <li><?= meegaBytes($app->size) ?></li>
                        <li><br></li>
                        <li><b>Downloads</b></li>
                        <li><?= $app->downloads ?></li>
                    </ul>
                    <ul class="col-md-4" style="list-style:none">
                        <li><b>Developer</b></li>
                        <li><?= $app->mail ?></li>
                        <li><?= $app->developer ?></li>
                        <li><?= $app->address ?></li>
                    </ul>
                </div>
            </div>
            <?php if (isset($similarApps)): ?>
            <hr>
            <h4>More from <?= str_replace('G_', 'Game: ', $app->category) ?></h4>
            <div class="panel panel-default unround app-feed-panel">
                <div class="panel-body">
                    <div class="panel panel-default unround app-feed-panel">
                        <div class="panel-body">
                        <?php foreach ($similarApps as $key => $value): ?>
                            <div class="app-card">
                                <a href=<?=url('app/'.$value->id)?>>
                                    <img src=<?= assets('storage/icons/' . $value->icon) ?> alt="..." class="img-thumbnail unround">
                                </a>
                                <p><a class="app-card-link" href=<?=url('app/'.$value->id)?>><?=$value->name ?></a></p>
                                <div>
                                    <div>
                                        <i class="glyphicon glyphicon-star"></i> <?= $value->rating ?>
                                        <span class="pull-right"><?=str_replace('G_', '', $value->categoryName)?></span>
                                    </div>
                                    <hr class="custom-divider">
                                    <a class="text-success" href=<?=url('app/'.$value->id)?>><small><?=$value->price == 0 ? 'Free App' : $value->price.' MMK'?></small></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require __ROOT__.'templates/master/foot.php';
?>
