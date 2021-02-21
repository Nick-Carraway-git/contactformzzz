<?php
  session_start();
  require('../db_setting.php');

  if(!isset($_SESSION['comfirm'])) {
    header('Location: index.php');
    exit();
  }

  // メール送信に失敗した場合のメッセージを変数に格納
  if(isset($_SESSION['send'])) $send_error = $_SESSION['send'];

  // SESSION変数の割り当てを解除
  unset($_SESSION['comfirm']);
  unset($_SESSION['send']);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Contact Form Complete</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="format.css">
  </head>
  <body>
    <div class="container">
      <h1>Result</h1>
      <div class="complete-message">
        <?php if(isset($send_error)): ?>
          <p><?php print($send_error); ?></p>
        <?php else: ?>
          <p>メールの送信とデータベースの登録に成功しました。</p>
        <?php endif; ?>
      </div>
      <a href="index.php" class="link">フォームへ戻る</a>
    </div>
  </body>
</html>
