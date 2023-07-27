<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if ($editMode): ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'existingPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php else: ?>
    <div class="user-profile">
        <p><strong>Username:</strong> <?= Html::encode($model->username) ?></p>
        <p><strong>Email:</strong> <?= Html::encode($model->email) ?></p>
    </div>
    <p><?= Html::a('Edit Profile', ['user/profile', 'edit' => true], ['class' => 'btn btn-primary']) ?></p>
<?php endif; ?>
