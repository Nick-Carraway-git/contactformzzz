<?php
  session_start();
  // Database設定の読み込み
  require('../db_setting.php');
  // PHPMailerと環境設定ファイルの読み込み
  require('../vendor/autoload.php');
  require('../phpmailvars.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  # フォーム画面以外からのアクセスはリダイレクト
  if(!isset($_SESSION['comfirm'])) {
    header('Location: index.php');
    exit();
  }

  # 件名を日本語に置換
  switch($_SESSION['comfirm']['title']) {
    case "1":
      $_SESSION['comfirm']['title'] = 'ご意見';
      break;
    case "2":
      $_SESSION['comfirm']['title'] = 'ご感想';
      break;
    case "3":
      $_SESSION['comfirm']['title'] = 'その他';
      break;
  }

  if(!empty($_POST)) {
    // お問い合わせ送信時にデータベースに登録
    try {
      $statement = $db->prepare('INSERT INTO contactlogs SET title=?, name=?, email=?, tel=?, content=?');
      $statement->execute(array(
        $_SESSION['comfirm']['title'],
        $_SESSION['comfirm']['name'],
        $_SESSION['comfirm']['email'],
        $_SESSION['comfirm']['tel'],
        $_SESSION['comfirm']['content'],
      ));
    } catch (PDOException $e) {
      $_SESSION['db'] = 'データベースの登録に失敗しました。';
    }

    $mailer = new PHPMailer(true);

    // SMTPの設定情報
    try {
      $mailer->CharSet = "iso-2022-jp-ms";
      $mailer->Encoding = "7bit";
      $mailer->IsSMTP();
      $mailer->Host = HOST;
      $mailer->SMTPAuth = true;
      // $mailer->SMTPDebug = 2;
      $mailer->SMTPSecure = "tls";
      $mailer->Port = 587;
      $mailer->Username = USERNAME;
      $mailer->Password = PASSWORD;
      $mailer->setFrom(USERNAME, USERNAME_ALIAS);

      $mailer->AddAddress(USERNAME);
      $mailer->AddAddress($_SESSION['comfirm']['email']);
      $mailer->Subject = mb_encode_mimeheader('お問い合わせを受け付けました。', 'iso-2022-jp-ms');

      $mailer->WordWrap = 70;
      $body = "下記の内容でお問い合わせを受け付けました。\n\n";
      $body .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
      $body .= "お名前：" . $_SESSION['comfirm']['name'] . "\n";
      $body .= "メールアドレス：" . $_SESSION['comfirm']['email'] . "\n";
      $body .= "お電話番号： " . $_SESSION['comfirm']['tel'] . "\n\n" ;
      $body .="＜お問い合わせ内容＞" . "\n" . $_SESSION['comfirm']['content'];
      $mailer->Body = mb_convert_encoding($body, "iso-2022-jp-ms", "utf-8" );

      $mailer->Send();
    } catch (Exception $e) {
      $_SESSION['send'] = 'メールの送信に失敗しました。メールアドレスが正確かご確認ください。';
    }

    /* メール送信が成功した場合に、同時にデータベースにも登録するパターン
    if (!isset($_SESSION['send'])) {
      $statement = $db->prepare('INSERT INTO contactlogs SET title=?, name=?, email=?, tel=?, content=?');
      $statement->execute(array(
        $_SESSION['comfirm']['title'],
        $_SESSION['comfirm']['name'],
        $_SESSION['comfirm']['email'],
        $_SESSION['comfirm']['tel'],
        $_SESSION['comfirm']['content'],
      ));
    }
    */

    header('Location: complete.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Contact Form Comfirm</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="format.css">
  </head>
  <body>
    <div class="container">
      <h1>Check</h1>
      <form method="post">
        <table class="comfirm-table">
          <tr>
            <th>件名</th>
            <td><?php print(htmlspecialchars($_SESSION['comfirm']['title'], ENT_QUOTES)); ?></td>
          </tr>
          <tr>
            <th>名前</th>
            <td><?php print(htmlspecialchars($_SESSION['comfirm']['name'], ENT_QUOTES)); ?></td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td><?php print(htmlspecialchars($_SESSION['comfirm']['email'], ENT_QUOTES)); ?></td>
          </tr>
          <tr>
            <th>電話番号</th>
            <td><?php print(htmlspecialchars($_SESSION['comfirm']['tel'], ENT_QUOTES)); ?></td>
          </tr>
          <tr>
            <th>お問い合わせ内容</th>
            <td><?php print(htmlspecialchars($_SESSION['comfirm']['content'], ENT_QUOTES)); ?></td>
          </tr>
        </table>
        <div><a href="index.php?action=back" class="link">フォームに戻る</a> | <input type="submit" value="送信する"></div>
        <input type="hidden" name="action" value="comfirmed">
      </form>
    </div>
  </body>
</html>
