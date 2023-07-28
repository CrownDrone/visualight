<?php
// frontend/views/user-profile/update.php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile(Url::to(['/css/custom.css']));

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'User Profile', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-profile-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?php $hasPasswordError = $model->hasErrors('existingPassword'); ?>
    <?= $form->field($model, 'existingPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password',['style' => 'color: green']) ?>
   
    <?php $hasPasswordError = $model->hasErrors('newPassword'); ?>
    <?= $form->field($model, 'newPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password',['style' => 'color: green']) ?>

    <?= $form->field($model, 'imageFile')->fileInput() // Add the image file input field ?>

    <?php if ($model->profile_picture): // Display the preview if an image is already uploaded ?>
        <h3>Current Profile Picture:</h3>
        <?= Html::img(Url::to(['/uploads/' . $model->profile_picture]), ['class' => 'img-thumbnail', 'style' => 'max-width:200px']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
