<?php
include("functions.php");

//1.POSTでParamを取得
$id = $_POST["id"];
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$comment = $_POST["comment"];
$score  = $_POST["score"];
$bookstatus  = $_POST["status"];
$best  = $_POST["best"];

//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_bm_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book_name=:book_name, book_url=:book_url, book_comment=:book_comment, book_score=:book_score, status=:status, best_phrase=:best_phrase WHERE id=:id");
$stmt->bindValue(':book_name', $bookname,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_url', $url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_comment', $comment,　PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_score', $score,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':status', $score, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':best_phrase', $best,　PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false){
    queryError($stmt);
}else{
    header("Location: bm_insert_view.php");
    exit;
}


?>