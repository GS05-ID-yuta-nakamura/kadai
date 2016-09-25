<?php
session_start();
include("functions.php");

//パラメータチェック
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["lid"]) || $_POST["lid"]=="" ||
    !isset($_POST["lpw"]) || $_POST["lpw"]==""
  )
{
  header("Location: bm_register.php");
  exit();
}

//1変数設定
$user_name =$_POST["name"];
$lid =$_POST["lid"];
$lpw =$_POST["lpw"];
$kanri_flg = 0;
$life_flg = 0;

//2. 接続します
$pdo = db_con();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_user_table(id, user_name, lid, lpw, kanri_flg, life_flg, indate)VALUES(NULL, :a1, :a2, :a3, :a4, :a5, sysdate())");
$stmt->bindValue(':a1', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  queryError($stmt);
}else{

//header location のコロンの後は半角スペース
//５．index.phpへリダイレクト
  header("Location: bm_login.php");
  exit;

}

?>