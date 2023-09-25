<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Send PDF';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'pdfFile')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
