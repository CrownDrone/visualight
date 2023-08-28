<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $newPassword;

    public $password_repeat;

    public function rules()
    {
        return [
            [['newPassword', 'password_repeat'], 'required'],
            [['newPassword', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }
}
