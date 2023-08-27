<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Forgot Password';
?>

<div class="site-forgot-password">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please enter your email. A link to reset your password will be sent there.</p>

    <?php $form = ActiveForm::begin(['id' => 'forgot-password-form']); ?>
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
