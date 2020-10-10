<html>
<head lang="ja">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>勝負の結果は？</title>
</head>
<body bgcolor="#DDDDFF">
<?php
//数字0, 1, 2を文字列グー，チョキ，パーに変換するための関数
function hyouji($arg){
  if ($arg == 0) {
    $str = "グー";
    echo $str;
  } elseif ($arg == 1) {
    $str = "チョキ";
    echo $str;
  } else {
    $str = "パー";
    echo $str;
  }
}

$user = $_GET['janken']; //ユーザが入力した手を受け取る
$com  = rand(0, 2);       //コンピュータの手を乱数で決める

$win  = $_GET['win'];     //勝った回数
$lose = $_GET['lose'];    //負けた回数
$aiko = $_GET['aiko'];    //あいこだった回数

//勝ち負けを判定する
if ($user == $com){
       $result = "あいこ";
       $aiko++;
} elseif ($com == ($user+1) % 3) {
       $result = "ユーザの勝ち";
       $win++;
} else {
       $result = "コンピュータの勝ち";
       $lose++;
}

// ユーザーの手を表示
echo "ユーザは <font color=red>";
hyouji($user);

// コンピュータの手を表示
echo "</font> で，コンピュータは <font color=red>";
hyouji($com);

echo "</font><BR>";

// 結果を表示
echo "したがって，$result";
echo "<BR><BR>結果，<font color=red>".$win."</font>勝 <font color=red>"; 
echo $lose."</font>敗 <font color=red>".$aiko."</font>分け";
?>

<form action="top.php" method="POST">
  <input type="submit" value="もう一度やる？">
  <input type="hidden" value=<?php echo $win; ?>  name="win">
  <input type="hidden" value=<?php echo $lose; ?> name="lose">
  <input type="hidden" value=<?php echo $aiko; ?> name="aiko">
</form>

<form action="top.php" method="GET">
  <input type="submit" value="はじめから？">
  <input type="hidden" value=0 name="win">
  <input type="hidden" value=0 name="lose">
  <input type="hidden" value=0 name="aiko">
</form>
</body>
</html>
