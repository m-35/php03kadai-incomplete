<?php
require_once('funcs.php');
$id = $_GET['id'];
$pdo = db_conn();

$stmt = $pdo->prepare('DELETE FROM user WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('selectall.php');
}