<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WEBアプリケーション構築実験</title>

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
      <p>DB connection check : <?php include('./rds-check-connect.php');?></p>

      <div>
        <h2>Other Pages</h2>

        <li><a href="./sample.php">CIT Pic (lesson1)</a></li>
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