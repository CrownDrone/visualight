<?php
// common/models/UserProfile.php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class UserProfile extends ActiveRecord
{
    public $existingUsername;
    public $existingEmail;
    public $newPassword; // Add the new password attribute





    const SCENARIO_UPDATE = 'update';

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.', 'filter' => function ($query) {
                $query->andWhere(['not', ['id' => Yii::$app->user->id]])->andWhere(['not', ['email' => $this->email]]);
            }],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.', 'filter' => function ($query) {
                $query->andWhere(['not', ['id' => Yii::$app->user->id]])->andWhere(['not', ['username' => $this->username]]);
            }],

            // New rule for the new password field
            ['newPassword', 'string', 'min' => 6], // Adjust the validation rule as needed

            [['username', 'email'], 'required', 'on' => self::SCENARIO_UPDATE],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
        ];
    }

    public static function tableName()
    {
        return 'user';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'email', 'existingEmail'];
        return $scenarios;
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->scenario === self::SCENARIO_UPDATE) {
                $user = User::findOne(Yii::$app->user->id);

                // Check if the username is changed and if it already exists
                if ($this->username !== $user->username && User::find()->where(['username' => $this->username])->exists()) {
                    $this->addError('username', 'This username has already been taken.');
                    return false;
                }

                // Check if the email is changed and if it already exists
                if ($this->email !== $user->email && User::find()->where(['email' => $this->email])->exists()) {
                    $this->addError('email', 'This email address has already been taken.');
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}
