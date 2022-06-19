<?php

//1. POSTデータ取得
$spotname = $_POST['spotname'];
$spoturl = $_POST['spoturl'];
$spotreview = $_POST['spotreview'];

require_once('funcs.php');
$pdo = db_conn();


//３．データ登録SQL作成
// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO
                    gs_bm_table(
                        id, spotname, spoturl, spotreview, date)
                    VALUES (NULL, :spotname, :spoturl, :spotreview, sysdate());");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':spotname', $spotname, PDO::PARAM_STR); //STR：文字列
$stmt->bindValue(':spoturl', $spoturl, PDO::PARAM_STR);
$stmt->bindValue(':spotreview', $spotreview, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
    sql_error($stmt);
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  // $error = $stmt->errorInfo();
  // exit('ErrorMessage:'.$error[2]);
}else{
    redirect('index.php');
  //５．index.phpへリダイレクト
  // header('Location: index.php');
}
?>