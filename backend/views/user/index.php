<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

// $this->registerCssFile(Yii::$app->request->baseUrl . '/css/user-index.css');

$this->title = 'Users';

?>
<div class="user-index">

    <!-- Create User button -->
    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="grid-view-container">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => '{items}',
            'tableOptions' => ['class' => 'table table-striped'],
            'headerRowOptions' => ['class' => 'bg-blue'],
            'columns' => [
                [
                    'attribute' => 'fullName',
                    'label' => 'Full Name',
                    'headerOptions' => ['class' => 'bg-blue white-text'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                ],
                [
                    'attribute' => 'username',
                    'label' => 'Username',
                    'headerOptions' => ['class' => 'bg-blue white-text'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                    'headerOptions' => ['class' => 'bg-blue white-text'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'value' => function ($model) {
                        return $model->getStatusLabel();
                    },
                    'filter' => User::getStatusOptions(),
                    'headerOptions' => ['class' => 'bg-blue white-text'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view} {update} {delete}',
                    'headerOptions' => ['class' => 'bg-blue white-text'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>

<style>
    .grid-view-container {
        max-height: 670px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
    }

    .table th,
    .table td {
        text-align: center;
    }

    .bg-blue {
        background-color: blue;
    }

    .white-text {
        color: white;
    }

    /* Responsive styles */
    @media (max-width: 787px) {
        .grid-view-container {
            max-height: none;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }
</style>