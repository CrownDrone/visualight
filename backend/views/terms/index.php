<?php
// backend/views/terms/index.php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// $this->title = 'Terms of Service';
// $this->params['breadcrumbs'][] = $this->title;



?>


<style>


@font-face {
        font-family: 'Poppins';
        src: url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.ttf') format('truetype'),
            url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.woff') format('woff');

    }

    body{
        font-family:'Poppins';
    }

    </style>

<div class="terms-and-conditions" style = "background: white; padding: 1rem; margin-top: 2.5rem; border-radius: 20px; box-shadow: -4px 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.25);">
    <h2>Terms of Service</h2>
    <p>Please read the following terms and conditions carefully before using our web application. By accessing or using our web application, you agree to be bound by these terms and conditions. If you do not agree with any part of these terms and conditions, you should not use our web application.</p>

    <ol>
        <li>
            <strong>Data Privacy Compliance</strong>    
            <p>We comply with Republic Act 10173, also known as the Data Privacy Act of 2012, to protect your personal data. We collect and process personal data only for the purpose of providing our services and with your consent.</p>
        </li>
        <li>
        <strong>User Responsibilities</strong> 
            <p>You agree to use our services in compliance with applicable laws, including the Data Privacy Act. You are responsible for providing accurate information and maintaining the confidentiality of your account credentials.</p>
        </li>
        <li>
        <strong>Intellectual Property</strong> 
            <p>All intellectual property rights in our services belong to us. You are not allowed to reproduce, modify, distribute, or create derivative works without our prior written consent.</p>
        </li>
        <li>
        <strong>Limitation of Liability</strong> 
            <p>We are not liable for any damages arising from the use of our services, even if we have been advised of the possibility of such damages.</p>
        </li>
        <li>
        <strong>Modifications to the Agreement</strong> 
            <p>We may modify this Agreement at any time without prior notice. It is your responsibility to review the Agreement periodically for any changes.</p>
        </li>
    </ol>

<br>
<br>
<br>


<?php
// Check if the tos column has a value in the database for the current user
$recordExists = !empty($model->tos);
?>
<div class="checkbox-wrapper">
    <?php $form = ActiveForm::begin(['id' => 'terms-form']); ?>

    <?= $form->field($model, 'tos')->checkbox([
        'id' => 'accept-tos-checkbox',
        'disabled' => $recordExists, // Set the 'disabled' attribute based on the presence of the record
        'label' => 'By using our web application, you agree to comply with these terms and conditions.', // Customize the label text here
        'labelOptions' => ['class' => $recordExists ? 'disabled-checkbox-label' : ''],
    ]) ?>

    <?php ActiveForm::end(); ?>
</div>
</div>


<?php

$js = <<< JS
document.getElementById('accept-tos-checkbox').addEventListener('change', function(event) {
    var checkbox = event.target;
    if (!checkbox.disabled && checkbox.checked) {
        // Submit the form using AJAX
        var form = document.getElementById('terms-form');
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                // Handle successful response (optional)
                console.log('TOS accepted successfully.');

                // Disable the checkbox after it has been checked
                checkbox.disabled = true;

                // Redirect to site/index after successful TOS acceptance
                window.location.href = '/site/index';

            } else {
                // Handle error response (optional)
                console.error('Failed to accept TOS.');
            }
        }).catch(error => {
            // Handle error (optional)
            console.error('An error occurred:', error);
        });
    }
});
JS;
$this->registerJs($js);

?>

<style>
    /* CSS to place the checkbox on the right side of the page */
    .checkbox-wrapper {
        display: flex;
        justify-content: flex-end;
    }

    .field-terms-tos {
        margin-right: 0; /* Optional: Adjust the margin to your preference */
    }
</style>
