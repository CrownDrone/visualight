<?php
// frontend/controllers/BaseController.php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // Check if the user is logged in
            if (!Yii::$app->user->isGuest) {
                // Check if the user has accepted the terms
                $currentUser = Yii::$app->user->identity;
                $termsAccepted = !empty($currentUser->tos);

                // Redirect to the terms/index page if terms are not accepted
                if (!$termsAccepted && $this->action->id !== 'terms') {
                    return $this->redirect(['terms/index']);
                }
            }

            return true;
        } else {
            return false;
        }
    }
}
