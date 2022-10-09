<?php

    require "src/run.php";

    $data   = (object) [
        "access"        => (object) [
                                        "host"  => "smtp.sample.com",
                                        "user"  => "user@sample.com",
                                        "pass"  => "Secret123@"
                                    ],
        "sender"        => (object) ["email" => "user@sample.com|Jhon"],
        "receiver"      => (object) ["email" => "recipient@sample.com|Alex"],
        "replyto"       => (object) ["email" => "cs.user@sample.com|CS Jhon"],
        "cc"            => (object) [
                                        "status"    => true,
                                        // if 'status' false, no need to include the value below
                                        "email"     => array(
                                            "ccto1@simple.com|mr.cc1",
                                            "ccto2@simple.com|mr.cc2",
                                            "ccto3@simple.com|mr.cc3"
                                        )
                                    ],
        "bcc"           => (object) [
                                        "status"    => true,
                                        // if 'status' false, no need to include the value below
                                        "email"     => array(
                                            "bccto1@simple.com|mr.bcc1",
                                            "bccto2@simple.com|mr.bcc2",
                                            "bccto3@simple.com|mr.bcc3"
                                        )
                                    ],
        "attachment"    => (object) [
                                        "status"    => true,
                                        // if 'status' false, no need to include the value below
                                        "file"      => array(
                                            "path/to/fil1.ext|File 1",
                                            "path/to/fil2.ext|File 2",
                                            "path/to/fil3.ext|File 3"
                                        )
                                    ],
        "content"       => (object) [
                                        "html"      => true,
                                        "subject"   => "Subject",
                                        "body"      => "Say hi to PHPMailer Esay Pack",
                                        "bodyAlt"   => false
                                    ]
    ];

    $send_mail  = send_mail($data);

    if($send_mail){
        // Do Something When TRUE
    } else {
        // Do Something When FALSE
    }