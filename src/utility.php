<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'core/PHPMailer/src/Exception.php';
    require 'core/PHPMailer/src/PHPMailer.php';
    require 'core/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
                                
    try {
        //Configurations
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = $eml->host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $eml->email;
        $mail->Password   = $eml->pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->Port       = 587;

        //Recipients
        $mail->setFrom($eml->email, $app->name);
        // $mail->addAddress('joe@example.net', 'Joe User');
        $mail->addAddress($email);
        $mail->addReplyTo("no-reply@gmail.com");
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        /*
        $mail->addAttachment('/var/tmp/file.tar.gz');
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
        */

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Verifikasi Email - '. $app->name;
        $mail->Body    = '
        <p><b>Hore! pendataran akun '. $app->name .' kamu berhasil</b></p>
        Cukup satu langkah lagi untuk mulai mengakses akun kamu dan menikmati layannya.<br />
        Verifikasi terlebih dahulu email kamu agar tetap aman.<br />
        <p style="margin:auto auto 20px auto">Salin 6 digit kode verifikasi dibawah ini, dihalaman verifikasi setelah kamu masuk akun</p>
        <b>Kode Verifikasi : <font color="red">'. $code_verify .'</font></b>
        <p style="margin:20px auto auto auto">Jika kamu tidak merasa melakukan pendaftaran dengan email ini, segera hapus pesan ini!</p>
        <p style="margin:auto auto 20px auto">Selamat datang '. $username .', selamat bergabung bersama kami</p>
        Untuk informasi lainnya hubungi kami melalui whatsapp : <a href="https://api.whatsapp.com/send?phone='. $app->whatsapp .'" target="_blank">+'. $app->whatsapp .'</a>
        <br />
        <b>&copy; '. $app->name .' '. date("Y");
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        query("INSERT INTO user_verification 
        (verification_date,user_token,email,code_verif) 
        VALUES ('$tanggal','$token','$email','$code_verify')");

        redirect("/member/masuk?alert=1-reg8");
    } catch (Exception $e) {
        redirect("/member/daftar?alert=0-reg9");
    }