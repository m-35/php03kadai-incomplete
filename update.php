<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1. POSTデータ取得
$name = $_POST['name'];
$capital = $_POST['capital'];
$industry = $_POST['industry'];
$email = $_POST['email'];
$password = $_POST['password'];
$id = $_POST['id'];

//2. DBからPHPに接続します
try {
  $db_name = 'php03kadai';    //データベース名
  $db_id   = 'root';      //アカウント名
  $db_pw   = '';      //パスワード：MAMPは'root'
  $db_host = 'localhost'; //DBホスト
  $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
  exit('DB Connection Error:' . $e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE
                            user
                        SET name = :name,
                            capital = :capital,
                            industry = :industry ,
                            email = :email,
                            password = :password,
                            -- indate = now()
                        WHERE id = :id;
                        ');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':capital', $capital, PDO::PARAM_INT);
$stmt->bindValue(':industry', $industry, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: selectall.php');
    exit();
}

?>

