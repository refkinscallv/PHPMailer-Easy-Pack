<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '/core/PHPMailer/src/Exception.php';
    require '/core/PHPMailer/src/PHPMailer.php';
    require '/core/PHPMailer/src/SMTP.php';

    function send_mail($data){
        global $smtp;

        // Parameter Single Value Separation
        $sender     = explode("|", $data->sender->email);
        $receiver   = explode("|", $data->receiver->email);
        $replyto    = explode("|", $data->reply->email);

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            if($smtp->smtp_debug){
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
            } else {
                $mail->SMTPDebug = false;                               //Enable verbose debug output
            }

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $data->access->host;                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $data->access->user;                    //SMTP username
            $mail->Password   = $data->access->pass;                    //SMTP password

            if($smtp->smtp_secure){
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Encryption
                $mail->Port       = 465;                                //TCP Port
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     //Encryption
                $mail->Port       = 587;                                //TCP Port
            }

            //Recipients
            if($sender[1] != 0 || $sender[1] != "0" || $sender[1] != ""){
                $mail->setFrom($sender[0], $sender[1]);                 //Add a sender
            } else {
                $mail->setFrom($sender[0]);                             //Add a sender
            }

            if($receiver[1] != 0 || $receiver[1] != "0" || $receiver[1] != ""){
                $mail->addAddress($receiver[0], $receiver[1]);          //Add a receiver
            } else {
                $mail->addAddress($receiver[0]);                        //Add a receiver
            }

            if($replyto[1] != 0 || $replyto[1] != "0" || $replyto[1] != ""){
                $mail->addReplyTo($replyto[0], $replyto[1]);            //Add a reply recipient
            } else {
                $mail->addReplyTo($replyto[0]);                         //Add a reply recipient
            }

            if($data->cc->status){
                if(is_array($data->cc->email)){
                    foreach($data->cc->email as $cc_row){
                        $cc = explode("|", $cc_row);
                        if($cc[1] == 0 || $cc[1] == "0" || $cc[1] == ""){
                            $mail->addCC($cc[0]);
                        } else {
                            $mail->addCC($cc[0], $cc[1]);
                        }
                    }
                } else {
                    $cc = explode("|", $data->cc->email);
                    if($cc[1] == 0 || $cc[1] == "0" || $cc[1] == ""){
                        $mail->addCC($cc[0]);
                    } else {
                        $mail->addCC($cc[0], $cc[1]);
                    }
                }
            }

            if($data->bcc->status){
                if(is_array($data->bcc->email)){
                    foreach($data->bcc->email as $bcc_row){
                        $bcc = explode("|", $bcc_row);
                        if($bcc[1] == 0 || $bcc[1] == "0" || $bcc[1] == ""){
                            $mail->addBCC($bcc[0]);
                        } else {
                            $mail->addBCC($bcc[0], $bcc[1])
                        }
                    }
                } else {
                    $bcc = explode("|", $data->bcc->email);
                    if($bcc[1] == 0 || $bcc[1] == "0" || $bcc[1] == ""){
                        $mail->addBCC($bcc[0]);
                    } else {
                        $mail->addBCC($bcc[0], $bcc[1]);
                    }
                }
            }

            //Attachments
            if($data->attachment->status){
                if(is_array($data->attachment->file)){
                    foreach($data->attachment->file as $file_row){
                        $file   = explode("|", $file_row);
                        if($file[1] == 0 || $file[1] == "0" || $file[1] == ""){
                            $mail->addAttachment($file[0]);
                        } else {
                            $mail->addAttachment($file[0], $file[1]);
                        }
                    }
                } else {
                    $file   = explode("|", $data->attachment->file);
                    if($file[1] == 0 || $file[1] == "0" || $file[1] == ""){
                        $mail->addAttachment($file[0]);
                    } else {
                        $mail->addAttachment($file[0], $file[1]);
                    }
                }
            }

            //Content
            if($data->content->html){
                $mail->isHTML(true);                                    //Set email format to HTML
            } else {
                $mail->isHTML(false);                                   //Set email format to HTML
            }

            $mail->Subject = $data->content->subject;
            $mail->Body    = $data->content->bodyHTML;
            $mail->AltBody = ($data->content->bodyText)? $data->content->bodyText : "This is the body in plain text for non-HTML mail clients";

            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;

            // Optional with error output
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }