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

    <?= Html::a('Edit Profile', ['update'], ['class' => 'btn btn-primary', 'style' => 'position:absolute; right: 5rem; top: 720px; font-weight: 600; ']) ?>
    <div style="background-image: url('/images/back_pic.png'); background-repeat: no-repeat; background-size: cover; width: 100%; height: 350px;">

        <div style="position: relative; top: 13em; text-align: center;">
            <?php if ($user->profile_picture) : ?>
                <?= Html::img(Url::to(['user-profile/get-profile-picture', 'fileName' => $user->profile_picture]), ['class' => 'img-circle elevation-2', 'style' => 'height: 200px; width: 200px']) ?>
            <?php else : ?>
                <!-- Display the custom default profile picture if no image is available -->
                <?= Html::img($defaultImagePath, ['class' => 'img-circle elevation-2', 'style' => 'height: 200px; width: 200px']) ?>
            <?php endif; ?>
        </div>
    </div>

    <div style="text-align: center; margin-top: 4rem;">
        <span style="color: #0362BA; font-family: Poppins; font-size: 20px; font-style: normal; font-weight: 300; line-height: normal; letter-spacing: 3px;">
            <?php
            $roles = Yii::$app->authManager->getRolesByUser($user->id);
            $roleNames = [];
            foreach ($roles as $role) {
                $roleNames[] = $role->name;
            }
            echo Html::encode(empty($roleNames) ? 'GUEST' : implode(', ', $roleNames));
            ?>
        </span>
        <br>
        <span style="color: black; font-weight: 300; width: 525px; height: 54px;">
            <?= Html::encode($user->fullName) ?>
        </span>
    </div>

    <div style="margin: 2rem auto; border-top: 2px solid #000; width: 90%;"></div>


    <table class="table table-bordered" style="overflow-x:auto; border-collapse: collapse; border-style:hidden; text-indent: 13rem; margin-top: 1rem; ">
        <tr>
            <!-- <td style="border-style: hidden;  padding: 5px 10px;"> <strong>Full Name: </strong><?= Html::encode($user->fullName) ?></td> -->
        </tr>
        <tr>
            <!-- <td style="border-style: hidden; padding:5px 10px;"><strong>Username: </strong><?= Html::encode($user->username) ?></td> -->

        </tr>
        <tr>
            <td style="border-style: hidden; padding:5px 10px;"><strong>Email: </strong><?= Html::encode($user->email) ?></td>
        </tr>
        <tr>
            <td style="border-style: hidden; padding:5px 10px;"> <strong>Position: </strong>
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
            <td style="border-style: hidden; padding:5px 10px;"> <strong>Contact Number: </strong>
                <?= Html::encode($user->contactNumber) ?></td>
        </tr>
        <tr>
            <td style="border-style: hidden; padding:5px 10px;"><strong>Address: </strong><?= Html::encode($user->address) ?></td>
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
            </td>
            <!-- </tr> -->
    </table>
</div>