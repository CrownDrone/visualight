<?php

// frontend/views/user-profile/view.php
use yii\helpers\Html;

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
    </table>
</div>
