<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Send PDF';

$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin-top:-70px;
    }

    .card {
        max-width: 1000px;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-header {
        background-color: #234d90;
        color: white;
        text-align: center;
        padding: 1.5rem;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 0 0 10px 10px;
    }

    .form-control-file {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 8px;
    }

    .btn-primary {
        background-color: #007bff;
        border: 1px solid #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border: 1px solid #0056b3;
    }

    .alert {
        border-radius: 5px;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="card-body">
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

            <div id="sending-email-message" class="alert alert-info hidden" style ="display:none;">
                <strong>PDF attachments are sending, please wait...</strong>
            </div>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'mt-1']]); ?>

            <?= $form->field($model, 'pdfFile[]')->fileInput(['id' => 'your-file-input-id','multiple' => true, 'class' => 'form-control-file'])->label('Select PDF Files') ?>
            <br>
            <?= $form->field($model, 'selectedRoles')->checkboxList(
                ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'),
                [
                    'class' => 'mt-3',
                    'itemOptions' => ['labelOptions' => ['class' => 'normal-checkbox-label']],
                ]
            )->label('Select User Roles') ?>

            <div class="form-group mt-4">
                <?= Html::submitButton('Send Email', ['class' => 'btn btn-primary btn-block', 'id' => 'send-email-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<< JS
$(document).ready(function() {
    $('#send-email-button').click(function() {
        var fileInput = $('#your-file-input-id'); // Replace 'your-file-input-id' with the actual ID of your file input
        if (fileInput[0].files.length > 0) {
            $('#sending-email-message').hide();
            $('#sending-email-message').show();
        } else {
            $('#sending-email-message').hide();
        }
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
