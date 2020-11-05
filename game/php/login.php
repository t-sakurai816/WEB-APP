<?php
session_start();
// DB情報（elastic beanstalkの環境変数から読み込む）
$host = $_SERVER['DB_HOST'];
$username = $_SERVER['DB_USERNAME'];
$password = $_SERVER['DB_PASSWORD'];
$dbname = $_SERVER['DB_DATABASE'];

$dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";

// フォームから受け取ったデータ
$login_name = $_POST['login_name'];
$login_pass = $_POST['login_pass'];

try {
  $dbh = new PDO($dsn, $username, $password);
  // echo "接続成功";
} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $msg = $e->getMessage();
}

$sql = "SELECT * FROM roulette WHERE name = :name";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $login_name);
$stmt->execute();
$member = $stmt->fetch(PDO::FETCH_BOTH);
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['login_pass'], $member['pass'])) {
    // DBのユーザー情報をセッションに保存
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    $msg = 'ログインしました。';
    $link = '<a href="index.php">ホーム</a>';
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="login.php">戻る</a>';
}
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
