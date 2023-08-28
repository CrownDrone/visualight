<?php

namespace backend\controllers;

use common\models\ForgotPasswordForm;
use common\models\LoginForm;
use common\models\ResetPasswordForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\db\ActiveRecord;
use common\models\User;


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


    public function actionForgotPassword()
    {
        $this->layout = 'main-no-sidebar';
        $model = new ForgotPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findByEmail($model->email);
            if ($user) {
                $user->generatePasswordResetToken();
                if ($user->save(false)) {
                    $resetLink = Url::to(['site/reset-password', 'token' => $user->password_reset_token], true);
                    $mailer = Yii::$app->mailer->compose()
                        ->setTo($user->email)
                        ->setFrom([Yii::$app->params['adminEmail'] => 'Visualight Team'])
                        ->setSubject('Password reset for ' . Yii::$app->name)
                        ->setTextBody("To reset your password, click on this link: $resetLink. Password token will expire in 2 minutes.")
                        ->send();
                    if ($mailer) {
                        return $this->redirect('https://mail.google.com');

                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to send reset email.');
                        die;
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to generate reset token.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'User not found.');
            }
        }

        return $this->render('forgot-password', [
            'model' => $model,
        ]);
    }
   public function actionResetPassword($token = null)
{
    $this->layout = 'main-no-sidebar';
    $model = new ResetPasswordForm();

    if ($token === null) {
        Yii::$app->session->setFlash('error', 'Cant access the page. No token provided.  ');
        return $this->redirect(['site/login']);
    }

    $user = User::findByPasswordResetToken($token);

    if (!$user || !$user->isPasswordResetTokenValid1()) {
        Yii::$app->session->setFlash('error', 'Token Expired.');
        return $this->redirect(['/site/login']);
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $user->password_hash = Yii::$app->security->generatePasswordHash($model->newPassword);
        $user->removePasswordResetToken();

        if ($user->save()) {
            Yii::$app->session->setFlash('success', 'Password reset successfully.');
            return $this->redirect(['site/login']);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to reset password.');
        }
    }

    return $this->render('reset-password', [
        'model' => $model,
    ]);
}



}
