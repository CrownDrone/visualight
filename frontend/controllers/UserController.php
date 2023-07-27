<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete','profile'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
{
    // Your code to fetch and pass user data to the view
    // For example:
    $users = User::find()->all();

    // Set the custom layout for this view
    $this->layout = 'rbac';

    return $this->render('index', [
        'users' => $users,
    ]);
}
public function actionCreate()
{
    $model = new User(['scenario' => User::SCENARIO_CREATE]);

    if ($model->load(Yii::$app->request->post())) {
        // Validate the model before saving
        if ($model->validate()) {
            // Check if a password is provided
            if (empty($model->newPassword)) {
                Yii::$app->session->setFlash('error', 'Password is required.');
            } else {
                // Save the user data
                $model->setPassword($model->newPassword);
                $model->generateAuthKey();
                $model->generateEmailVerificationToken();
                $model->status = User::STATUS_ACTIVE;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'User created successfully.');
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Error saving user data.');
                }
            }
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

public function actionUpdate($id)
{
    $model = User::findOne($id);

    if (!$model) {
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // Set the scenario to SCENARIO_UPDATE after loading the model data
    $model->scenario = User::SCENARIO_UPDATE;

    // Unset the existingPassword attribute to prevent it from being displayed in the form
    $model->existingPassword = '';

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'User updated successfully.');
        return $this->redirect(['index']); // Change 'index' to your desired destination
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}
public function actionDelete($id)
{
    $user = User::findOne($id);
    if ($user) {
        $user->delete();
        Yii::$app->session->setFlash('success', 'User deleted successfully.');
    } else {
        Yii::$app->session->setFlash('error', 'User not found.');
    }

    return $this->redirect(['index']);
}

public function actionView($id)
{
    $user = User::findOne($id);
    if (!$user) {
        throw new NotFoundHttpException('The requested user does not exist.');
    }

    return $this->render('view', [
        'user' => $user,
    ]);
}

protected function findModel($id)
{
    if (($model = User::findOne($id)) !== null) {
        return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
}

// ...

public function actionProfile($edit = false)
    {
        // Get the current user model
        $userId = Yii::$app->user->id;
        $model = User::findOne($userId);

        // Store the existing password for validation
        $existingPassword = $model->password_hash;

        // Check if the user has submitted the form for updating profile
        if ($model->load(Yii::$app->request->post())) {
            // Check if the entered existing password matches the one in the database
            if (Yii::$app->security->validatePassword($model->existingPassword, $existingPassword)) {
                // Save the model
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Profile updated successfully.');
                    return $this->redirect(['profile']);
                } else {
                    Yii::$app->session->setFlash('error', 'An error occurred while updating the profile.');
                }
            } else {
                $model->addError('existingPassword', 'Existing password is incorrect.');
            }
        }

        return $this->render('profile', [
            'model' => $model,
            'editMode' => $edit, // Pass the $edit variable as $editMode to the view
        ]);
    }

// ...


}
