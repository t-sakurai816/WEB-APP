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

  </div>
</body>

</html>