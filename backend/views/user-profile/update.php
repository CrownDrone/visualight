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

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?php $hasPasswordError = $model->hasErrors('existingPassword'); ?>
    <?= $form->field($model, 'existingPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password',['style' => 'color: green']) ?>
   
    <?php $hasPasswordError = $model->hasErrors('newPassword'); ?>
    <?= $form->field($model, 'newPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password',['style' => 'color: green']) ?>

    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) // Add the image file input field ?>

    <!-- Show the current image preview -->
    <?php if ($model->profile_picture): ?>
        <h3>Current Profile Picture:</h3>
        <?= Html::img(['/uploads/' . $model->profile_picture], ['class' => 'img-thumbnail', 'style' => 'max-width: 900px; max-height: 900px, margin-bottom: 10px', 'id' => 'current-image']) ?>
    <?php endif; ?>
    <br>
    <!-- Add an empty image tag for real-time preview -->
    <img id="image-preview" src="#" alt="Image Preview" class="img-thumbnail" style="max-width: 900px; max-height: 900px; display: none; margin-bottom: 10px">


    <div class="form-group">
        <br>
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
// JavaScript for real-time image preview
$this->registerJs("
$(document).ready(function() {
    // Handler for the file input change event
    $('#".Html::getInputId($model, 'imageFile')."').change(function() {
        // Hide the current image preview (if available)
        $('#current-image').hide();
        
        // Get the selected image file
        var file = $(this)[0].files[0];
        
        // Check if the file is an image
        if (file && file.type.startsWith('image/')) {
            // Create a FileReader to read the image file
            var reader = new FileReader();
            
            // Set the FileReader onload event to update the image preview
            reader.onload = function(e) {
                $('#current-image').hide(); // Hide the current image if there's a new image
                $('#image-preview').attr('src', e.target.result);
                $('#image-preview').show(); // Show the new image preview
            }
            
            // Read the image file as a data URL
            reader.readAsDataURL(file);
        }
    });
});
");
?>
