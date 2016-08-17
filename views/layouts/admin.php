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
        <?php
            NavBar::begin([
                'brandLabel' => '<a href="'.Url::to(['/site/index']).'"><img src="'.$request->baseUrl.'/web/img/banner.min.small.png" style="height: 50px; padding: 8px 10px 8px 0; border-right: solid 1px #e7e7e7;" alt="Banner" title="BlogByKen"></a>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar',
                ],
            ]);
           
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav', 'style' => 'text-align: center'],
                'items' => [
                    ['label' => 'Category', 'url' => ['/category/index']],
                    ['label' => 'Post', 'url' => ['/artikel/index']],
                    ['label' => 'Settings', 'url' => ['/static-var/index']],
                    ['label' => 'Images', 'url' => ['/document/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'LOGIN', 'url' => ['/site/login']] :
                        ['label' => 'LOGOUT (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
           
            NavBar::end();
        ?>

        <div style="padding-top: 10px" class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="row">
                <div class="col-md-12">
                    <?= $content ?>      
                </div>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
