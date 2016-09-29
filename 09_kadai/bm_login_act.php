<?php
session_start();
include("functions.php");

//パラメータチェック
if(
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]==""
  )
{
  header("Location: bm_login.php");
  exit();
}

//1変数設定
$lid =$_POST["lid"];
$lpw =$_POST["lpw"];

//2. 接続します
$pdo = db_con();

//３．データ登録SQL作成
$sql="SELECT * FROM gs_bm_user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
$stmt->bindValue(':lpw', $lpw);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
    queryError($stmt);
}

//５．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//6. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  $_SESSION["schk"] = session_id();
  $_SESSION["name"]=$val["user_name"];
  $_SESSION["kanri_flg"]=$val["kanri_flg"];
  header("Location: bm_list_view.php");
}else{
  //logout処理を経由して全画面へ
  header("Location: bm_login.php");
}

exit();



?>