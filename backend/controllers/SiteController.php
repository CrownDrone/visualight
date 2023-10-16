<?php

namespace backend\controllers;

use common\models\ForgotPasswordForm;
use common\models\LoginForm;
use common\models\PdfUploadForm;
use common\models\ResetPasswordForm;
use common\models\Site;
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
use yii\web\UploadedFile;
use yii\db\Query;
use DateTime;


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
                        'roles' => ['ADMIN', 'USERS'],
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
    public function actionIndex() //this is for the dashboard keme keme chemerut
    {
        $queryAllDate = (new Query()) //daily record seperated by division, Y axis for the chart
            ->select(['transaction_date AS labels', 'COUNT(*) AS datasets', 'division AS label'])
            ->from('visualight2data.transaction') //from visualight2data database within transaction table
            ->groupBy('transaction_date, division')
            ->orderBy('transaction_date')
            ->all();

        $dailyMapping = [ //to be used on renaming divisions
            "1" => "National Metrology Division",
            "2" => "Standards and Testing Division",
        ];

        foreach ($queryAllDate as &$item) { //to change division 1 & 2 into actual division name
            if (isset($item['label']) && isset($dailyMapping[$item['label']])) {
                $item['label'] = $dailyMapping[$item['label']];
            }
        }

        $queryAllDate2 = (new Query()) //daily record, separated kasi eto yung total transaction of 2 divisions
            ->select([
                'transaction_date AS labels',
                'COUNT(*) AS datasets',
                new \yii\db\Expression("CASE WHEN division IS NOT NULL THEN 'Total' ELSE NULL END AS label")
            ])
            ->from('visualight2data.transaction')
            ->groupBy('transaction_date')
            ->orderBy('transaction_date')
            ->all();

        array_splice($queryAllDate, 2, 0, $queryAllDate2); //separates array to insert new value

        $queryAllDate = array_values($queryAllDate); //re-index the array

        $currentYear = date('Y');//gets year in YYYY format
        $startDate = "$currentYear-01-01";//first date of the current year
        $endDate = "$currentYear-12-31";//last date of the current year

        $dateRange = [];
        $currentDate = new DateTime($startDate);
        while ($currentDate->format('Y-m-d') <= $endDate) {//formats the date into like 2023-12-31
            $dateRange[] = $currentDate->format('Y-m-d');
            $currentDate->modify('+1 day');
        }

        $existingDates = Site::find()//looks for existing date(YYY-MM-DD) record
            ->select('date')
            ->where(['between', 'date', $startDate, $endDate])
            ->asArray()
            ->column();


        $chartLabel = (new Query()) //YYYY-MM-DD will serve as label for the chart, the X axis if you may
            ->select('transDate AS labels')
            ->from('mock_data')
            ->groupBy('transDate')
            ->orderBy('transDate')
            ->all();

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

        if ($model->load(Yii::$app->request->post())) {
            // Find the user by their username or email
            $user = User::findByUsernameOrEmail($model->username);

            if (!$user) {
                // User account doesn't exist, display an error message
                Yii::$app->session->setFlash('error', 'Account doesn\'t exist. Please contact the Administrator to create an account.');
            } elseif ($user->validatePassword($model->password)) {
                // Check if the user's email is verified
                if ($user->status == User::STATUS_EMAIL_NOT_VERIFIED) {
                    // User's email is not verified, display an error message
                    Yii::$app->session->setFlash('error', 'Email is not yet verified. Please check your email for verification instructions.');
                } elseif ($user->status == User::STATUS_INACTIVE) {
                    // User's email is not verified, display an error message
                    Yii::$app->session->setFlash('error', 'Please contact the Administrator to reactivate your account.');
                } else {
                    // Log in the user
                    Yii::$app->user->login($user, $model->rememberMe ? 3600 * 24 * 30 : 0);

                    // Redirect based on roles and terms acceptance
                    if (Yii::$app->user->can('ADMIN') || Yii::$app->user->can('USERS')) {
                        // After successful login, check if the user has accepted the terms
                        $termsAccepted = !empty($user->tos);

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
                }
            } else {
                // Invalid username or password, display an error message
                Yii::$app->session->setFlash('error', 'Invalid username or password.');
            }

            // Continue with the rest of your code as needed.

        }

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
                        ->setSubject('Password reset for Account')
                        ->setTextBody("To reset your password, click on this link: $resetLink. Password token will expire in 10 minutes.")
                        ->send();
                    if ($mailer) {
                        return $this->redirect(['site/success']);
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to send reset Password.');
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
            Yii::$app->session->setFlash('error', 'Cant access the page. No token provided.');
            return $this->redirect(['site/login']);
        }

        $user = User::findByPasswordResetToken($token);

        if (!$user || !$user->isPasswordResetTokenValid1($token)) {
            if ($user) {
                // Token expired and not used, set it to null
                $user->password_reset_token = null;
                $user->save(false); // Save without validation
            }
            Yii::$app->session->setFlash('error', 'Token Expired.');
            return $this->redirect(['/site/login']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->password_hash = Yii::$app->security->generatePasswordHash($model->newPassword);
            $user->removePasswordResetToken();

            if ($user->save()) {

                if (!Yii::$app->user->isGuest) {
                    Yii::$app->user->logout(); // Log out the current user
                }
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

    public function actionSuccess()
    {
        $this->layout = 'main-no-sidebar'; // Set the layout for this action
        return $this->render('success');
    }

    public function actionVerifyEmail($token)
    {

        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout(); // Log out the current user
        }


        $user = User::findByVerificationToken($token);

        if ($user !== null) {
            $user->status = User::STATUS_ACTIVE; // Mark the account as verified
            $user->removeEmailVerificationToken(); // Remove the verification token
            $user->save(false); // Save the user without validation

            Yii::$app->session->setFlash('success', 'Your email has been verified. You can now log in.');
        } else {
            Yii::$app->session->setFlash('error', 'Invalid verification token.');
        }

        return $this->redirect(['site/login']); // Redirect to the login page
    }

    public function actionUploadPdf()
    {
        $model = new PdfUploadForm();

        if (Yii::$app->request->isPost) {
            $model->pdfFile = UploadedFile::getInstances($model, 'pdfFile');

            $uploadSuccessful = true;
            $filePaths = [];

            foreach ($model->pdfFile as $file) {
                $fileName = time() . '_' . $file->name;
                $uploadPath = 'C:/xampp/htdocs/visualight/common/temp_pdf/' . $fileName;

                if (!$file->saveAs($uploadPath)) {
                    $uploadSuccessful = false;
                    Yii::$app->session->setFlash('error', 'Error while uploading one or more files.');
                    break;
                }

                $filePaths[] = $uploadPath;
            }

            if ($uploadSuccessful) {
                // Retrieve the selected roles from POST data as an array
                $selectedRoles = Yii::$app->request->post('PdfUploadForm')['selectedRoles'];

                foreach ($selectedRoles as $selectedRole) {
                    $topManagers = Yii::$app->authManager->getUserIdsByRole($selectedRole);

                    foreach ($topManagers as $managerId) {
                        $user = User::findOne($managerId); // Replace 'User' with your user model class

                        if ($user) {
                            $message = Yii::$app->mailer->compose()
                                ->setFrom([Yii::$app->params['adminEmail'] => 'Visualight Team'])
                                ->setTo($user->email)
                                ->setSubject('PDF Files')
                                ->setTextBody('Please find attached the PDF files.');

                            // Attach all the uploaded files to the email
                            foreach ($filePaths as $filePath) {
                                $message->attach($filePath);
                            }

                            if (!$message->send()) {
                                Yii::$app->session->setFlash('error', 'Error while sending one or more emails.');
                                break;
                            }
                        }
                    }
                }

                if (!Yii::$app->session->hasFlash('error')) {
                    Yii::$app->session->setFlash('success', 'PDF files uploaded and emails sent successfully.');

                    // Redirect to prevent repeated form submissions
                    return $this->redirect(['site/upload-pdf']);
                }
            }
        }

        return $this->render('upload-pdf', ['model' => $model]);
    }


    public function actionUpload()
    {
        $model = new PdfUploadForm();

        if (Yii::$app->request->isPost) {
            $model->pdfFile = UploadedFile::getInstances($model, 'pdfFile');

            if ($model->upload()) {
                // File(s) uploaded successfully
                Yii::$app->session->setFlash('success', 'PDF file(s) uploaded successfully.');
            } else {
                // Error in file upload
                Yii::$app->session->setFlash('error', 'Error while uploading PDF file(s).');
            }

            return $this->redirect(['site/upload-pdf']);
        }

        return $this->render('upload-pdf', ['model' => $model]);
    }
}
