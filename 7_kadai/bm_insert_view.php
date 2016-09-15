<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery-2.1.3.min.js"></script>
    <style>
        div{padding: 10px;font-size:16px}
    </style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_list_view.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>本登録リスト</legend>
     <label>本の名前：<input type="text" name="bookname"></label><br>
     <label>URL：<input type="text" name="url"></label><br>
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
     <label><textArea name="comment" rows="4" cols="40" placeholder="感想を入力"></textArea></label><br>
     <label><textArea name="bestphraise" rows="2" cols="40" placeholder="1行コメント"></textArea></label><br>
     <input type="submit" value="送信" ><br>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<!--
style
<style>
for(var i = 1; i< 10; i++){
    var $option = $("<option></option>").text(i).attr("value".i);
    $('#score').append($option);
}
</style>
-->

</body>
</html>