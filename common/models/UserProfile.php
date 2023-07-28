<?php

// common/models/UserProfile.php
namespace common\models;

use Yii;
use yii\base\Model;

class UserProfile extends Model
{
    public $id;
    public $username;
    public $email;

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
        ];
    }
}
