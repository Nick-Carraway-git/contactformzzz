<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// PHPMailerと環境設定ファイルの読み込み
require '../vendor/autoload.php';
require '../phpmailvars.php';

$mailer = new PHPMailer(true);

// SMTPの設定情報
try {
  $mailer->CharSet = "iso-2022-jp-ms";
  $mailer->Encoding = "7bit";
  $mailer->IsSMTP();
  $mailer->Host = HOST;
  $mailer->SMTPAuth = true;
  $mailer->SMTPDebug = 2;
  $mailer->SMTPSecure = "tls";
  $mailer->Port = 587;
  $mailer->Username = USERNAME;
  $mailer->Password = PASSWORD;
  $mailer->setFrom(USERNAME, USERNAME_ALIAS);
  $mailer->AddAddress(USERNAME);
  $mailer->AddAddress($_SESSION['comfirm']['email']);

  $mailer->Subject = mb_encode_mimeheader('お問い合わせを受け付けました。', 'iso-2022-jp-ms');
  $mailer->Body    = mb_convert_encoding($_SESSION['comfirm']['content'], "iso-2022-jp-ms", "utf-8" );

  $mailer->Send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
