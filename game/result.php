<?php
session_start();

// DB情報（elastic beanstalkの環境変数から読み込む）
require_once('php/db-info.php');




// SESSIONから名前を取得
$login_name = $_SESSION['name'];

// SESSIONのIDを代入
$login_id = $_SESSION['id'];

$bet_money = $_POST['result_num'];





//function Subtraction($bet_money, $id){//DBからgoldの値を引くプログラム

  // DB情報（elastic beanstalkの環境変数から読み込む）
  // require_once('../php/db-config.php');
  

try {
  $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";
  $dbh = new PDO($dsn, $username, $password);
  // echo $dsn;//デバッグ用
  // echo "接続成功";
  $sql = "UPDATE roulette SET gold = gold - :bet_money WHERE id = :id";
  // echo $sql;
  // echo $login_id;
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':bet_money', $bet_money, PDO::PARAM_INT);
  $stmt->bindValue(':id', $login_id, PDO::PARAM_INT);
  $stmt->execute();

} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $msg = $e->getMessage();
  alert('$msg');
  }
//}

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
  <script>
    $(() => {

const speed = 100;   //ルーレットの回転速度
const divide = 37;   //ルーレットの分割数
const timeout = 3000;   //○秒後に停止

//停止位置の設定。1～360までの乱数を取得して挿入する
const stopAngle = Math.round(Math.random() * 360 + 0.5);

//ルーレットの角度の変数。停止位置の値を初期値に設定する
let angle = stopAngle;

//ルーレットの分割数から1エリア分の角度を求める。
const section = 360 / divide;

//停止位置がどのエリアにあるか調べ、該当する番号をstopNumberに格納
for (i = 1; i <= divide; i++) {
  if (section * (i - 1) + 1 <= stopAngle && stopAngle <= section * i) {
    stopNumber = i;
  }
};

console.log(stopNumber);

//クルクル処理。5ミリ秒毎にspeedの数値分画像が回転します。
const rotation = setInterval(function () {
  $("#mato").rotate(angle);
  angle += speed;
}, 5);


//timeout秒後に停止させる処理
setTimeout(() => {

  //クルクル処理をしているsetIntervalをclear
  clearInterval(rotation);

  //setIntervalで増えた余分な数値を減らし、逆回転を防ぐためにマイナス値にする
  angle = angle % 360 - 360;

  //停止位置までのアニメーション。完了するとresult()が実行される
  $("#mato").rotate({
    angle: angle,
    animateTo: stopAngle,
    callback: result
  });

  //ルーレットの停止処理に入ったので針の画像を静止画へ変更
  $("#hari img").attr('src', $("#hari img").attr('src').replace('gif', 'png'));

}, timeout);


//ルーレット停止後に実行される処理
const result = () => {
  switch (stopNumber) {

    // //0の時の処理
    // case 0:
    //   $("#result span").text("0でした！")
    //   break;

    //26の時の処理
    case 1:
      $("#result span").text("赤の26でした！")
      const num = <?php echo $array[number_26];?> * 36;
      const color = <?php echo $array[number_red];?> * 2;
      const st = <?php echo $array[number_3st12];?> * 3;
      const hiLow = <?php echo $array[number_19_36];?> * 2;
      const oddEven = <?php echo $array[number_even];?> * 2;

      console.log(num + color + st + hiLow + oddEven);

      break;

    //3の時の処理
    case 2:
      $("#result span").text("黒の3でした！")
      break;

    //35の時の処理
    case 3:
      $("#result span").text("赤の35でした！")
      break;

    //12の時の処理 
    case 4:
      $("#result span").text("黒の12でした！")
      break;

    //28の時の処理
    case 5:
      $("#result span").text("赤の28でした！")
      break;

    //7の時の処理
    case 6:
      $("#result span").text("黒の7でした！")
      break;

    //29の時の処理
    case 7:
      $("#result span").text("赤の29でした！")
      break;

    //18の時の処理
    case 8:
      $("#result span").text("黒の18でした！")
      break;

    //22の時の処理 
    case 9:
      $("#result span").text("赤の22でした！")
      break;

    //9の時の処理
    case 10:
      $("#result span").text("黒の9でした！")
      break;
    //31の時の処理
    case 11:
      $("#result span").text("赤31でした！")
      break;

    //14の時の処理
    case 12:
      $("#result span").text("黒の14でした！")
      break;

    //20の時の処理
    case 13:
      $("#result span").text("赤の20でした！")
      break;

    //1の時の処理 
    case 14:
      $("#result span").text("黒の1でした！")
      break;

    //33の時の処理
    case 15:
      $("#result span").text("赤の33でした！")
      break;

    //16の時の処理
    case 16:
      $("#result span").text("黒の16でした！")
      break;

    //24の時の処理
    case 17:
      $("#result span").text("赤の24でした！")
      break;

    //5の時の処理
    case 18:
      $("#result span").text("黒の5でした！")
      break;

    //10の時の処理 
    case 19:
      $("#result span").text("赤の10でした！")
      break;

    //23の時の処理
    case 20:
      $("#result span").text("黒の23でした！")
      break;

    //8の時の処理
    case 21:
      $("#result span").text("赤の8でした！")
      break;

    //30の時の処理
    case 22:
      $("#result span").text("黒の30でした！")
      break;

    //11の時の処理
    case 23:
      $("#result span").text("赤の11でした！")
      break;

    //36の時の処理 
    case 24:
      $("#result span").text("黒の36でした！")
      break;

    //13の時の処理
    case 25:
      $("#result span").text("赤の13でした！")
      break;

    //27の時の処理
    case 26:
      $("#result span").text("黒の27でした！")
      break;

    //6の時の処理
    case 27:
      $("#result span").text("赤の6でした！")
      break;

    //34の時の処理
    case 28:
      $("#result span").text("黒の34でした！")
      break;

    //17の時の処理 
    case 29:
      $("#result span").text("赤の17でした！")
      break;

    //25の時の処理
    case 30:
      $("#result span").text("黒の25でした！")
      break;
    //2の時の処理
    case 31:
      $("#result span").text("赤の2でした！")
      break;

    //21の時の処理
    case 32:
      $("#result span").text("黒の21でした！")
      break;

    //4の時の処理
    case 33:
      $("#result span").text("赤の4でした！")
      break;

    //19の時の処理 
    case 34:
      $("#result span").text("黒の19でした！")
      break;

    //15の時の処理
    case 35:
      $("#result span").text("赤の15でした！")
      break;

    //32の時の処理
    case 36:
      $("#result span").text("黒の32でした！")
      break;

    //0の時の処理
    case 37:
      $("#result span").text("0でした！")
      break;

  };
};
});
  </script>
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
      <input type="button" class="btn btn-primary" onclick="location.href='https://webapp.massyu.net/game/user_result.php'" value="結果を見る">
    </div>
  </div>
</body>

</html>