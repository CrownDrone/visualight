<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PdfUploadForm extends Model
{
    public $pdfFile; // This should match the name attribute in your file input field in the form

    public function rules()
    {
        return [
            [['pdfFile'], 'file', 'extensions' => 'pdf'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $uploadPath = 'C:/xampp/htdocs/visualight/common/temp_pdf'; // Absolute path to the upload directory
    
            // Get the original client-side filename
            $originalFileName = $this->pdfFile->name;
    
            // Generate a unique filename by appending a timestamp
            $fileName = time() . '_' .$originalFileName;
    
            if ($this->pdfFile->saveAs($uploadPath . '/' . $fileName)) {
                // File uploaded successfully
    
                // Get the list of users with the "TOP MANAGEMENT" role
                $topManagers = Yii::$app->authManager->getUserIdsByRole('TOP MANAGEMENT');
    
                foreach ($topManagers as $managerId) {
                    $user = User::findOne($managerId); // Replace 'User' with your user model
                    if ($user) {
                        // Create an email message
                        $message = Yii::$app->mailer->compose()
                            ->setFrom([Yii::$app->params['adminEmail'] => 'Visualight Team'])
                            ->setTo($user->email) // Set recipient email address
                            ->setSubject('PDF Dashboard for Top Management')
                            ->setTextBody('Please find attached the PDF file.')
                            ->attach($uploadPath . '/' . $fileName); // Attach the uploaded PDF file
    
                        // Send the email
                        if ($message->send()) {
                            // Email sent successfully
                            // You can add additional logic here if needed
                        } else {
                            // Error while sending email
                            // Handle the error as needed
                        }
                    }
                }
    
                return true;
            } else {
                // Error while uploading the file
                return false;
            }
        } else {
            // Model validation failed
            return false;
        }
    }
    
    
    
    
}

