<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("phpmailer/PHPMailerAutoload.php");

class Send_Mail {
    public $host;
    public $SMTPAuth;
    public $username;
    public $password;
    public $SMTPSecure;
    public $port;

    function __construct() {
        $this->host = 'smtp.gmail.com'; //actual value removed removed
        $this->SMTPAuth = true;
        $this->username = 'dundifference@dunmore.com'; //actual value removed removed
        $this->password = 'Fg;lkszdfpodckzsdj1323472039@)*&$)@($*LSKDRJFGASRIOEFJ'; //actual value removed removed
        $this->SMTPSecure = "tls";
        $this->port = 587;
    }
    
    public function Password_Reset ($username, $email, $temp_key) {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->port; 
        $mail->isHTML(true);
        
        $mail->setFrom('dunDifferenct@Dunmore.com', 'Dunmore Difference Mail');
        $mail->addAddress($email);     // recipient

        $mail->Subject = 'Password Reset';
        $mail->Body    = 'A password reset has been requested. Use the following link to create a new password.<br><br>https://www.dunmore.com/dunDifference/new_password.php?username='.$username.'&token='.$temp_key.'<br><br>Token: '.$temp_key;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    public function Manager_needs_approval ($mail_info) {
        $mail = new PHPMailer;
        //$row['first_name'], $row['last_name'], $row_give['first_name'], $row_give['last_name'], $appRow['description'], $manager->email_address
        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->port;
        $mail->isHTML(true);

        $mail->setFrom('dundifference@dunmore.com', 'The Dunmore Difference');
        $mail->addAddress($mail_info[5]);

        $mail->Subject = 'Recognition approval for '.$mail_info[0]. ' ' .$mail_info[1];
        $mail->Body    = $mail_info[0].' got an appreciation from '.$mail_info[2].' '.$mail_info[3]. '<br>Description: '.$mail_info[4]
        . "<br><br><br><br> <a href='https://www.dunmore.com/dunDifference/admin/approval_management.php'>Awaiting your approval</a>";

        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    public function recieve_appreciation ($mail_info) {
        //array is rec first name, rec last name, rec email, giver first name, giver last name, giver email, category, description, point value
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->port; 
        $mail->isHTML(true);
        
        $mail->setFrom('dundifference@dunmore.com', 'The Dunmore Difference');
        $mail->addAddress($mail_info[2]);

        $mail->Subject = 'You have been recognized for '.$mail_info[6].'!';
        $mail->Body    = $mail_info[0].', you got an appreciation from '.$mail_info[3].' '.$mail_info[4].' for '.'!<br><br><br><br>Description: '.$mail_info[7];
        "<br><br><br><br><a href='https://www.dunmore.com/dunDifference/main.php'>View Recognitions</a>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
    
    public function self_reward ($mail_info) {
        //array is rec first name, rec last name, rec email, giver first name, giver last name, giver email, category, description, point value
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->port; 
        $mail->isHTML(true);
        
        $mail->setFrom('dundifference@dunmore.com', 'The Dunmore Difference');
        $mail->addAddress($mail_info[2]);

        $mail->Subject = 'Your Reward has been Approved!';
        $mail->Body    = $mail_info[0].', you reward for '.$mail_info['6'].' has been approved!<br><br>Point Value: '.$mail_info[8].'<br><br>Description: '.$mail_info[7];
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
    
    public function appreciation_approved ($mail_info) {
        //array is rec first name, rec last name, rec email, giver first name, giver last name, giver email, category, description, point value, manager first name, manager last name, manager email
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->port; 
        $mail->isHTML(true);
        
        $mail->setFrom('dundifference@dunmore.com', 'The Dunmore Difference');
        $mail->addAddress($mail_info[5]);

        $mail->Subject = 'Your Appreciation has been Approved!';
        $mail->Body    = 'The appreciation you gave to '.$mail_info[0].' '.$mail_info[1].' for '.$mail_info[6].' has been approved!<br><br>Point Value: '.$mail_info[8].'<br><br>Description: '.$mail_info[7];
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    public function appreciation_approved_manager ($mail_info) {
        //array is rec first name, rec last name, rec email, giver first name, giver last name, giver email, category, description, point value, manager first name, manager last name, manager email
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->port; 
        $mail->isHTML(true);
        
        $mail->setFrom('dundifference@dunmore.com', 'The Dunmore Difference');
        $mail->addAddress($mail_info[11]);

        $mail->Subject = 'Your Direct Report Got Appreciated!';
        $mail->Body    = 'Your direct report '.$mail_info[0].' '.$mail_info[1].' was appreciated for '.$mail_info[6].'!<br><br>Description: '.$mail_info[7];
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
    
    public function appreciation_denied ($mail_info, $decline_desc) {
        //array is rec first name, rec last name, rec email, giver first name, giver last name, giver email, category, description, point value, manager first name, manager last name, manager email
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->port; 
        $mail->isHTML(true);
        
        $mail->setFrom('dundifference@dunmore.com', 'The Dunmore Difference');
        $mail->addAddress($mail_info[5]);

        $mail->Subject = 'Your appreciation has been denied';
        $mail->Body    = 'The appreciation you gave to '.$mail_info[0].' '.$mail_info[1].' for '.$mail_info[6].' has been denied!<br><br>Reason for Decline: '.$decline_desc.'<br><br>Point Value: '.$mail_info[8].'<br><br>Description: '.$mail_info[7];
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

}