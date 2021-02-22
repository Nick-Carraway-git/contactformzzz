# お問い合わせフォーム

## 開発環境
- **言語**
  - PHP, HTML5, CSS, SQL
- **仮想化環境**
  - Docker
  - PHPコンテナとnginxコンテナでは、Alpineベースイメージを使用
- **データベース**
  - MySQL
- **メール送信関連**
  - PHPMailer, maildev(メール送信テストに使用)
- **その他の利用ツール**
  - Git Github

## 実装時間  
- **約20時間**

## データベースの出力ファイル  
- **backup.sql**

## 実装中に問題となったこと・工夫したところ
- **問題となったこと**
  1. 仮想化環境の構築において、これまで学習してきたRubyとは異なる箇所が多数あったこと。
  2. メール送信機能の実装において、mail()等を用いたシンプルな送信がうまくいかなかったこと。
- **工夫したところ(問題の解決)**
  1. 公式のリファレンスや様々なサイトを調べ、基本的な環境構築ができるようになったこと。
  2. 他の方法に関する事柄(SMTPの仕様など)の学習や、PHPMailerを利用するなどして、機能を実装したこと。

## 改善点
- **フォームのValidationが甘い点**  
  -> 正規表現を学習し、漏れのない制約を記述できるように取り組みます。

- **メール送信に関する知識が乏しい点**  
  -> 暗号化の方法やセキュリティプロトコルなど、理解が不十分な点の学習に努めます。

- **構成の不備や好ましくない記述の修正などで、二度手間が発生した点**  
  -> ある程度先を見通してから着手するように意識します。

## 動作テスト
- **正常系と異常系を意識したテスト**  
  Validationが機能しているか、メール送信やデータベースへの登録の処理とそれに合わせたメッセージなど   
  想定される動作が正常だった場合と異常だった場合を意識し、ブラウザ上で手動にて動作テストを行いました。

## 参考資料または参考サイト  

様々ありますが、とりわけ参考させていただいたものは下記になります。

- **PHP学習関係**  
  PHP入門
  https://www.javadrive.jp/php/  

- **Docker関係**  
  公式リファレンス各種  
  DockerによるPHP環境構築
  https://qiita.com/nemui_/items/f911be7ffa4f29293fd5

- **メール送信関係**  
  DockerでPHP-alpineのメール配信テスト
  https://qiita.com/idani/items/e703b8810db219bd57fa  
  「SMTP」って何？
  https://dime.jp/genre/684264/

## 使い方
1. **Dockerをインストールし、プロジェクトをクローンしてください。**  
   git clone -b development https://github.com/Nick-Carraway-git/contactformzzz

2. **contactformzzz/src/phpmailvarsを下記の様に編集してください。**  
   define('HOST', 'tls://smtp.gmail.com'); <-SMTPサーバー(サンプルはGmail)  
   define('USERNAME', ''); <-管理者のメールアドレス  
   define('USERNAME_ALIAS', 'Master');  
   define('PASSWORD', ''); <-管理者のパスワード  

3. **contactformzzzでコンテナを起動し、localhostに接続**  
   docker-composer up -d
