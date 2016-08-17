<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Document', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'filename',
            'desc',
            'update_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{choose}',
                'buttons' => [
                    'choose' => function($url,$model,$key) use ($artikel){
                        return Html::a('Choose',['/document/pilih-gambar','id' => $model->id,'artikelid' => $artikel->id],['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
