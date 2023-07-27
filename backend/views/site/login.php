<?php
use yii\helpers\Html;

?>
<div class="card">
    <div class="card-body login-card-body" style="background: linear-gradient(180deg, rgba(6, 6, 6, 0.80) 0%, rgba(34, 37, 52, 0.80) 91.55%); border-radius: 20px;">
        <!-- <p class="login-box-msg">Sign in to start your session UwU</p> -->
        <img src="/images/LogoVL.png" alt="qwerty" style="width: 100%">

        
        <?php $form = \yii\bootstrap5\ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            // 'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            // 'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row" style="color: white">
            <div class="col-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => '<div class="icheck-primary">{input}{label}</div>',
                    'labelOptions' => [
                        'class' => ''
                    ],
                    'uncheck' => null
                ]) ?>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php \yii\bootstrap5\ActiveForm::end(); ?>

       
    </div>
    <!-- /.login-card-body -->
</div>