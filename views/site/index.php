<?php

use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$this->title = 'BlogByKen';

$request = Yii::$app->request;
$artikels = $qArtikels->all();
?>
<div class="site-index">
<?php if(!empty($request->get('q'))): ?>
    <p>Looking for <b>"<?=Html::encode($request->get('q')); ?>"</b> <?=$qArtikels->count() ?> found</p>
<?php endif; ?>
<?php if($qArtikels->count() > 0): ?>
    <?php foreach($artikels as $artikel): ?>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-bold"><?=Html::a(strtoupper($artikel->title),$artikel->permalink)?></h4>
                <b><?=$artikel->prettyDate ?></b>
                <?php if(empty($request->get('cat'))): ?>
                    on <?=$artikel->categoryObj->name ?>
                <?php endif; ?>
                <p>
                <?php if($artikel->countImg > 0): ?>   
                    <div style="width: 13em; margin-right: 1em" class="pull-left">
                        <img class="img-thumbnail animated rubberBand img-beautiful" src="<?=$artikel->image->imgSrc() ?>">
                    </div>
                <?php endif; ?>
               
                    <?=StringHelper::truncateWords($artikel->content,100) ?>
                    <?=Html::a(' <b><i>read more</i></b>',$artikel->permalink)?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="row">
        <div class="col-md-12">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]);?>
        </div>
    </div>
<?php else: ?>
    <?php if(!empty($request->get('cat'))): ?>
        <div class="alert alert-default">No data found in this category</div>
    <?php else: ?>
        <div class="alert alert-default">No data found</div>
    <?php endif; ?>
<?php endif ?>
</div>
