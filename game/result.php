<?php
session_start();

// DB情報（elastic beanstalkの環境変数から読み込む）
require_once('php/db-info.php');

//function Subtraction($bet_money, $id){//DBからgoldの値を引くプログラム

  // DB情報（elastic beanstalkの環境変数から読み込む）
  // require_once('../php/db-config.php');
  

try {
  $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";
  $dbh = new PDO($dsn, $username, $password);
  echo $dsn;//デバッグ用
  echo "接続成功";
  $sql = "UPDATE roulette SET gold = gold - :bet_money WHERE id = :id";
  echo $sql;
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':bet_money', $bet_money, PDO::PARAM_INT);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $msg = $e->getMessage();
  alert('$msg');
  }
//}


// SESSIONから名前を取得
$login_name = $_SESSION['name'];

// SESSIONのIDを代入
$login_id = $_SESSION['id'];

$bet_money = $_POST['result_num'];
echo $bet_money;

if(is_numeric($bet_money)){
  echo 'intです';
}else{
  echo 'その他です';
}

// フォームから受け取ったデータ
$array = array();//初期化
$array = array(//フォームから受けとったデータを配列に代入
  'number_1st12' => $_POST['number_1st12'],
  'number_2st12' => $_POST['number_2st12'],
  'number_3st12' => $_POST['number_3st12'],
  'number_0' => $_POST['number_0'],
  'number_1' => $_POST['number_2'],
  'number_2' => $_POST['number_3'],
  'number_3' => $_POST['number_3'],
  'number_4' => $_POST['number_4'],
  'number_5' => $_POST['number_5'],
  'number_6' => $_POST['number_6'],
  'number_7' => $_POST['number_7'],
  'number_8' => $_POST['number_8'],
  'number_9' => $_POST['number_9'],
  'number_10' => $_POST['number_10'],
  'number_11' => $_POST['number_11'],
  'number_12' => $_POST['number_12'],
  'number_13' => $_POST['number_13'],
  'number_14' => $_POST['number_14'],
  'number_15' => $_POST['number_15'],
  'number_16' => $_POST['number_16'],
  'number_17' => $_POST['number_17'],
  'number_18' => $_POST['number_18'],
  'number_19' => $_POST['number_19'],
  'number_20' => $_POST['number_20'],
  'number_21' => $_POST['number_21'],
  'number_22' => $_POST['number_22'],
  'number_23' => $_POST['number_23'],
  'number_24' => $_POST['number_24'],
  'number_25' => $_POST['number_25'],
  'number_26' => $_POST['number_26'],
  'number_27' => $_POST['number_27'],
  'number_28' => $_POST['number_28'],
  'number_29' => $_POST['number_29'],
  'number_30' => $_POST['number_30'],
  'number_31' => $_POST['number_31'],
  'number_32' => $_POST['number_32'],
  'number_33' => $_POST['number_33'],
  'number_34' => $_POST['number_34'],
  'number_35' => $_POST['number_35'],
  'number_36' => $_POST['number_36'],
  'number_1_18' => $_POST['number_1_18'],
  'number_even' => $_POST['number_even'],
  'number_red' => $_POST['number_red'],
  'number_black' => $_POST['number_black'],
  'number_odd' => $_POST['number_odd'],
  'number_19_36' => $_POST['number_19_36']
);

print_r($array);//デバッグ用

try {
  $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";
  $dbh = new PDO($dsn, $username, $password);
  // echo "接続成功";
  $sql = "select gold from roulette where id= :id;";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch();
  $money = $result['gold'];
  
} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $alert = $e->getMessage();
  echo $alert;
}

if (isset($_SESSION['id'])) {//ログインしているとき
  $print_name = htmlspecialchars($login_name, \ENT_QUOTES, 'UTF-8');
  $print_money = htmlspecialchars($money, \ENT_QUOTES, 'UTF-8');
} else {//ログインしていない時
  $alert = "<script type='text/javascript'>alert('ログインしていません。ログインしてください');location.href = 'https://webapp.massyu.net/game/index.html'</script>";
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
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
  <!-- JavaScript -->
  <script tepe="text/javascript" src="js/jQueryRotate.js"></script>
  <script src="js/rotate.js"></script>
  <!-- css -->
  <link rel="stylesheet" href="css/result.css">
</head>

<body>
  <div class="container">
    <header>
      <p><?php echo $login_name; ?>さん</p>
      <input type="button" value="ログアウト" class="btn btn-secondary" onclick="location.href='https://webapp.massyu.net/game/php/logout.php'">
    </header>
    <h1>何が出るかな</h1>
    <!-- 針の画像 -->
    <div id="hari">
      <img src="https://magnets.jp/demo/inagaki20141107/img/hari.png" alt="はり">
    </div>

    <!-- ルーレットの画像 -->
    <div id="roulette">
      <img src="https://webapp.massyu.net/img/roulette.svg" alt="ルーレット" id="mato">
    </div>

    <!-- 結果の表示 -->
    <div id="result">
      <p>
      <h2><span>hoge</span></h2>
      </p>
    </div>

    <div class="button">
      <input type="button" class="btn btn-primary" onclick="location.href='https://webapp.massyu.net/game/select.php'" value="もう一度遊ぶ">

      <input type="button" class="btn btn-success" onclick="location.href='https://webapp.massyu.net/game/board.php'" value="みんなの結果を見る">
    </div>
  </div>
</body>

</html>