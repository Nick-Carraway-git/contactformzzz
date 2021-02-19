<?php
  session_start();
  require('../db_setting.php');

  if(!isset($_SESSION['comfirm'])) {
    header('Location: index.php');
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
    <form action="" method="post">
      <table>
        <tr>
          <th align="left">件名</th>
          <td><?php print(htmlspecialchars($_SESSION['comfirm']['title'], ENT_QUOTES)); ?></td>
        </tr>
        <tr>
          <th align="left">名前</th>
          <td><?php print(htmlspecialchars($_SESSION['comfirm']['name'], ENT_QUOTES)); ?></td>
        </tr>
        <tr>
          <th align="left">メールアドレス</th>
          <td><?php print(htmlspecialchars($_SESSION['comfirm']['email'], ENT_QUOTES)); ?></td>
        </tr>
        <tr>
          <th align="left">電話番号</th>
          <td><?php print(htmlspecialchars($_SESSION['comfirm']['tel'], ENT_QUOTES)); ?></td>
        </tr>
        <tr>
          <th align="left">お問い合わせ内容</th>
          <td><?php print(htmlspecialchars($_SESSION['comfirm']['content'], ENT_QUOTES)); ?></td>
        </tr>
      </table>
      <div><a href="index.php?action=back">フォームに戻る</a> | <input type="submit" value="送信する"></div>
      <input type="hidden" name="action" value="comfirmed">
    </form>
  </body>
</html>
