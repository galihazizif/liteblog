<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;
use app\models\StaticVar;

$staticVarRaw = StaticVar::find()->asArray()->all();
$staticVar = ArrayHelper::map($staticVarRaw,'name','content');


$request = Yii::$app->request;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$js = <<<JS
$('[data-toggle="tooltip"]').tooltip();
JS;

$this->registerJs($js);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <nav class="navbar navbar-ku">
        <div class="container">
        <div clss="row">
            <div class="col-md-12">
                <div class="brand" style="text-align: center">
                    <a style="margin-left: auto; margin-right: auto" href="<?=Url::to(['/site/index']) ?>"><img src="<?=$request->baseUrl?>/web/img/banner.min.small.png" style="height: 150px; padding: 10px 0 10px 0" alt="Banner" title="BlogByKen"></a>
                </div>  
            </div>
        </div>
              </div>
        </nav>
            <?php

           
            

            NavBar::begin([
                'options' => [
                    'class' => '',
                ],
                'containerOptions' => [
                    'style' => 'text-align: center',
                ],
            ]);
            echo '<div class="row">';
            echo '<div class="col-md-offset-2">';
            echo $this->render('_menu');
            echo '</div>';
            echo '</div>';
            ?>
            
            <?php
            NavBar::end();
        ?>

        <div style="padding-top: 10px" class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="row">
                <?=$content ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                <p class="">
                    <a data-toggle="tooltip" title="Click to follow me on Instagram" href="<?=($staticVar['instagram_link'])?:'' ?>"><img src="<?=$request->baseUrl ?>/web/img/instagram-icon.png" class="circle" style="width: 30px"></a>
                    <a data-toggle="tooltip" title="Go to my tumblr" href="<?=($staticVar['tumblr_link'])?:'' ?>"><img src="<?=$request->baseUrl ?>/web/img/tumblr-icon.png" class="circle" style="width: 30px"></a> 
                    | Copyright <b>BlogByKen</b> &copy; <?=date('Y') ?>
                </p>
                    
                </div>
            </div>
        </div>
    </footer>

    <div class="loading-overlay" id="loading-overlay">
        <div>
            <img src="<?=$request->baseUrl ?>/web/img/reload.svg" style="margin-top: 20em">
            <p style="color: #59E67C"><b>LOADING</b></p>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
