<?php

// APIkeyまで書く
$base_url = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=3b8f84d17843fb3e';

$lat = '35.6809591'; //フォームから受け取った値にする
$lng = '139.7673068'; //フォームから受け取った値にする
$range = '5';
$type = 'special';
$count = '7';
$format= 'json';

$url = $base_url.'&lat='.$lat. '&lng='.$lng. '&range='.$range. '&type='.$type. '&count='.$count. '&format='.$format;
$response = file_get_contents(
  $base_url.'&lat='.$lat. '&lng='.$lng. '&range='.$range. '&type='.$type. '&count='.$count. '&format='.$format
);
// http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=3b8f84d17843fb3e&lat=35.6809591&lng=139.7673068&range=5&type=special&count=5&format=json

// json結果をデコード
$result = json_decode($response,true);
// print_r($result['results']['shop']);

// for ($i = 0; $i < $count; $i++){
//   echo $result['results']['shop'][$i]['name']."\n"; //店名
//   echo $result['results']['shop'][$i]['address']."\n"; //住所
//   echo $result['results']['shop'][$i]['card']."\n"; //カード利用情報
//   echo $result['results']['shop'][$i]['catch']."\n"; //キャッチコピー
//   echo $result['results']['shop'][$i]['photo']['pc']['l']."\n"; //写真
//   echo $result['results']['shop'][$i]['urls']['pc']."\n"."\n"."\n"; //店のURL

// };

// echo $result['results']['shop']['0']['name']; //店名
// echo $result['results']['shop']['0']['address']; //住所
// echo $result['results']['shop']['0']['card']; //カード利用情報
// echo $result['results']['shop']['0']['catch']; //キャッチコピー
// echo $result['results']['shop']['0']['photo']['pc']['l']; //写真

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>
    <!-- Material-icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <!-- css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/card.css">
</head>

<body>
  <header>
    <h1>GOURMET</h1>
  </header>
  <div class="main">
    <div class="container">
      <div class="row">
        <?php
        for ($num = 0; $num < $count; $num++){
          // <!---スマホ1つ,タブレット2つ,PC3つ-->
          echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
              <img src='.$result['results']['shop'][$num]['photo']['pc']['l'].' alt='.$result['results']['shop'][$num]['name']. 'class="shop-img">
              <div class="card-body">
                <h5 class="shop-name">'.$result['results']['shop'][$num]['name'].'</h5>
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <div class="d-flex align-items-center">
                      <a href="#" class="nav-link">住所</a>
                      <button class="btn btn-link btn-sm" data-target="#shop-address-'.$num.'" data-toggle="collapse">
                        <i class="material-icons">keyboard_arrow_down</i>
                      </button>
                    </div>
                    <ul id="shop-address-'.$num.'" class="collapse list-unstyled pl-3"><!--idはPHPで動的に変える-->
                      <p class="shop-address">'.$result['results']['shop'][$num]['address'].'</p>
                    </ul>
                  </li>
                </ul>
                
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <div class="d-flex align-items-center">
                      <a href="#" class="nav-link">キャッチコピー</a>
                      <button class="btn btn-link btn-sm" data-target="#shop-catch-'.$num.'"  data-toggle="collapse"><!--idはPHPで動的に変える-->
                        <i class="material-icons">keyboard_arrow_down</i>
                      </button>
                    </div>
                    <ul id="shop-catch-'.$num.'" class="collapse list-unstyled pl-3">
                      <p class="shop-catch">'.$result['results']['shop'][$num]['catch'].'</p>
                    </ul>
                  </li>
                </ul>
                <p class="shop-card">カード：利用可</p>
                <!--最大45文字-->
                <a href='.$result['results']['shop'][$num]['urls']['pc'].' target="_blank"
                  rel="noopener noreferrer" class="btn btn-primary">お店のホームページへ</a>
              </div>
            </div>
          </div>';
        };
        ?>
        

      </div>
    </div>
  </div>



  <footer>
    <div class="github_logo"><a href="https://github.com/t-sakurai816/liquor-front" target="blank"><img
          alt="github-logo" src="https://github.githubassets.com/images/modules/logos_page/GitHub-Logo.png"
          height="40px">
      </a>
      <div class="credit">
        <div class="hotpapper">
          Powered by <a href="http://webservice.recruit.co.jp/">ホットペッパー Webサービス</a>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>