<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerCssFile(Url::to(['/css/custom.css']));
$defaultImagePath = Yii::getAlias('@web') . '/images/user2.jpg';


$profilePicturePath = $model->profile_picture
    ? Url::to(['/user-profile/get-profile-picture', 'fileName' => $model->profile_picture])
    : $defaultImagePath;


$this->title = '';
// $this->params['breadcrumbs'][] = ['label' => 'User Profile', 'url' => ['view']];
// $this->params['breadcrumbs'][] = $this->title;
?>


<h4 style="color: #0362BA; font-family: Poppins; font-size: 24px; font-style: normal; font-weight: 600; line-height: normal; letter-spacing: 2.5px;">Edit Profile:</h4>

<div class="user-profile-update ">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div style="border-radius: 10px; background: #cceeff; width: 100%; height: 670px; background-size: cover; ">
        <!-- Left column start  -->
        <!-- Show the current image preview -->
        <?php if ($model->profile_picture) : ?>
            <?php echo Html::img($profilePicturePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 300px; width: 300px; margin-top: 9%; margin-left: 10%', 'id' => 'current-image']); ?>
        <?php else : ?>
            <?php echo Html::img($defaultImagePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 300px; width: 300px; margin-top: 9%; margin-left: 10% ', 'id' => 'current-image']); ?>
        <?php endif; ?>
        <br>
        <!-- Add an empty image tag for real-time preview -->
        <img id="image-preview" src="#" alt="Image Preview" class="img-circle elevation-2" style="height: 300px; width: 300px; display: none; margin-top: 9%; margin-left: 10% ">

        <div style="margin-top: 2rem; margin-left: 12.5rem;">
            <label class="btn btn-primary" style="width: 200px; height:45px; background-color: #038EBA; color: #FFF; font-family: Poppins; font-size: 24px; font-style: normal; font-weight: 600; line-height: normal; display: block; text-align: center; overflow: hidden;">
                <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*', 'style' => 'display: none;', 'label' => false])->label('Upload Picture') ?>
            </label>
        </div>


        <!-- End of left column  -->

        <!-- Solid line  -->
        <div style="border-left: 1px solid #03101C; height: 58.07%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"></div>

        <!-- right column  -->
        <div class="form-group" style="width: 30%; position: absolute; top: 45%; right: 12%; transform: translate(0, -50%); ">
            <br>
            <br>
            <!-- <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?> -->
            <!-- <?= Html::a('Back', ['view'], ['class' => 'btn btn-warning']) ?> -->

            <h1><?= Html::encode($this->title) ?></h1>



            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'contactNumber')->textInput(['maxlength' => true]) ?>

            <?php $hasPasswordError = $model->hasErrors('existingPassword'); ?>
            <?= $form->field($model, 'existingPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password', ['style' => 'color: black']) ?>

            <?php $hasPasswordError = $model->hasErrors('newPassword'); ?>
            <?= $form->field($model, 'newPassword')->passwordInput()->hint($hasPasswordError ? '' : '   *Leave it blank if you dont want to change the password', ['style' => 'color: black']) ?>

            <?= Html::submitButton('Update Details', ['class' => 'btn btn-success', 'style' => 'background-color: green; position: absolute;  width: 31.77%; ']) ?>
            <?= Html::a('Back', ['view'], ['class' => 'btn btn-warning', 'style' => ' width: 31.77%;  right: 1.5%; position: absolute;']) ?>

           

        </div>
        <!-- end of right column -->
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

