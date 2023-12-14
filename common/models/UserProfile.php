<?php
// common/models/UserProfile.php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;

class UserProfile extends ActiveRecord
{
    public $existingUsername;
    public $existingEmail;
    public $newPassword; // Add the new password attribute

    public $existingPassword;

    public $imageFile; // Add this property to hold the uploaded image file



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
            ['newPassword', 'string', 'min' => 8],
            ['newPassword', 'validatePasswordComplexity'],

            [['username', 'email'], 'required', 'on' => self::SCENARIO_UPDATE],

            ['existingPassword', 'validateExistingPassword', 'on' => self::SCENARIO_UPDATE],

            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],

            [['contactNumber'], 'integer', 'message' => 'Contact Number must be a number'],
            [['contactNumber'], 'string', 'on' => self::SCENARIO_UPDATE],


        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'newPassword' => 'New Password',
        ];
    }


    public function validateExistingPassword($attribute, $params)
    {
        // Find the current user model by the ID of the logged-in user
        $user = User::findOne(Yii::$app->user->id);

        // Check if the entered existing password matches the current password
        if (!$user->validatePassword($this->existingPassword)) {
            $this->addError($attribute, 'Existing password doesn\'t match.');
        }
    }


    public function validatePasswordComplexity($attribute, $params)
    {
        // Regular expression to check if the password contains special characters
        $specialCharacterRegex = '/[!@#$%^&*()\-_=+{};:,<.>]/';
        // Regular expression to check for uppercase letters
        $uppercaseRegex = '/[A-Z]/';
        // Regular expression to check for lowercase letters
        $lowercaseRegex = '/[a-z]/';
        // Regular expression to check for numbers
        $numberRegex = '/\d/';
    
        // Check if the password is set
        if (!empty($this->$attribute)) {
            // Check for special characters
            if (!preg_match($specialCharacterRegex, $this->$attribute)) {
                $this->addError($attribute, 'Password must contain special characters.');
            }
    
            // Check for uppercase letters
            if (!preg_match($uppercaseRegex, $this->$attribute)) {
                $this->addError($attribute, 'Password must contain at least one uppercase letter.');
            }
    
            // Check for lowercase letters
            if (!preg_match($lowercaseRegex, $this->$attribute)) {
                $this->addError($attribute, 'Password must contain at least one lowercase letter.');
            }
    
            // Check for numbers
            if (!preg_match($numberRegex, $this->$attribute)) {
                $this->addError($attribute, 'Password must contain at least one number.');
            }
    
            // Check for minimum length (8 characters)
            if (strlen($this->$attribute) < 8) {
                $this->addError($attribute, 'Password must be at least 8 characters long.');
            }
        }
    }


    public static function tableName()
    {
        return 'user';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'email', 'existingEmail','newPassword','existingPassword'];
        $scenarios[self::SCENARIO_UPDATE][] = 'contactNumber';
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
