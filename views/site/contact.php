<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Contact Us';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Thank you for contacting us. We will respond to you as soon as possible.
    </div>

    <p>
        Note that if you turn on the Yii debugger, you should be able
        to view the mail message on the mail panel of the debugger.
        <?php if (Yii::$app->mailer->useFileTransport): ?>
        Because the application is in development mode, the email is not sent but saved as
        a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
        Please configure the <code>useFileTransport</code> property of the <code>mail</code>
        application component to be false to enable email sending.
        <?php endif; ?>
    </p>

    <?php else: ?>

    <p>
        If you have any questions regarding our articles our next project or just simply want to say hi, please do use the form below to reach us. We try to serve our followers with our utmost best and we are here to provide you with a support you deserve. So please let us know your inquiries and we will get back to you as soon as possible.
    </p>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">{image}</span>
                                      {input}
                                    </div>',
                    'options' => [
                        'style' => 'height: 64px',
                    ],
                ]) ?>
                <div class="form-group">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-send"></span> Send</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>

