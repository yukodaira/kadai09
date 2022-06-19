<?php

//1. POSTデータ取得
$spotname   = $_POST['spotname'];
$spoturl  = $_POST['spoturl'];
$spotreview = $_POST['spotreview'];
$id = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE
                        gs_bm_table
                    SET 
                        spotname = :spotname,
                        spoturl = :spoturl,
                        spotreview = :spotreview,
                        date = sysdate()
                    WHERE
                        id = :id;
                        ');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':spotname', $spotname, PDO::PARAM_STR);
$stmt->bindValue(':spoturl', $spoturl, PDO::PARAM_STR);
$stmt->bindValue(':spotreview', $spotreview, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    sql_error ($stmt);
    // $error = $stmt->errorInfo();
    // exit('SQLError:' . print_r($error, true));
} else {
    redirect('index.php');
    //*** function化する！*****************
    // header('Location: index.php');
    // exit();
}