<?php

// 確認
// var_dump($_GET);
// exit();

// GETデータ取得
$id = $_GET['id'];

// 関数読み込み
include('functions.php');

// DB接続
$pdo = connect_to_db();

// DELETE(削除処理)をする
$sql = "DELETE FROM users_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行
if ($status == false) {
    // 失敗
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 成功
    header("Location:todo_read.php");
    exit();
}