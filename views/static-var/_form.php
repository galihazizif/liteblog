<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaticVar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="static-var-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->isNewRecord): ?>
    	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	<?php else: ?>
		<?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
	<?php endif; ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
