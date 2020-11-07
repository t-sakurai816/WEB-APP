$(() => {

  const speed = 10;   //ルーレットの回転速度
  const divide = 37;   //ルーレットの分割数
  const timeout = 2000;   //○秒後に停止

  //停止位置の設定。1～360までの乱数を取得して挿入する
  const stopAngle = Math.round(Math.random() * 360 + 0.5);

  //ルーレットの角度の変数。停止位置の値を初期値に設定する
  let angle = stopAngle;

  //ルーレットの分割数から1エリア分の角度を求める。今回は5分割なので72が入ってます
  const section = 360 / divide;

  //停止位置がどのエリアにあるか調べ、該当する番号をstopNumberに格納
  for (i = 1; i <= divide; i++) {
    if (section * (i - 1) + 1 <= stopAngle && stopAngle <= section * i) {
      stopNumber = i;
    }
  };


  //クルクル処理。5ミリ秒毎にspeedの数値分画像が回転します。
  let rotation = setInterval(function () {
    $("#mato").rotate(angle);
    angle += speed;
  }, 5);


  //timeout秒後に停止させる処理
  setTimeout(() => {

    //クルクル処理をしているsetIntervalをclear
    clearInterval(rotation);

    //setIntervalで増えた余分な数値を減らし、逆回転を防ぐためにマイナス値にする
    angle = angle % 360 - 360;

    //停止位置までのアニメーション。完了するとresult()が実行される
    $("#mato").rotate({
      angle: angle,
      animateTo: stopAngle,
      callback: result
    });

    //ルーレットの停止処理に入ったので針の画像を静止画へ変更
    $("#hari img").attr('src', $("#hari img").attr('src').replace('gif', 'png'));

  }, timeout);


  //ルーレット停止後に実行される処理
  const result = () => {
    switch (stopNumber) {

      // //0の時の処理
      // case 0:
      //   $("#result span").text("0でした！")
      //   break;

      //1の時の処理
      case 1:
        $("#result span").text("1でした！")
        break;

      //2の時の処理
      case 2:
        $("#result span").text("2でした！")
        break;

      //3の時の処理
      case 3:
        $("#result span").text("3でした！")
        break;

      //4の時の処理 
      case 4:
        $("#result span").text("4でした！")
        break;

      //5の時の処理
      case 5:
        $("#result span").text("5でした！")
        break;

      //6の時の処理
      case 6:
        $("#result span").text("6でした！")
        break;

      //7の時の処理
      case 7:
        $("#result span").text("7でした！")
        break;

      //8の時の処理
      case 8:
        $("#result span").text("8でした！")
        break;

      //9の時の処理 
      case 9:
        $("#result span").text("9でした！")
        break;

      //10の時の処理
      case 10:
        $("#result span").text("10でした！")
        break;
      //11の時の処理
      case 11:
        $("#result span").text("11でした！")
        break;

      //12の時の処理
      case 12:
        $("#result span").text("12でした！")
        break;

      //13の時の処理
      case 13:
        $("#result span").text("13でした！")
        break;

      //14の時の処理 
      case 14:
        $("#result span").text("14でした！")
        break;

      //15の時の処理
      case 15:
        $("#result span").text("15でした！")
        break;

      //16の時の処理
      case 16:
        $("#result span").text("16でした！")
        break;

      //17の時の処理
      case 17:
        $("#result span").text("17でした！")
        break;

      //18の時の処理
      case 18:
        $("#result span").text("18でした！")
        break;

      //19の時の処理 
      case 19:
        $("#result span").text("19でした！")
        break;

      //20の時の処理
      case 20:
        $("#result span").text("20でした！")
        break;

      //21の時の処理
      case 21:
        $("#result span").text("21でした！")
        break;

      //22の時の処理
      case 22:
        $("#result span").text("22でした！")
        break;

      //23の時の処理
      case 23:
        $("#result span").text("23でした！")
        break;

      //24の時の処理 
      case 24:
        $("#result span").text("24でした！")
        break;

      //25の時の処理
      case 25:
        $("#result span").text("25でした！")
        break;

      //26の時の処理
      case 26:
        $("#result span").text("26でした！")
        break;

      //27の時の処理
      case 27:
        $("#result span").text("27でした！")
        break;

      //28の時の処理
      case 28:
        $("#result span").text("28でした！")
        break;

      //29の時の処理 
      case 29:
        $("#result span").text("29でした！")
        break;

      //30の時の処理
      case 30:
        $("#result span").text("30でした！")
        break;
      //31の時の処理
      case 31:
        $("#result span").text("31でした！")
        break;

      //32の時の処理
      case 32:
        $("#result span").text("32でした！")
        break;

      //33の時の処理
      case 33:
        $("#result span").text("33でした！")
        break;

      //34の時の処理 
      case 34:
        $("#result span").text("34でした！")
        break;

      //35の時の処理
      case 35:
        $("#result span").text("35でした！")
        break;

      //36の時の処理
      case 36:
        $("#result span").text("36でした！")
        break;

    };
  };
});