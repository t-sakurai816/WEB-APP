<html>
<head lang="ja">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>シンプルなじゃんけんゲーム</title>
</head>
<body bgcolor="#FFDDDD">
<php
if(isset($_GET[win])){  //勝った回数
   $win = $_GET[win];
   } else {
   $win = 0;
   }
if(isset($_GET['lose'])){  //負けた回数
   $lose = $_GET['lose']
   } else {
   $lose = 0;
　 }
if(isset($_GET['aiko'])){  //あいこだった回数
   $aiko = $_GET['aiko'];
   } else {
   $aiko = 0;
   }
?>

<form action="result.php" method="get">
じゃんけん　<input type="radio" name="janken" value="0">グー
<input type="radio" name="janken" value="1">チョキ
<input type="radio" name="janken" value="2">パー
<input type="submit" value="ぽん">
<input type="hidden" value=<?php echo $win; ?>  name="win">
<input type="hidden" value=<?php echo $aik0; ?> name="aiko">
</form>
</body>
</html>
