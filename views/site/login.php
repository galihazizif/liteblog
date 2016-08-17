<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';

?>
<div class="col-md-offset-4 col-md-4">
<div class="panel panel-default animated <?=$model->hasErrors()?'rubberBand infinite':'bounceInDown' ?>">
    <div class="panel-heading">
        <span class="pull-right glyphicon glyphicon-lock"></span> <?=$this->title ?>
    </div>
    <div class="panel-body">
    <div class="row">
    <div class="col-md-offset-1 col-md-10">
        
    
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
        ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', [
        ])->checkbox() ?>

        <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <a href=""></a>
        </div>

        <?php ActiveForm::end(); ?>  
        </div>
        </div>
    </div>
</div>
</div>
