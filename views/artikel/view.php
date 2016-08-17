<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Artikel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Artikels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artikel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'category',
            'title',
            'content:ntext',
            'writer',
            'img',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <?=Html::a('Add Image',['/document/add-images','artikelid' => $model->id],['class' => 'btn btn-primary']); ?>  
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
    <?=GridView::widget([
        'dataProvider' => $dpImagePost,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'file.filename',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',['document/hapus-gambar','id' => $model->id]);
                    }
                ],
            ],
        ],

    ]) ?>
    </div>
    </div>


</div>
