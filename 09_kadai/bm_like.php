<?php
include("functions.php");

//1.POSTでParamを取得
$id = $_GET["id"];
$book_like = $_GET["book_like"];
echo $book_like;
//book_likeを変更
if($book_like == 0){
    $book_like = 1;
}else if($book_like == 1){
    $book_like = 0;
}
echo $book_like;

//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_bm_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book_like=:book_like WHERE id=:id");
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$stmt->bindValue(':book_like',$book_like, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  header("Location: bm_list_view.php");
  exit;
}

?>
