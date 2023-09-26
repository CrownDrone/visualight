<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Send PDF';

$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);

?>



<h1><?= Html::encode($this->title) ?></h1>


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

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'pdfFile[]')->fileInput(['multiple' => true]) ?>

<?= $form->field($model, 'selectedRoles')->checkboxList(
    ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
) ?>

<div class="form-group">
    <?= Html::submitButton('Send Email', ['class' => 'btn btn-primary']) ?>
</div>


<?php ActiveForm::end(); ?>



