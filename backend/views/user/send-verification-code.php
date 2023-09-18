<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Resend Email Verification';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to(['/css/custom.css']));
?>


<div class="user-create"  style = "background: white; padding: 1rem; border-radius: 20px; box-shadow: -4px 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.25);">




<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php elseif (Yii::$app->session->hasFlash('info')): ?>
    <div class="alert alert-info">
        <?= Yii::$app->session->getFlash('info') ?>
    </div>
<?php endif; ?>


<h2 style = "padding-bottom: 10px; color: black;"> Resend Email Verification </h2>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Resend Verification Email', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
