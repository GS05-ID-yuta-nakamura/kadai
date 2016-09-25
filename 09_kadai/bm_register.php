<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>登録</title>
</head>
<body>

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
          <div class="navbar-brand">ユーザー登録</div>
          <a class="navbar-brand" href="bm_login.php">ログイン画面</a>
      </div>
    </div>
  </nav>
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="bm_register_insert.php" method="post">
name:<input type="text" name="name" /><br>
ID:<input type="text" name="lid" /><br>
PW:<input type="password" name="lpw" />
<input type="submit" value="登録" />
</form>


</body>
</html>