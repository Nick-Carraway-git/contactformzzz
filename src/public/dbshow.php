<?php
require('../db_setting.php');
// 問い合わせから最新の20件を表示
$logs = $db->query('SELECT * from contactlogs ORDER BY id DESC LIMIT 20');
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Database</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="format.css">
  </head>
  <body>
    <div class="container">
      <h1>Database</h1>
      <div class="db-message">
        <p>最新20件のお問い合わせを表示しています。</p>
      </div>
      <table class="db-table">
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
