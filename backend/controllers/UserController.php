<?php

namespace backend\controllers;

use common\models\UserSearch;
use Yii;
use yii\web\Controller;
use common\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;

class UserController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update','delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
                        return $this->redirect(['/admin/assignment/view', 'id' => $model->id]);
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
    
        // Store the existing password for later use
        $existingPassword = $model->password;
    
        // Set the scenario to SCENARIO_UPDATE after loading the model data
        $model->scenario = User::SCENARIO_UPDATE;
    
        // Clear the password attributes to prevent them from being displayed in the form
        $model->password = '';
        $model->newPassword = '';    
        if ($model->load(Yii::$app->request->post())) {
            // Restore the existing password if it wasn't changed
            if (empty($model->newPassword)) {
                $model->password = $existingPassword;
            }
    
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'User updated successfully.');
                return $this->redirect(['index']); // Change 'index' to your desired destination
            }
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

}
