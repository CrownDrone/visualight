<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerCssFile(Url::to(['/css/custom.css']));



$this->title = '';
// $this->params['breadcrumbs'][] = ['label' => 'User Profile', 'url' => ['view']];
// $this->params['breadcrumbs'][] = $this->title;
?>


<h4 style="color: #0362BA; font-family: Poppins; font-size: 24px; font-style: normal; font-weight: 600; line-height: normal; letter-spacing: 2.5px;">Edit Profile:</h4>

<div class="user-profile-update">
    <div style="border-radius: 10px; background: #77bfc7; width: 100%; height: 670px; background-size: cover; ">
        <!-- Left column start  -->
        <!-- Show the current image preview -->
        <?php if ($model->profile_picture) : ?>
            <?php
            $profilePicturePath = Url::to(['/user-profile/get-profile-picture', 'fileName' => $model->profile_picture]);
            echo Html::img($profilePicturePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 227px; width: 227px; margin-top: 14%; margin-left: 10%', 'id' => 'current-image']); ?>
        <?php endif; ?>
        <br>
        <!-- Add an empty image tag for real-time preview -->
        <img id="image-preview" src="#" alt="Image Preview" class="img-circle elevation-2" style="height: 227px; width: 227px; display: none; margin-top: 13%; margin-left: 10% ">

        <!-- End of left column  -->

        <!-- right column  -->
        <div class="form-group" style="width: 30%; position: absolute; top: 50%; right: 12%; transform: translate(0, -50%); ">
            <br>
            <br>
            <!-- <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?> -->
            <!-- <?= Html::a('Back', ['view'], ['class' => 'btn btn-warning']) ?> -->

            <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'contactNumber')->textInput(['maxlength' => true]) ?>

            <?php $hasPasswordError = $model->hasErrors('existingPassword'); ?>
            <?= $form->field($model, 'existingPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password', ['style' => 'color: black']) ?>

            <?php $hasPasswordError = $model->hasErrors('newPassword'); ?>
            <?= $form->field($model, 'newPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password', ['style' => 'color: black']) ?>

            <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) // Add the image file input field 
            ?>
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Back', ['view'], ['class' => 'btn btn-warning']) ?>

        </div>
        <!-- end of right  -->
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
// JavaScript for real-time image preview
$this->registerJs("
$(document).ready(function() {
    // Handler for the file input change event
    $('#" . Html::getInputId($model, 'imageFile') . "').change(function() {
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
});");
?>