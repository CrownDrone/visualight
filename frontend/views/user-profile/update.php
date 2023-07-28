<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'User Profile', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-profile-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'existingPassword')->passwordInput()->label('Existing Password') ?>

    <?= $form->field($model, 'newPassword')->passwordInput()->label('New Password') ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
