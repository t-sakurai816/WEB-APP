<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WEBアプリケーション構築実験</title>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

  <!-- css -->
  <link rel="stylesheet" href="./css/style.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="col-sm-12">
      <h1>Welcome to Sakurai's App!!</h1>
      <!--RDS接続チェック-->
      <p>DB connection check : <?php include('php/rds-check-connect.php');?></p>
      <!-- 訪問者のIPアドレス表示 -->
      <p>Your IP Address : <?php include('php/get-ip.php');?></p>

      <div>
        <h2>Other Pages</h2>
        <li><a href="./html/position.html">Get Position</a></li>
        <li><a href="https://webapp.massyu.net/game/index.html">ルーレットゲーム</a></li>
        <hr class="cp_hr02" /><!--破線-->
        <li><a href="./php/sample.php">CIT Pic (lesson1)</a></li>
        <li><a href="./php/top.php">top.php (lesson2)</a></li>
        <li><a href="./php/result.php">result.php (lesson2)</a></li>
        <li><a href="./php/kadai2.php">kadai2.php(lesson8</a></li>
      </div>

    </div>
    <div class="col text-center">
      <!-- GitHubアイコン -->
      <div class="github_logo">
        <a href="https://github.com/t-sakurai816/WEB-APP" target="blank"><img alt="github-logo"
            src="https://github.githubassets.com/images/modules/logos_page/GitHub-Logo.png" height="40px">
        </a>
      </div>
    </div>

  </div>
</body>

</html>