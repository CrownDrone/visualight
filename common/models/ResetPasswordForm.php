<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class ResetPasswordForm extends ActiveRecord
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

    public static function tableName()
    {
        return 'user';
    }
}
