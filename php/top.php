﻿<html>
   <head lang="ja">
   <meta http-equiv="Content-Type" content="text/html; charset=utf8">
   <title>シンプルなじゃんけんゲーム</title>
</head>
   <body bgcolor="#FFDDDD">
      <?php
      if(isset($_GET['win'])){  //勝った回数
         $win = $_GET['win'];
         } else {
         $win = 0;
         }
      if(isset($_GET['lose'])){  //負けた回数
         $lose = $_GET['lose'];
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
      じゃんけん 
         <input type="radio" name="janken" value="0" required>グー <!--ラジオボタン-->
         <input type="radio" name="janken" value="1" required>チョキ <!--ラジオボタン-->
         <input type="radio" name="janken" value="2" required>パー <!--ラジオボタン-->

         <input  type="hidden" name="win" value=<?php echo $win; ?>>
         <input  type="hidden" name="aiko" value=<?php echo $aiko; ?>>
         <input  type="hidden" name="lose" value=<?php echo $lose; ?>>
         <input type="submit" value="ぽん"> <!--送信-->


      </form>
   </body>
</html>
