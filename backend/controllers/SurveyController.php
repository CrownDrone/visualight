<?php

namespace backend\controllers;

use Yii;
use common\models\SurveyResponse;
use yii\web\Controller;
use yii\web\Response;

class SurveyController extends BaseController
{
    public function actionIndex()
    {
        $model = new SurveyResponse();

        // If the form is submitted, save the data to the database
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Save the survey response to the database
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Survey response submitted successfully.');
                
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Failed to save survey response.');
            }
        }

        return $this->render('surveyForm', ['model' => $model]);
    }
}
