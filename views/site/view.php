<?php

use yii\helpers\StringHelper;

/* @var $this yii\web\View */
$this->title = 'BlogByKen-'.$artikel->title;

$request = Yii::$app->request;

?>

        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <h2 class="font-bold"><?=strtoupper($artikel->title)?></h2>
                <b class="color-gray"><?=$artikel->prettyDate ?></b>
                <br><br>
                <p class="color-gray-more">
                
                <?=$artikel->content ?>
                </p>
                <div class="row">
    <?php foreach($artikel->images as $image): ?>
        <div class="col-md-12" style="margin-bottom: 1em">
            <a href="<?=$image->imgSrc() ?>">
                <img style="width: 25em" class="img-thumbnail img-beautiful animated rubberBand" data-li="<?=$request->baseUrl ?>/web/img/reload.svg" data-src="<?=$image->imgSrc()?>" src="<?=$image->imgSrc() ?>">
            </a>
        </div>              
    <?php endforeach; ?>
</div>
            </div>
        </div>
    