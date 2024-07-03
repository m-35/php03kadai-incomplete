<?php
//  * [ここでやりたいこと]
//  * 1. クエリパラメータの確認 = GETで取得している内容を確認する
//  * 2. select.phpのPHP<?phpの中身をコピー、貼り付け
//  * 3. SQL部分にwhereを追加
//  * 4. データ取得の箇所を修正。
//  */ -->
$id= $_GET['id'];

try {
    $db_name = 'php03kadai';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = '';      //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}


//２．データ詳細表示SQL作成
$stmt = $pdo->prepare('SELECT * FROM user WHERE id = :id;');
$stmt ->bindValue(':id', $id, PDO::PARAM_INT); 
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
  }
// var_dump($result);
?>


<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>アカウント登録</title>
    <link ref="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <style>
        div {
            padding: 80px;
            font-size: 18px;
        }
                /* フォーム全体のスタイル */
form {
    max-width: 400px;
    margin: 50px auto;
    padding: 10px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* ラベルのスタイル */
label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

/* 入力フィールドのスタイル */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

/* 送信ボタンのスタイル */
input[type="submit"] {
    width: 50%;
    font-size: 20px;
    display: block; /* ボタンをブロック要素に変更 */
    margin: 0 auto; /* 水平方向に中央揃え */
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
}

/* レジェンド（フォームのタイトル）のスタイル */
legend {
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center; /* テキストを中央揃え */
    margin-top: 70px; /* 上部の余白を調整 */
}

</style>

</head>

<body>
    <!-- Main[Start] -->
    <form method="POST" action="update.php">
       <div class="account">
          <fieldset>
              <legend>アカウント登録</legend>
              <label>会社名<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
              <label>資本金（単位:万円）<input type="text" name="capital" value="<?= $result['capital'] ?>"></label><br>
              <label>業   種<input type="text" name="industry" value="<?= $result['industry'] ?>"></label><br>
              <label>Email<input type="text" name="email" value="<?= $result['email'] ?>"></label><br>
              <label>パスワード(数字４桁)<input type="password" name="password" minlength="4" maxlength="4" value="<?= $result['password'] ?>"></label><br>
              <input type="hidden" name="id" value="<?= $result['id'] ?>">
              <input type="submit" value="送信">
          </fieldset>
       </div>
    </form>
    <!-- Main[End] -->

</body>

</html>

























<!-- 授業 -->
<!-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
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
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    method, action, 各inputのnameを確認してください。 
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>フリーアンケート</legend>
                <label>名前：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>Email：<input type="text" name="email" value="<?= $result['email'] ?>"></label><br>
                <label>年齢：<input type="text" name="age" value="<?= $result['age'] ?>"></label><br>
                <label><textarea name="content" rows="4" cols="40"><?= $result['content'] ?></textarea></label><br>
                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html> -->

