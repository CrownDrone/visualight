<?php

// frontend/controllers/UserProfileController.php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\UserProfile;

class UserProfileController extends Controller
{
    public function actionView()
    {
        $user = Yii::$app->user->identity;
        return $this->render('view', ['user' => $user]);
    }

    private function verifyExistingPassword($password)
    {
        $user = Yii::$app->user->identity;
        return Yii::$app->security->validatePassword($password, $user->password_hash);
    }

    private function setPassword($password)
    {
        $user = Yii::$app->user->identity;
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    private function saveUser($user)
    {
        return $user->save(false); // Save without validating again
    }

    public function actionUpdate()
    {
        $user = Yii::$app->user->identity;
        $model = new UserProfile([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // If the user entered an existing password and it's correct, update the new password
            if (!empty($model->existingPassword) && $this->verifyExistingPassword($model->existingPassword)) {
                $this->setPassword($model->newPassword);
            }

            $user->username = $model->username;
            $user->email = $model->email;
            if ($this->saveUser($user)) {
                Yii::$app->session->setFlash('success', 'Profile updated successfully.');
                return $this->redirect(['view']);
            } else {
                Yii::$app->session->setFlash('error', 'Error updating profile.');
            }
        }

        return $this->render('update', ['model' => $model]);
    }
}
