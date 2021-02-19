<?php
  require('../db_setting.php');
  $logs = $db->query('SELECT * from contactlogs');
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
    <?php foreach($logs as $log): ?>
      <p><?php print($log['name']); ?></p>
    <?php endforeach; ?>
  </body>
</html>
