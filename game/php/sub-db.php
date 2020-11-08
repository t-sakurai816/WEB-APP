<?php
function Subtraction($money, $id){//DBからgoldの値を引くプログラム

  // DB情報（elastic beanstalkの環境変数から読み込む）
  require('../php/db-config.php');
  $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";

  try {
    $dbh = new PDO($dsn, $username, $password);
    // echo "接続成功";
    $sql = "UPDATE roulette SET gold = gold - :money WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':money', $money, PDO::PARAM_INT);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

  } catch (PDOException $e) {
    // エラーのときエラーメッセージ
    $msg = $e->getMessage();
    alert('$msg');
  }
}

// Subtraction(300, 9);
?>