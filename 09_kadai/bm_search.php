<?php
include("functions.php");

//0. POSTデータ取得
if(!$_POST["bookname"]=""){
    $bookname   = $_POST["bookname"];
}else{
    
}
if(!$_POST["like"]=""){
    $like   = $_POST["like"];
}
if(!$_POST["like"]=""){
    $score  = $_POST["score"];
}

$score  = $_POST["score"];
$bookstatus  = $_POST["status"];


//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY indate DESC;");
$status = $stmt->execute();

//３．データ表示
$view0="";
$view1="";
$view2="";
$view3="";
$view4="";
$view5="";
$view6="";
$view="";
$view100="";
$input = array();
$bphrase = array();
$bscore = array();
$bcomment = array();
$bname = array();
$burl = array();
$bbphrase = array();
$bbscore = array();
$bbcomment = array();
$bbname = array();
$bburl = array();
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  queryError($stmt);

}else{
  //Selectデータの数だけ自動でループしてくれる
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

    //ボックスに振り分け
      if($result["status"] == "already"){
            $view100 = view($result);
            $view1 .= $view100;
          
      }else if($result["status"] == "yet"){
            $view100 = view($result);
            $view2 .= $view100;
          
      }else if($result["status"] == "now"){
            $view100 = view($result);
            $view3 .= $view100;
          
      }else if($result["status"] == "wish"){
            $view100 = view($result);
            $view4 .= $view100;
          
      }else if($result["status"] == "retry"){
            $view100 = view($result);
            $view5 .= $view100;
          
      }else if($result["status"] == "legend"){
            $view100 = view($result);
            $view6 .= $view100;
      }
    
    //配列にフレーズ格納
    if(!$result["best_phrase"] == ""){
        
        $bphrase[] = $result["best_phrase"];
        $bscore[] = $result["book_score"];
        $bcomment[] = $result["book_comment"];
        $bname[] = $result["book_name"];
        $burl[] = $result["book_url"];
        
    }
    
    
    }

        //連想配列作成、、作った意味ない？
        $input[] = array($bphrase, $bscore,$bcomment,$bname,$burl);
        //ランダム配列
        $rand_keys = array_rand($bphrase, 1);
            $view0 = "\"".$bphrase[$rand_keys]."\"";
            $bbname ="<a href=\"".$burl[$rand_keys]."\">".$bname[$rand_keys]."</a>"."<br>";
            $bbscore = $bscore[$rand_keys];
            $bbcomment = $bcomment[$rand_keys];
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bm.css" rel="stylesheet">
<script src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.raty.js"></script>
<script>
$(document).ready(function(){
    //rating
    $(function raty() {
         $("#rate").raty({
              number: 10,
              score : <?=$bbscore?>
         });
    });
    $.fn.raty.defaults.path = "images";
    $('#rate').raty();

    //show
    (function($){
    $(function(){
        $(document)
            .on('click', '.popup_btn', function(){

                $('.popup').show();
                $('#overlay').show();

                return false;
            })
            .on('click', '.close_btn, #overlay', function(){
                $('.popup, #overlay').hide();
                return false;
            });
    });
    })(jQuery);
});
</script> 
<style>div{padding: 10px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_insert_view.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="best">
       <h2>本日の一言</h2>
       <a href="#popup1" class="popup_btn">
           <h1><?=$view0?></h1>
       </a>
    </div>

    <div id="popup1" class="popup">
        <div class="popup_inner">
            <h4><?=$bbname?></h4>
            <div id="rate"></div>
            <h5><?=$bbcomment?></h5>
            <div>
                <a href="#close_btn" class="close_btn">閉じる</a>
            </div>
        </div>
    </div>
    <div id="overlay"></div>
    
    <form method="post" action="bm_search.php">
    <div id="search">
       <h2>検索</h2>
       <label>本の名前：<input type="text" name="bookname"></label>
       <label>お気に入り：
             <select name="like">
                 <option>未選択</option>
                 <option value="like">お気に入り</option>
             </select>
    　　</label><br>
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
        </label>
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
         </label>
         <input type="submit" class="answer" value="検索" >
    </div>
    </form>
   
    <div class="container jumbotron">
        <div class="ap lp">
            <h3>読んだ？</h3>
            <?=$view1?>
        </div>
        <div class="bp rp">
            <h3>まだ？</h3>
            <?=$view2?>
        </div>
        <div class="ap rp">
            <h3>途中？</h3>
            <?=$view3?>
        </div>
        <div class="bp lp">
            <h3>読みたい？</h3>
            <?=$view4?>
        </div>
        <div class="ap lp">
            <h3>もう一回？</h3>
            <?=$view5?>
        </div>
        <div class="bp rp">
            <h3>伝説級？</h3>
            <?=$view6?>
        </div>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>