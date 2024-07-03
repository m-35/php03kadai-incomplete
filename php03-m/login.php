<?php session_start(); ?>
<?php
// // 本番環境データベース
// $prod_db = "";
// // 本番環境ホスト
// $prod_host = "mysql635.db.sakura.ne.jp";
// // 本番環境ID
// $prod_id = "snails";
// // 本番環境PW
// $prod_pw = "";

unset($_SESSION['user']);

//2. DBからPHPに接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=php03kadai;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

$sql=$pdo->prepare('select * from user where email=? and password=?');
$sql->execute([$_REQUEST['email'], $_REQUEST['password']]);
foreach ($sql as $row) {
	$_SESSION['user']=[
		'id'=>$row['id'], 
        'name'=>$row['name'], 
		'capital'=>$row['capital'], 
        'industry'=>$row['industry'], 
        'email'=>$row['email'],
		'password'=>$row['password']
        ];
       }
if (isset($_SESSION['user'])) {
    echo 'ようこそ、', $_SESSION['user']['name'], 'さん。';
    header('Location:script.php');
    exit;
} else {
	echo 'ログイン名またはパスワードが違います。';
}

//    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     // ユーザー情報をデータベースから取得
//     $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
//     $stmt->execute([$email, $password]);

//     if ($stmt->rowCount() > 0) {
//         // ログイン成功
//         header('Location:script.php');
//         exit;
//     } else {
//         // ログイン失敗
//         echo "emailまたはパスワードが間違っています。";
//     }
// }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <style>
        div {
            padding: 70px;
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
    box-sizing: border-box; /* 追加: paddingとborderを含める */
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
    box-sizing: border-box; /* 追加: paddingとborderを含める */
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
<form method="POST">
    <div class="login">
    <fieldset>
    <legend>起業広告動画配信BOOST</legend>
        <label>Email <input type="text" name="email"></label><br>
        <label>パスワード <input type="password" name="password"><br> <label>
            <input type="submit" value="ログイン">
    </fieldset>
    </div>           
</form>
</body>
</html>
