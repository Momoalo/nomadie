
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>パスワード再発行　</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>
<?php require "include/header.php"; ?>

<body>
    <div class="container">
      <?php if (isset($err['msg'])) : ?>
        <p class="error"><?php echo $err['msg']; ?></p>
      <?php endif; ?>

      <form action="forgot_pass.php" method="POST">
        <div class="forgot_box">
          <label for="mail">メールアドレス</label>
            <input type="text" name="email">
        </div>
            <?php if (isset($err['email'])) : ?>
              <p class="error"><?php echo $err['email']; ?></p>
            <?php endif; ?>
        <button type="submit">再発行</button><br>
      </form>
    </div>

  <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>"/>

  <?php require "include/header.php"; ?>
</body>
</html>
