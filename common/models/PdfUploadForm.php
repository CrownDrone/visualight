<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

class PdfUploadForm extends Model
{
    public $pdfFile; // This should match the name attribute in your file input field in the form
    public $selectedRole; // Add the selectedRole property

    public function rules()
    {
        return [
            [['pdfFile', 'selectedRole'], 'required'], // Make sure to add selectedRole to the required rule
            [['pdfFile'], 'file', 'extensions' => 'pdf', 'maxFiles' => 10], // Allow up to 10 PDF files
        ];
    }
    
    public function getRolesList()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
    }

    
}


