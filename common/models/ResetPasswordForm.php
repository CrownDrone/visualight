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
            [['newPassword', 'password_repeat'], 'string', 'min' => 8],
            ['password_repeat', 'compare', 'compareAttribute' => 'newPassword'],
            ['newPassword', 'validatePasswordComplexity'],

        ];
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

    
}
