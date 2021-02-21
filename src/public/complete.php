<?php
  session_start();
  require('../db_setting.php');

  if(!isset($_SESSION['comfirm'])) {
    header('Location: index.php');
    exit();
  }

  // メール送信に失敗した場合のメッセージを変数に格納
  if(isset($_SESSION['send'])) $send_error = $_SESSION['send'];
  // 問い合わせから最新の20件を表示
  $logs = $db->query('SELECT * from contactlogs ORDER BY id DESC LIMIT 20');

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
        <p>最新20件のお問い合わせを表示しています。</p>
      </div>
      <table class="complete-table">
        <tr>
          <th class="title-cell">件名</th>
          <th class="name-cell">名前</th>
          <th class="email-cell">メールアドレス</th>
          <th class="tel-cell">電話番号</th>
          <th class="content-cell">お問い合わせ内容</th>
        </tr>
        <?php foreach($logs as $log): ?>
          <tr>
            <td><p><?php print($log['title']); ?></p></td>
            <td><p><?php print($log['name']); ?></p></td>
            <td><p><?php print($log['email']); ?></p></td>
            <td><p><?php print($log['tel']); ?></p></td>
            <td><p><?php print($log['content']); ?></p></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </body>
</html>
