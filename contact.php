<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // POSTでのアクセスでない場合
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    // フォームがサブミットされた場合（POST処理）
    // 入力された値を取得する
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // エラーメッセージ・完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    // 空チェック
    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
    }
    
    // エラーなし（全ての項目が入力されている）
    if ($err_msg == '') {
        $to = "	amy-portfolio@ami-k-design.com"; // 管理者のメールアドレス(送信先)
        // Yudaiより下記を追加
        $from = "Amy <" . $email . ">";

        // Yudaiより下記の1行変更
        // $headers = "From: " . $email . "\r\n"
        // Yudaiより下記を追加
        // 下記コメントアウトはコードの説明
            // Content-Type – メール形式
            // Return-Path – 送信先メールアドレスが受け取り不可の場合に、エラー通知のいくメールアドレス
            // From – 送信者の名前（または組織名）とメールアドレス
            // Sender – 送信者の名前（または組織名）とメールアドレス
            // Reply-To – 受け取った人に表示される返信の宛先
            // Organization – 送信者名（または組織名）
            // X-Sender – 送信者のメールアドレス
            // X-Priority – メールの重要度を表す
        $headers = '';
        $header .= "Content-Type: text/plain \r\n";
        $header .= "Return-Path: " . $to . " \r\n";
        $header .= "From: " . $from ." \r\n";
        $header .= "Sender: " . $from ." \r\n";
        $header .= "Reply-To: " . $email . " \r\n";
        $header .= "Organization: " . $name . " \r\n";
        $header .= "X-Sender: " . $email . " \r\n";
        $header .= "X-Priority: 3 \r\n";


        // 本文の最後に名前を追加
        $message .= "\r\n\r\n" . $name;

        // メール送信
        mb_send_mail($to, $subject, $message, $headers);

        // 完了メッセージ
        $complete_msg = "お問い合わせいただき、ありがとうございます！<br>内容を確認し、３営業日以内にメールにて返信させていただきます。";

        // 全てクリア
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amy | Contact お問い合わせ</title>
    <link rel="stylesheet" href="css/ress.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/hamburger.css">
    
    <!-- ファビコン -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  
    <meta name="description" content="">
  
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Shippori+Mincho+B1&family=Waterfall&display=swap" rel="stylesheet">
  
  
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/931c5e739a.js" crossorigin="anonymous"></script>
  
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  </head>
  <body>

  <!-- JSの読み込み -->
  <script src="common.js"></script>
 
   <header id="header" class="fade-up">
     <section class="top-logo">
       <img src="img/amy new logo.png" alt="Amy Brand Strategy & Design">
     </section>
 
     <!-- ハンバーガーメニュー -->
     <div id="hamburger">
       <section>
         <div class="open-line">
           <span></span>
           <span></span>
           <span></span>
         </div>
       </section>
 
       <!--ハンバーガー内のグロナビ-->
       <nav id="nav">
 
         <img src="img/amy new logo.png" alt="Amy Brand Strategy & Design">
 
         <ul>
           <li>
             <a href="index.html" target="_blank" rel="noopener noreferrer">
             <span>TOP PAGE</span></a>
           </li>
 
           <li>
             <a href="profile.html" target="_blank" rel="noopener noreferrer" >
             <span>PROFILE</span></a>
           </li>
             
 
           <li>
             <a href="works.html" target="_blank" rel="noopener noreferrer" >
             <span>WORKS</span></a>
           </li>
         </ul>
 
         <!-- ハンバーガー内コンタクトボタン -->
         <div class="nav-contact-btn">
           <a href="contact.php" target="_blank" rel="noopener noreferrer">
             <span>CONTACT<i class="fas fa-chevron-right fa-xs"></i></span>
           </a>
         </div>
       </nav>
   
     </div>
 
   </header>

  <main id="main">

    <section class="contact main-content">

      <h1>CONTACT</h1>
      <p>お問い合わせ</p>

      <div class="contact-img">
        <img src="img/business-card-pink.png" alt="contact letter image">
    </div>

      <?php if ($err_msg != ''): ?>
          <div class="alert alert-danger">
      <?php echo $err_msg; ?>
          </div>
      <?php endif; ?>

      <?php if ($complete_msg != ''): ?>
          <div class="alert alert-success">
              <?php echo $complete_msg; ?>
          </div>
      <?php endif; ?> 
            
      <form class="form effect-fade" method="post">

        <li>
            <!-- Name -->
          <div class="txt-area">
            <p>お名前</p>
            <input type="text"  name="name"  value="<?php echo $name; ?>">
          </div>
          

          <!-- Email -->
          <div class="txt-area">
            <p>メールアドレス</p>
            <input type="text"  name="email"  value="<?php echo $email; ?>">
          </div>
          

          <!-- Subject -->
          <div class="txt-area">
            <p>件名</p>
            <input type="text"  name="subject" value="<?php echo $subject; ?>">
          </div>
          

          <!-- Content -->
          <div class="txt-area">
            <p>お問い合わせ内容</p>
          <textarea  name="message" rows="5" ><?php echo $subject; ?></textarea>
          </div>
          

          <div class="sent-btn">
            <button type="submit">送信</button>
          </div>
          

        </li>

      </form> 

    </section>

  </main>

  <footer id="footer">

    <section class="flex">
      <li>
        <img src="img/amy new logo white.png" alt="amy">
      </li>
      
      <li class="txt">
        <div><a href="profile.html" target="_blank" rel="noopener noreferrer" >
        <span>PROFILE</span></a></div>
        
        <div><a href="works.html" target="_blank" rel="noopener noreferrer" >
        <span>WORKS</span></a></div>
        
        <div><a href="contact.php" target="_blank" rel="noopener noreferrer" >
        <span>CONTACT</span></a></div>
        
      </li>

      <li class="sns-btn">

        <a href="https://twitter.com/amy__design" target="_blank" rel="noopener noreferrer" class="sns-insta"><i class="fab fa-twitter"></i></a>
      
        <a href="https://pin.it/13iUtXH" target="_blank" rel="noopener noreferrer" class="sns-pinterest"><i class="fab fa-pinterest"></i></a>

        <a href="https://www.wantedly.com/id/Amii_kubo" target="_blank" rel="noopener noreferrer" class="sns-wantedly"><img src="img/logo-wantedly.png" alt=""></a>

        <p>These are my inspo.<br>Plz Check up!</p>
        
      </li>
    </section>

    <section class="copy-right">
      <p>©︎ 2022 | Ami Kubo All Rights Reserved.</p>
    </section>


  </footer>
  
</body>
</html>