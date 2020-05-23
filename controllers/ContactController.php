<?php

class ContactController
{
    
    public function actionIndex()
    {
        $adminMail = 'webmaster@web.com';
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
        $result = false;
        
        // Processing Form
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            
        $errors = [];
        
        // Validate Form
        if (!User::checkFirstName($name)) {
            $errors[] = 'Wrong name';
        }
        
        $message = "Name: {$name} <br> Email: {$email} <br> Message: {$message}";
        
        $result = mail($adminMail, $subject, $message);
        
        }
        
        require_once(ROOT . '/views/contact/index.php');
        return true;
    }
}

