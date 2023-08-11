<?php

use mdm\admin\components\Helper;
use yii\bootstrap5\Html;
use yii\helpers\Url;


$userName = Yii::$app->user->isGuest ? 'Guest' : ucfirst(Yii::$app->user->identity->username);
$userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);

// Assuming a user can have only one role (modify this part as needed).
$userRoleName = isset($userRole) && !empty($userRole) ? reset($userRole)->name : 'Guest';
$userName = ucfirst($userName); // Convert the first letter to uppercase.

$userId = Yii::$app->user->id;
$model = \common\models\UserProfile::findOne(['id' => $userId]);

$defaultImagePath = Yii::getAlias('@web') . '/images/user2.jpg';



?>

<!-- <nav style="position: fixed; top: 0; height: 100%;"> -->
<aside class="fixed-top main-sidebar sidebar-dark-primary elevation-4" style="background-color: #2A2C2F;">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="/images/logo2.png" alt="Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">DOST-ITDI</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-0 mb-0 d-flex" style="margin-left: -3px;">
            <div class="image" style="padding-left: 10px;">
                <!-- Show the user's profile picture -->
                <?php
                if ($model && $model->profile_picture) {
                    $profilePicturePath = Url::to(['/user-profile/get-profile-picture', 'fileName' => $model->profile_picture]);
                    echo Html::img($profilePicturePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 50px; width: 50px;']);
                } else {
                    echo Html::img($defaultImagePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 50px; width: 50px;']);
                }
                ?>
            </div>
            <div class="info d-flex flex-column justify-content-between ml-2">
                <div>
                    <a href="/profile" class="d-block"> <?= Html::encode($userName) ?> </a>
                </div>
                <div>
                    <p style="color: #F8B200; font-size: 14px;"> <?= Html::encode($userRoleName) ?> </p> <!-- Display the user's role with yellow text color -->
                </div>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo hail812\adminlte\widgets\Menu::widget([
                'items' => [

                    ['label' => 'Yii2 PROVIDED', 'header' => true, 'visible' => Helper::checkRoute('/admin/index'),],
                    ['label' => 'logout', 'url' => ['site/logout'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => Helper::checkRoute('/admin/index'), 'visible' => Helper::checkRoute('/admin/index'),],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => Helper::checkRoute('/admin/index'),],
                    ['label' => 'Accounts', 'header' => true, 'visible' => Helper::checkRoute('/admin/index'),],
                    [
                        'label' => 'Accounts',
                        'url' => ['/admin/index'],
                        'icon' => 'user',

                        'visible' => Helper::checkRoute('/admin/index'),
                        'items' => [
                            [
                                'label' => 'User',
                                'icon' => 'star',
                                'url' => ['/user/index'],
                                'active' => Yii::$app->controller->route === 'user/index',

                            ],
                            [
                                'label' => 'Assignment',
                                'url'   => ['/admin/assignment/index'],
                                'active' => Yii::$app->controller->id == 'assignment',
                            ],
                            [
                                'label' => 'Role',
                                'url'   => ['/admin/role/index'],
                                'active' => Yii::$app->controller->id == 'role',
                            ],
                            [
                                'label' => 'Permission',
                                'url'   => ['/admin/permission/index'],
                                'active' => Yii::$app->controller->id == 'permission',
                            ],
                            [
                                'label' => 'Rule',
                                'url'   => ['/admin/rule/index'],
                                'active' => Yii::$app->controller->id == 'rule',
                            ],
                            [
                                'label' => 'Route',
                                'url'   => ['/admin/route/index'],
                                'active' => Yii::$app->controller->id == 'route',
                            ],
                        ],
                    ],

                    // ['label' => 'ChartJS', 'header' => true, 'visible' => Helper::checkRoute('/chart/chart/index'),],
                    ['label' => 'Chart',  'icon' => 'fas fa-chart-bar', 'url' => ['/chart/chart/index'], 'visible' => Helper::checkRoute('/chart/chart/index'),],
                    ['label' => 'Dashboard',  'icon' => 'fas fa-chalkboard', 'url' => ["/site/index"], 'visible' => Helper::checkRoute('/site/index'), 'visible' => Helper::checkRoute('/site/index'),],

                    [
                        'label' => 'Division Charts',
                        'icon' => 'user',

                        'visible' => Helper::checkRoute('/admin/index'),
                        'items' => [
                            [
                                'label' => 'National Metrology',
                                'icon' => 'star',
                                'url' => ['/nmd/chart/index'],
                                'active' => Yii::$app->controller->route === 'nmd/chart/index',

                            ],
                        ],
                    ],
                       ['label' => 'Terms of Service',  'icon' => 'fas fa-file-contract', 'url' => ["/terms/index"], 'visible' => true],
                    // ['label' => 'Survey',  'icon' => 'fas fa-chalkboard', 'url' => ["/survey/index"], 'visible' => Helper::checkRoute('/site/index'), 'visible' => Helper::checkRoute('/site/index'),],


                ],
            ]);
            ?>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- </nav> -->