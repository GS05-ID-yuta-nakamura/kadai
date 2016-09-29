<?php
include("functions.php");
session_start();

ssidCheck();

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
<title>本一覧</title>
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
    
    $("like").on('click',function(){
        if($(this).parent("p").attr('class') == "like0"){
            $(this).parent("p").removeClass("like0");
            $(this).parent("p").addClass("like1");
        }
        if($(this).parent("p").attr('class') == "like1"){
            $(this).parent("p").removeClass("like1");
            $(this).parent("p").addClass("like0");
        }
    })
    
//    $('#like').click(function()
//        {
//            //POSTメソッドで送るデータを定義します var data = {パラメータ名 : 値};
//            var data = {request : $('#request').val()};
//
//            /**
//             * Ajax通信メソッド
//             * @param type  : HTTP通信の種類
//             * @param url   : リクエスト送信先のURL
//             * @param data  : サーバに送信する値
//             */
//            $.ajax({
//                type: "POST",
//                url: "send.php",
//                data: data,
//                /**
//                 * Ajax通信が成功した場合に呼び出されるメソッド
//                 */
//                success: function(data, dataType)
//                {
//                    //successのブロック内は、Ajax通信が成功した場合に呼び出される
//
//                    //PHPから返ってきたデータの表示
//                    alert(data);
//                },
//                /**
//                 * Ajax通信が失敗した場合に呼び出されるメソッド
//                 */
//                error: function(XMLHttpRequest, textStatus, errorThrown)
//                {
//                    //通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
//
//                    //this;
//                    //thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
//
//                    //エラーメッセージの表示
//                    alert('Error : ' + errorThrown);
//                }
//            });
//            
//            //サブミット後、ページをリロードしないようにする
//            return false;
//        });
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
          <a class="navbar-brand" href="bm_user_detail.php">登録情報</a>
          <a class="navbar-brand" href="bm_logout.php">ログアウト</a>
          <p class="navbar-brand name">ようこそ <?php echo $_SESSION["name"] ?> さん</p>
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
       <label>お気に入り：
             <select name="like">
                 <option value="nolike">未選択</option>
                 <option value="like">お気に入り</option>
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
