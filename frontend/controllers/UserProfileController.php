<?php
// frontend/controllers/UserProfileController.php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\UserProfile;
use yii\web\NotFoundHttpException;

class UserProfileController extends Controller
{
    public function actionView()
    {
        $user = Yii::$app->user->identity;
        return $this->render('view', ['user' => $user]);
    }

    public function actionUpdate()
    {
        $model = UserProfile::findOne(Yii::$app->user->id);

        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        // Set the scenario to SCENARIO_UPDATE after loading the model data
        $model->scenario = UserProfile::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'User profile updated successfully.');
                return $this->redirect(['view']);
            } else {
                Yii::$app->session->setFlash('error', 'Error updating user profile.');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
