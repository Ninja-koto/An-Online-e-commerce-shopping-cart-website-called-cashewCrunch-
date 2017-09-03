<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
        if ($_POST['name2'] != "") {
            $_POST['name2'] = filter_var($_POST['name2'], FILTER_SANITIZE_STRING);
            if ($_POST['name2'] == "") {
                $errors .= 'Please enter a valid name.<br/><br/>';
            }
        } else {
            $errors .= 'Please enter your name.<br/>';
        }
 
        if ($_POST['email2'] != "") {
            $email = filter_var($_POST['email2'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors .= "$email is <strong>NOT</strong> a valid email address.<br/><br/>";
            }
        } else {
            $errors .= 'Please enter your email address.<br/>';
        }
 
        if ($_POST['comment_name'] == "") {
            $errors .= 'Enter some content.<br/>';
        } 
        if (!$errors) {
            $mail_to = 'saahil.work@gmail.com';
            $subject = 'New Mail from Cashew Crunch';
            $message  = 'From: ' . $_POST['name2'] . "\n";
            $message .= 'Email: ' . $_POST['email2'] . "\n";
            $message .= "Message:\n" . $_POST['comment_name'] . "\n\n";
            mail($to, $subject, $message);
 
            echo "Thank you for your email!<br/><br/>";
        } else {
            echo '<div style="color: red">' . $errors . '<br/></div>';
        }
    }
    else {
    	echo "shit not set";
    }
?>