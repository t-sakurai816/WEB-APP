<?php
session_start();

// DB情報（elastic beanstalkの環境変数から読み込む）
$host = $_SERVER['DB_HOST'];
$username = $_SERVER['DB_USERNAME'];
$password = $_SERVER['DB_PASSWORD'];
$dbname = $_SERVER['DB_DATABASE'];

// SESSIONから名前を取得
$login_name = $_SESSION['name'];

// SESSIONのIDを代入
$id = $_SESSION['id'];

try {
  $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8";
  $dbh = new PDO($dsn, $username, $password);
  echo "接続成功";
  $sql = "select gold from roulette where id=" . $id;
  $money = $dbh->prepare($sql);
  echo $sql;
  $dbh = null;
  
} catch (PDOException $e) {
  // エラーのときエラーメッセージ
  $alert = $e->getMessage();
  echo $alert;
}



if (isset($_SESSION['id'])) {//ログインしているとき
    $print_name = 'Welcome to ' . htmlspecialchars($login_name, \ENT_QUOTES, 'UTF-8') . '!!';
    $print_money = '所持コイン数：' .htmlspecialchars($money, \ENT_QUOTES, 'UTF-8');
} else {//ログインしていない時
  $alert = "<script type='text/javascript'>alert('ログインしていません。ログインしてください');location.href = 'https://webapp.massyu.net/game/index.html'</script>";
  echo $alert;
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ルーレットゲーム</title>
  <!-- css -->
  <link rel="stylesheet" href="./css/select.css">
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
  <!-- JavaScript -->
  <script src="js/input_add.js"></script>
</head>

<body>
  <div class="container">
    <h1>ルーレットゲーム</h1>
    <div class="row">
      <div class="col-sm-12" id="money">
        <!--現在のmoneyを表示-->
        <h3><?php echo $print_name; ?></h3><!--ユーザー名を表示-->
        <h3><?php echo $print_money; ?></h3><!--所持コイン数を表示-->

        <!-- 破線 -->
        <hr>
        <!-- 破線 -->

        <p>BETしたいところを選んでください。</p>
      </div>

      <div class="col-sm-12" id="table">
        <!--表を表示-->
        <!-- BETする数をテーブルから入力する -->
        <div class="table-responsive">
          <!--tableをレスポンシブに-->
          <table class="table table-bordered">
            <!--網目にする-->
            <thead>
              <tr>
                <th></th>
                <th colspan="4"><button type="button" class="btn btn-success btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num-1st12">1st 12</button></th>
                <th colspan="4"><button type="button" class="btn btn-success btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num-2st12">2st 12</button></th>
                <th colspan="4"><button type="button" class="btn btn-success btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num-3st12">3st 12</button></th>
              </tr>
            </thead>
            <tbody>
              <th rowspan="4" class="align-middle"><button type="button" class="btn btn-success btn-md p-0 w-100"
                  data-toggle="modal" data-target="#modal-num0">0</button></th>
              <!--縦連結-->
              <tr>
                <!--上段-->
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num3">3</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num6">6</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num9">9</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num12">12</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num15">15</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num18">18</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num21">21</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num24">24</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num27">27</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num30">30</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num33">33</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num36">36</button></td>
              </tr>
              <tr>
                <!--中段-->
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num2">2</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num5">5</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num8">8</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num11">11</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num14">14</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num17">17</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num20">20</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num23">23</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num26">26</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num29">29</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num32">32</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num35">35</button></td>
              </tr>
              <tr>
                <!--下段-->
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num1">1</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num4">4</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num7">7</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num10">10</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num13">13</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num16">16</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num19">19</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num22">22</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num25">25</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num28">28</button></td>
                <td class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num31">31</button></td>
                <td class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num34">34</button></td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th></th>
                <th colspan="2"><button type="button" class="btn btn-success btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num-1-18">1 - 18</button></th>
                <th colspan="2"><button type="button" class="btn btn-success btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num-even">Even</button></th>
                <th colspan="2" class="bg-red"><button type="button" class="btn btn-danger btn-md p-0 w-100"
                    data-toggle="modal" data-target="#modal-num-red">RED</button></th>
                <th colspan="2" class="bg-black"><button type="button" class="btn btn-dark btn-md p-0 w-100"
                    data-toggle="modal" data-target="#modal-num-black">BLACK</button></th>
                <th colspan="2"><button type="button" class="btn btn-success btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num-odd">Odd</button></th>
                <th colspan="2"><button type="button" class="btn btn-success btn-md p-0 w-100" data-toggle="modal"
                    data-target="#modal-num19-36">19 - 36</button></th>
              </tr>
            </thead>

          </table>
        </div>
      </div>
    </div>
    <form
      oninput="result.value = input_add(number_1st12.value,number_2st12.value, number_3st12.value,number_0.value,number_1.value,number_2.value,number_3.value,number_4.value,number_5.value,number_6.value,number_7.value,number_8.value,number_9.value,number_10.value,number_11.value,number_12.value,number_13.value,number_14.value,number_15.value,number_16.value,number_17.value,number_18.value,number_19.value,number_20.value,number_21.value,number_22.value,number_23.value,number_24.value,number_25.value,number_26.value,number_27.value,number_28.value,number_29.value,number_30.value,number_31.value,number_32.value,number_33.value,number_34.value,number_34.value,number_35.value,number_36.value,number_1_18.value,number_even.value,number_red.value,number_black.value,number_odd.value,number_19_36.value)"
      action="result.php" method="post">
      <!-- modal-1st12 -->
      <div class="modal fade" id="modal-num-1st12" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-1st12">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_1st12" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-2st12 -->
      <div class="modal fade" id="modal-num-2st12" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-2st12">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_2st12" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-3st12 -->
      <div class="modal fade" id="modal-num-3st12" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-3st12">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_3st12" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-1-18 -->
      <div class="modal fade" id="modal-num-1-18" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-1-18">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_1_18" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-even -->
      <div class="modal fade" id="modal-num-even" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-even">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_even" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-red -->
      <div class="modal fade" id="modal-num-red" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-red">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_red" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-black -->
      <div class="modal fade" id="modal-num-black" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-black">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_black" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-odd -->
      <div class="modal fade" id="modal-num-odd" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-odd">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_odd" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal-19-36 -->
      <div class="modal fade" id="modal-num-19-36" tabindex="-1" role="dialog" aria-labelledby="label1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num-19-36">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_19_36" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal0 -->
      <div class="modal fade" id="modal-num0" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num0">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_0" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal1 -->
      <div class="modal fade" id="modal-num1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num1">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_1" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal2 -->
      <div class="modal fade" id="modal-num2" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num2">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_2" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal3 -->
      <div class="modal fade" id="modal-num3" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num3">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_3" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal4 -->
      <div class="modal fade" id="modal-num4" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num4">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_4" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal5 -->
      <div class="modal fade" id="modal-num5" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num5">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_5" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal6 -->
      <div class="modal fade" id="modal-num6" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num6">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_6" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal7 -->
      <div class="modal fade" id="modal-num7" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num7">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_7" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal8 -->
      <div class="modal fade" id="modal-num8" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num8">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_8" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal9 -->
      <div class="modal fade" id="modal-num9" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num9">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_9" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal10 -->
      <div class="modal fade" id="modal-num10" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num10">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_10" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal11 -->
      <div class="modal fade" id="modal-num11" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num11">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_11" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal12 -->
      <div class="modal fade" id="modal-num12" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num12">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_12" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal13 -->
      <div class="modal fade" id="modal-num13" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num13">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_13" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal14 -->
      <div class="modal fade" id="modal-num14" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num14">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_14" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal15 -->
      <div class="modal fade" id="modal-num15" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num15">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_15" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal16 -->
      <div class="modal fade" id="modal-num16" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num16">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_16" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal17 -->
      <div class="modal fade" id="modal-num17" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num17">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_17" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal18 -->
      <div class="modal fade" id="modal-num18" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num18">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_18" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal19 -->
      <div class="modal fade" id="modal-num19" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num19">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_19" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal20 -->
      <div class="modal fade" id="modal-num20" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num20">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_20" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal21 -->
      <div class="modal fade" id="modal-num21" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num21">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_21" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal22 -->
      <div class="modal fade" id="modal-num22" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num22">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_22" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal23 -->
      <div class="modal fade" id="modal-num23" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num23">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_23" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal24 -->
      <div class="modal fade" id="modal-num24" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num24">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_24" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal25 -->
      <div class="modal fade" id="modal-num25" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num25">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_25" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal26 -->
      <div class="modal fade" id="modal-num26" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num26">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_26" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal27 -->
      <div class="modal fade" id="modal-num27" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num27">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_27" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal28 -->
      <div class="modal fade" id="modal-num28" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num28">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_28" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal29 -->
      <div class="modal fade" id="modal-num29" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num29">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_29" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal30 -->
      <div class="modal fade" id="modal-num30" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num30">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_30" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal31 -->
      <div class="modal fade" id="modal-num31" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num31">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_31" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal32 -->
      <div class="modal fade" id="modal-num32" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num32">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_32" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal33 -->
      <div class="modal fade" id="modal-num33" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num33">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_33" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal34 -->
      <div class="modal fade" id="modal-num34" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num34">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_34" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal35 -->
      <div class="modal fade" id="modal-num35" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num35">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_35" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal36 -->
      <div class="modal fade" id="modal-num36" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label-num36">何枚BETする？</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label>BET枚数:<input type="number" name="number_36" value="0"></label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-num>OK</button>
            </div>
          </div>
        </div>
      </div>
      <div class="result">
        <output name="result"></output>
      </div>
      <button type="submit" class="btn btn-primary">ルーレットをまわす！</button>
    </form>
  </div>

</body>


</html>