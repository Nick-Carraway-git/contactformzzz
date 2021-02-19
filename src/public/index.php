<?php
  session_start();

  if(!empty($_POST)) {
    if(empty($_POST['title'])) $error['title'] = 'blank';
    if(empty($_POST['name'])) $error['name'] = 'blank';
    if(empty($_POST['email'])) $error['email'] = 'blank';
    if(empty($_POST['tel'])) $error['tel_blank'] = 'blank';
    if(!filter_input(INPUT_POST, 'tel' ,FILTER_VALIDATE_INT)) $error['tel_nonum'] = 'nonum';
    if(empty($_POST['content'])) $error['content'] = 'blank';

    if(empty($error)) {
      $_SESSION['comfirm'] = $_POST;
      header('Location: comfirm.php');
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Contact Form Input</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="format.css">
  </head>
  <body>
    <div class="container">
      <h1>Contact Form</h1>
      <form action="" method="post">
        <div class="parts">
          <label for="title">件名</label><span>※必須</span>
          <select class="" id="title" name="title" required>
            <option disabled selected value="">選択して下さい</option>
            <option value="1">ご意見</option>
            <option value="2">ご感想</option>
            <option value="3">その他</option>
          </select>
          <?php if(isset($error['content'])): ?>
            <p class="error">件名を選択して下さい。</p>
          <?php endif; ?>
        </div>
        <div class="parts">
          <label for="name">名前<span>※必須</span></label>
          <input type="text" class="" id="name" name="name" placeholder="名前"
                 value="<?php if(isset($_POST['name'])) print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>" required>
          <?php if(isset($error['name'])): ?>
            <p class="error">名前を入力して下さい。</p>
          <?php endif; ?>
        </div>
        <div class="parts">
          <label for="email">メールアドレス<span>※必須</span></label>
          <input type="email" class="" id="email" name="email" placeholder="メールアドレス"
                 value="<?php if(isset($_POST['email'])) print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>" required>
          <?php if(isset($error['email'])): ?>
            <p class="error">メールアドレスを入力して下さい。</p>
          <?php endif; ?>
        </div>
        <div class="parts">
          <label for="tel">電話番号<span>※必須</span></label>
          <input type="tel" class="" id="tel" name="tel" placeholder="電話番号"
                 value="<?php if(isset($_POST['tel'])) print(htmlspecialchars($_POST['tel'], ENT_QUOTES)); ?>" required>
          <?php if(isset($error['tel_blank']) && $error['tel_blank'] == 'blank'): ?>
            <p class="error">電話番号を入力して下さい。</p>
          <?php endif; ?>
          <?php if(isset($error['tel_nonum']) && $error['tel_nonum'] == 'nonum'): ?>
            <p class="error">電話番号は数字(ハイフンなし)で入力してください。</p>
          <?php endif; ?>
        </div>
        <div class="parts">
          <label for="content">お問い合わせ内容<span>※必須</span></label>
          <textarea class="" id="content" name="content" placeholder="お問い合わせ内容" rows="4" required><?php if(isset($_POST['content']))
                    print(htmlspecialchars($_POST['content'], ENT_QUOTES)); ?></textarea>
          <?php if(isset($error['content'])): ?>
            <p class="error">お問い合わせ内容を入力して下さい。</p>
          <?php endif; ?>
        </div>
        <div><input type="submit" value="確認画面" /></div>
      </form>
    </div>
  </body>
</html>
