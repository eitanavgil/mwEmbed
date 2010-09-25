<?php
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "papyromancer@gmail.com";
    $email_subject = "An OVA submission needs to be described in the kmc";
    $message = $_POST['message']; // required
    // create email headers
    $headers = 'From: '.'ovasubmit@openvideoalliance.org'."\r\n".
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $message, $headers);  
?>
