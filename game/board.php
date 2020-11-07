<?php
// DB情報（elastic beanstalkの環境変数から読み込む）
$host = $_SERVER['DB_HOST'];
$username = $_SERVER['DB_USERNAME'];
$password = $_SERVER['DB_PASSWORD'];
$dbname = $_SERVER['DB_DATABASE'];

try {
  $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";
  $dbh = new PDO($dsn, $username, $password);
  // echo "接続成功";
  //所持枚数でソート。名前も出力。最大数10
  $sql = "SELECT `name`, `gold`, RANK() OVER(ORDER BY gold DESC) AS rank_result FROM roulette LIMIT 10;";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  // echo $row;//デバック用

  //配列にSQLの実行結果を入れる
  while($row = $stmt->fetch()){
    $rows[] = $row;
  }

  $dbh = null;
} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $alert = $e->getMessage();
  echo $alert;
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ルーレットゲーム</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- css -->
  <link rel="stylesheet" href="./css/board.css">
</head>

<body>
  <div class="container">
    <h1>ランキング</h1>
    <h2>TOP10を表示しています</h2>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">順位</th>
            <th scope="col">名前</th>
            <th scope="col">得点</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($rows as $row){
          ?>
          <tr>
            <td scope="row"><?php echo $row['rank_result']; ?></td>
            <td><?php echo htmlspecialchars($row['name'], \ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo $row['gold'] ?></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
    <!-- BET画面に遷移 -->
    <input type="button" class="btn btn-primary" onclick="location.href='https://webapp.massyu.net/game/select.php'" value="もう一度遊ぶ">
  </div>
</body>

</html>