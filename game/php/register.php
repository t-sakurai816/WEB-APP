<?php
// DB情報（elastic beanstalkの環境変数から読み込む）
$host = $_SERVER['DB_HOST'];
$username = $_SERVER['DB_USERNAME'];
$password = $_SERVER['DB_PASSWORD'];
$dbname = $_SERVER['DB_DATABASE'];

$dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";

// フォームから受け取ったデータ
$register_name = $_POST['register_name'];
$register_pass = $_POST['register_pass'];


try {
  $dbh = new PDO($dsn, $username, $password);
  echo "接続成功";
} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $msg = $e->getMessage();
}

//フォームに入力されたnameがすでに登録されていないかチェック
$sql = "SELECT * FROM users WHERE name = :name";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $mail);
$stmt->execute();
$member = $stmt->fetch();
if ($member['name'] === $mail) {
    $msg = '同じNameが存在します。別の名前に変更してください。';
    $url = '<a href="../index.html">戻る</a>';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO users(name, pass) VALUES (:name, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();
    $msg = '会員登録が完了しました';
    $url = '<a href="select.html">いざ！ルーレット！</a>';
}
?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $url; ?>
