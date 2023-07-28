<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'User Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-profile-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update Profile', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>
    <table class="table table-bordered">
        <tr>
            <th>Username:</th>
            <td><?= Html::encode($user->username) ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?= Html::encode($user->email) ?></td>
        </tr>
        <tr>
            <th>Profile Picture:</th>
            <td>
            <?php if ($user->profile_picture): ?>
                <?= Html::img(Url::to(['user-profile/get-profile-picture', 'fileName' => $user->profile_picture]), ['class' => 'img-thumbnail', 'style' => 'max-width: 200px']) ?>
            <?php else: ?>
                <!-- Display a default profile picture if no image is available -->
                <?= Html::img(Url::to(['/images/default-profile-picture.png']), ['class' => 'img-thumbnail', 'style' => 'max-width: 200px']) ?>
            <?php endif; ?>
            </td>
        </tr>
    </table>
</div>
