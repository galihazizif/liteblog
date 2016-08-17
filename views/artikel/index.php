<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artikel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Artikel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.',
                'headerOptions' => [
                    'style' => 'width: 10px'
                ],
            ],

            'id',
            'date',
            'categoryObj.name:text:Category',
            'title',
            [
                'format' => 'html',
                'label' => 'Content',
                'value' => function($data){
                    return StringHelper::truncateWords($data->content,80,Html::a('.. Read More ..',['/artikel/view','id' => $data->id]));
                },
            ],
            // 'writer',
            // 'img',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
