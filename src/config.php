<?php

    /*
    |----------------------------------------------------------------
    | CONFIGURATION
    |----------------------------------------------------------------
    |
    | It only takes a few rules to get the result as needed
    | Create a variable with anonymous object value and 2 
    | keys and values ​​in it as parameters
    |
    |----------------------------------------------------------------
    |
    | 1. "smtp_debug"
    | This value contains a boolean data type, as a production
    | or development environment
    |
    | result    :
    |
    | if true   : $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    | if false  : $mail->SMTPDebug = false;
    |
    |----------------------------------------------------------------
    |
    | 2. "smtp_secure"
    | This value contains a boolean data type, as a security
    | parameter for encrypted communication between the user 
    | and the server
    |
    | result    :
    |
    | if true   : $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    |             $mail->Port       = 465;
    | if false  : $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    |             $mail->Port       = 587;
    |----------------------------------------------------------------
    */

    $smtp   = (object) [
        "smtp_debug"    => false,
        "smtp_secure"   => true,
    ]