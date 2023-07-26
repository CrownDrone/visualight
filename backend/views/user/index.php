<?php

/* @var $this yii\web\View */
/* @var $users common\models\User[] */

use yii\helpers\Html;

$this->registerCssFile(Yii::$app->request->baseUrl . '/css/user-index.css');

$this->title = 'Users';

?>

<div class="user-index">
   

    <!-- Create User button -->
    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= Html::encode($user->id) ?></td>
                        <td><?= Html::encode($user->username) ?></td>
                        <td><?= Html::encode($user->email) ?></td>
                        <td><?= Html::encode($user->getStatusLabel()) ?></td>
                        <td>
                            <?= Html::a('View', ['view', 'id' => $user->id], ['class' => 'btn btn-sm btn-info']) ?>
                            <?= Html::a('Update', ['update', 'id' => $user->id], ['class' => 'btn btn-sm btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $user->id], ['class' => 'btn btn-sm btn-danger', 'data-confirm' => 'Are you sure you want to delete this user?', 'data-method' => 'post']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
