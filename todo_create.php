<?php

// 確認
// var_dump($_POST);
// exit();

// 関数読み込み
include('functions.php');

// 入力チェック
if (
  !isset($_POST['username']) || $_POST['username'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// POSTデータ取得
$username = $_POST['username'];
$password = $_POST['password'];

// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at)
        VALUES(NULL, :username, :password, is_admin, is_deleted, sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行
if ($status == false) {
  // 失敗
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 成功
  header("Location:todo_input.php");
  exit();
}