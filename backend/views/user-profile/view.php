<?php

use yii\helpers\Html;
use yii\helpers\Url;

// $this->title = 'Update User';
// $this->params['breadcrumbs'][] = $this->title;

// Generate the URL for the default image using the @web alias
$defaultImagePath = Yii::getAlias('@web') . '/images/user2.jpg';
?>

<div class="user-profile-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Edit Profile', ['update'], ['class' => 'btn btn-primary', 'style' => 'position:absolute; right: 50px; top: 740px; font-weight: 600;']) ?>
    <div style="background-image: url('/images/back_pic.png'); background-repeat: no-repeat; background-size: cover; width: 100%; height: 350px;">

        <div style="position: relative; top: 13em; text-align: center; ">
            <?php if ($user->profile_picture) : ?>
                <?= Html::img(Url::to(['user-profile/get-profile-picture', 'fileName' => $user->profile_picture]), ['class' => 'img-circle elevation-2', 'style' => 'height: 200px; width: 200px']) ?>
            <?php else : ?>
                <!-- Display the custom default profile picture if no image is available -->
                <?= Html::img($defaultImagePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 200px; width: 200px']) ?>
            <?php endif; ?>
        </div>

    </div>

    <table class="table table-bordered" style="overflow-x:auto; border-collapse: collapse;border-style:hidden;">
        <tr>
            <td> <strong>Full Name: </strong><?= Html::encode($user->fullName) ?></td>
        </tr>
        <tr>
            <td><strong>Username: </strong><?= Html::encode($user->username) ?></td>

        </tr>
        <tr>
            <td><strong>Email: </strong><?= Html::encode($user->email) ?></td>
        </tr>
        <tr>
            <td> <strong>Role: </strong>
                <?php
                $roles = Yii::$app->authManager->getRolesByUser($user->id);
                $roleNames = [];
                foreach ($roles as $role) {
                    $roleNames[] = $role->name;
                }
                echo Html::encode(empty($roleNames) ? 'GUEST' : implode(', ', $roleNames));
                ?>
            </td>
        </tr>
        <tr>
            <td> <strong>Contact Number: </strong>
            <?= Html::encode($user->contactNumber) ?></td>
        </tr>
        <tr>
           <td><strong>Address: </strong><?= Html::encode($user->address) ?></td>
        </tr>
        <tr>
            <!-- <th>Profile Picture:</th> -->
            <!-- <td> -->
            <!-- <?php if ($user->profile_picture) : ?> -->
            <!-- <?= Html::img(Url::to(['user-profile/get-profile-picture', 'fileName' => $user->profile_picture]), ['class' => 'img-circle elevation-2', 'style' => 'height: 200px; width: 200px']) ?> -->
            <!-- <?php else : ?> -->
            <!-- Display the custom default profile picture if no image is available -->
            <!-- <?= Html::img($defaultImagePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 200px; width: 200px']) ?>
                <?php endif; ?> -->
            <!-- </td> -->
        </tr>
    </table>
</div>