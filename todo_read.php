<?php

// 関数読み込み
include('functions.php');

// db接続
$pdo = connect_to_db();

// SELECT(参照)する
$sql = 'SELECT * FROM users_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// 失敗
if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
// 成功
} else {
  // データの出力用変数（初期値は空文字）を設定
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["username"]}</td>";
    $output .= "<td>{$record["password"]}</td>";
    // edit deleteリンクを追加
    $output .= "<td>
                  <a href='todo_edit.php?id={$record["id"]}'>edit</a>
                </td>";
    $output .= "<td>
                  <a href='todo_delete.php?id={$record["id"]}'>delete</a>
                </td>";
    $output .= "</tr>";
    $output .= "</tr>";
  }
  // $recordの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>一覧画面</title>
</head>

<body>
  <fieldset>
    <legend>一覧画面</legend>
    <a href="todo_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>username</th>
          <th>password</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>