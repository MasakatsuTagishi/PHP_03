<?php

// 関数読み込み
include('functions.php');

// 確認
// var_dump($_POST);
// exit();

// POSTデータ取得
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];

// DB接続
$pdo = connect_to_db();

// UPDATE(更新処理)をする
$sql = "UPDATE users_table SET username=:username, password=:password,
               updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// SQL実行(値の受け取り)
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
