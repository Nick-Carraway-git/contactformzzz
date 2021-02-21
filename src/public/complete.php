<?php
  session_start();
  require('../db_setting.php');

  if(!isset($_SESSION['comfirm'])) {
    header('Location: index.php');
    exit();
  }

  if(isset($_SESSION['send'])) $send_error = $_SESSION['send'];
  $logs = $db->query('SELECT * from contactlogs');

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
      <p>
        <?php if(isset($send_error)) print($send_error); ?>
      </p>
      <table class="complete-table">
        <tr>
          <th class="th-common title-cell">件名</th>
          <th class="th-common name-cell">名前</th>
          <th class="th-common email-cell">メールアドレス</th>
          <th class="th-common tel-cell">電話番号</th>
          <th class="th-common content-cell">お問い合わせ内容</th>
        </tr>
        <?php foreach($logs as $log): ?>
          <tr>
            <td><p class="td-common"><?php print($log['title']); ?></p></td>
            <td><p class="td-common"><?php print($log['name']); ?></p></td>
            <td><p class="td-common"><?php print($log['email']); ?></p></td>
            <td><p class="td-common"><?php print($log['tel']); ?></p></td>
            <td><p class="td-common"><?php print($log['content']); ?></p></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </body>
</html>
