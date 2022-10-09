# PHPMailer Easy Pack

Is a helper for **PHPMailer**, Makes it easy to use **PHPMailer** to send emails and quick installation

Official source for **PHPMailer** : [PHPMailer](https://github.com/PHPMailer/PHPMailer)

## Need to know

There are no modifications to the main PHPMailer system and it is open source.

## Requirements
- PHP 7 or Above (Default Installation)

## Quick Install (Manual)
- Download Source
- Change the call file according to the specific folder location, as follows :
- Open `utility.php` file in folder `src/utility.php`
- Change the `path/to/folder` below to the PHPMailer library folder that you placed
```PHP
<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'path/to/folder/PHPMailer/src/Exception.php';
    require 'path/to/folder/PHPMailer/src/PHPMailer.php';
    require 'path/to/folder/PHPMailer/src/SMTP.php';
```
- And final, call `run.php` file in folder `src/run.php` and put it in the file you want to use the syntax later
- Done