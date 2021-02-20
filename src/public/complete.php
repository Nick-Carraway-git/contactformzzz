<?php
  session_start();
  require('../db_setting.php');

  if(!isset($_SESSION['comfirm'])) {
    header('Location: index.php');
    exit();
  }

  $logs = $db->query('SELECT * from contactlogs');
  unset($_SESSION['comfirm']);
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
      <table border="1" cellpadding="5">
        <tr>
          <th>件名</th>
          <th>名前</th>
          <th>メールアドレス</th>
          <th>電話番号</th>
          <th>お問い合わせ内容</th>
        </tr>
        <?php foreach($logs as $log): ?>
          <tr>
            <td nowrap><?php print($log['title']); ?></td>
            <td nowrap><?php print($log['name']); ?></td>
            <td nowrap><?php print($log['email']); ?></td>
            <td nowrap><?php print($log['tel']); ?></td>
            <td nowrap><?php print($log['content']); ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </body>
</html>
