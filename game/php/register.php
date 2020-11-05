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
  // echo "接続成功";
} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $msg = $e->getMessage();
}

//フォームに入力されたnameがすでに登録されていないかチェック
$sql = "SELECT * FROM roulette WHERE name = :name";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $register_name);
$stmt->execute();
$member = $stmt->fetch();
if ($member['name'] === $register_name) {
    //既に同じ名前がある時
    // $msg = '同じNameが存在します。別の名前に変更してください。';
    // $url = '<a href="../index.html">戻る</a>';

    $alert = "<script type='text/javascript'>alert('同じ名前が存在します。別の名前にしてください。');location.href = 'https://webapp.massyu.net/game/index.html'</script>";
    echo $alert;


} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO roulette(name, pass) VALUES (:name, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $register_name);
    $stmt->bindValue(':pass', password_hash($register_pass, PASSWORD_DEFAULT));
    $stmt->execute();
    // $msg = '会員登録が完了しました';
    // $url = '<a href="../select.html">いざ！ルーレット！</a>';

    // リダイレクト先のURLへ転送する
    $url = 'https://webapp.massyu.net/game/select.html';
    header('Location: ' . $url, true, 302);

    // すべての出力を終了
    exit;
}
?>

