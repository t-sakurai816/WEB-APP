<?php
session_start();

// DB情報（elastic beanstalkの環境変数から読み込む）
require_once('php/db-info.php');

// SESSIONから名前を取得
$login_name = $_SESSION['name'];

// SESSIONのIDを代入
$login_id = $_SESSION['id'];

$result_money = $_POST['result_money'];

if (isset($_SESSION['id'])) {//ログインしているとき
  $print_name = htmlspecialchars($login_name, \ENT_QUOTES, 'UTF-8');
} else {//ログインしていない時
  $alert = "<script type='text/javascript'>alert('ログインしていません。ログインしてください');location.href = 'https://webapp.massyu.net/game/index.html'</script>";
  echo $alert;
}

// DBに値を足す
try {
  $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";
  $dbh = new PDO($dsn, $username, $password);
  // echo $dsn;//デバッグ用
  // echo "接続成功";
  $sql = "UPDATE roulette SET gold = gold + :result_money WHERE id = :id";
  // echo $sql;
  // echo $login_id;
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':result_money', $result_money, PDO::PARAM_INT);
  $stmt->bindValue(':id', $login_id, PDO::PARAM_INT);
  $stmt->execute();

  $dbh = new PDO($dsn, $username, $password);
  //DBから取得
  $sql = "select gold from roulette where id= :id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $login_id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch();
  $money = $result['gold'];


} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $msg = $e->getMessage();
  alert('$msg');
  }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- css -->
  <link rel="stylesheet" href="css/user_result.css">
</head>

<body>
  <div class="container">
    <header>
      <p><?php echo $login_name; ?>さん</p>
      <input type="button" value="ログアウト" class="btn btn-secondary" onclick="location.href='https://webapp.massyu.net/game/php/logout.php'">
    </header>
    <h1>↓↓↓<?php echo $print_name?>'s Money↓↓↓</h1>
    <h1><?php echo $money ?></h1>
    <!--ここにユーザーのコインの所持枚数を表示-->
    <div class="button">
      <input type="button" class="btn btn-primary" onclick="location.href='https://webapp.massyu.net/game/select.php'"
        value="もう一度遊ぶ">

      <input type="button" class="btn btn-success" onclick="location.href='https://webapp.massyu.net/game/board.php'"
        value="みんなの結果を見る">
    </div>
  </div>
</body>

</html>