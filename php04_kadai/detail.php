<?php
session_start();
$id = $_GET['id']; //?id~**を受け取る
require_once('funcs.php');
loginCheck();
$pdo = db_conn();


$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

$view = '';
if ($status === false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>スポットの登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">チルスポットリスト</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>チルスポットリスト</legend>
                <label>場所名:<input type="text" name="spotname" value="<?= $result['spotname'] ?>"></label><br>
                <label>URL:<input type="text" name="spoturl" value="<?= $result['spoturl'] ?>"></label><br>
                <label>コメント:<input type="text" name="spotreview" value="<?= $result['spotreview'] ?>"></label><br>
                <!-- <label><textArea name="content" rows="4" cols="40"></textArea></label><br> -->

                <input type="hidden" name="id" value="<?= $result['id'] ?>"><br>      

                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
</body>

</html>
