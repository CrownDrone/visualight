<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerCssFile(Url::to(['/css/custom.css']));

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'User Profile', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-profile-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?php $hasPasswordError = $model->hasErrors('newPassword'); ?>
    <?= $form->field($model, 'newPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password',['style' => 'color: green']) ?>


    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
