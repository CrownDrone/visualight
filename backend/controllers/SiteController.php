<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['@'],
                  ],
                  [
                      'allow' => true,
                      'actions' => ['index'],
                      'roles' => ['ADMIN','USER'], 
                  ],
                  [
                    'allow' => true,
                    'actions' => ['logout'],
                    'roles' => ['@'], //everyone allowed
                ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        // Check if the user is already logged in
        if (!Yii::$app->user->isGuest) {
            // Redirect to the homepage or dashboard since the user is already logged in.
            return $this->goHome();
        }

        $this->layout = 'main-login';

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // After successful login, check if the user has accepted the terms
            $currentUser = Yii::$app->user->identity;
            if ($currentUser !== null) {
                // User is authenticated, check if they have accepted the terms
                $termsAccepted = !empty($currentUser->tos);

                // Check if the user has the role 'ADMIN'
                if (Yii::$app->user->can('ADMIN') || Yii::$app->user->can('USER')) {
                    // Redirect based on terms acceptance
                    if ($termsAccepted) {
                        return $this->goHome(); // Redirect to homepage or dashboard
                    } else {
                        return $this->redirect(['terms/index']); // Redirect to terms/index
                    }
                } else {
                    // Log out non-ADMIN users and terminate their session
                    Yii::$app->user->logout();
                    Yii::$app->session->destroy();

                    // Set an error flash message
                    Yii::$app->session->setFlash('error', 'You are not authorized to access this site.');

                    // Redirect to the login page
                    return $this->redirect(['/site/login']);
                }
            } else {
                // The user identity is null, handle the case appropriately
                return $this->redirect(['/site/login']); // Redirect to the login page
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
