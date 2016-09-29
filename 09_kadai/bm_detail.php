<?php
include("functions.php");
//1.GETでidを取得
$id = $_GET["id"];
//2.DB接続など
$pdo = db_con();

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table where id= :id");
$stmt ->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status == false){
    queryError($stmt);
}else{
    $row = $stmt->fetch();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="bm_list_view.php">データ一覧</a>
          <a class="navbar-brand" href="bm_user_detail.php">登録情報</a>
          <a class="navbar-brand" href="bm_logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>本登録リスト</legend>
     <label>本の名前：<input type="text" name="bookname" value="<?=$row["book_name"]?>"></label><br>
     <label>URL：<input type="text" name="url" value="<?=$row["book_url"]?>"></label><br>
     <label>評価：
         <select name="score">
             <option>選択</option>
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">5</option>
             <option value="6">6</option>
             <option value="7">7</option>
             <option value="8">8</option>
             <option value="9">9</option>
             <option value="10">10</option>
         </select>
     </label><br>
     <label>ステータス：
         <select name="status">
             <option>選択</option>
             <option value="already">読了</option>
             <option value="yet">購入済</option>
             <option value="now">読書中</option>
             <option value="wish">気になる</option>
             <option value="retry">また挑戦</option>
             <option value="legend">バイブル</option>
         </select>
     </label><br>
     <label><textArea name="comment" rows="4" cols="40" ><?=$row["book_comment"]?></textArea></label><br>
     <label><textArea name="bestphraise" rows="2" cols="40"><?=$row["best_phrase"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="送信" ><br>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
