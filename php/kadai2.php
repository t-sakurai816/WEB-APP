<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Web APIの利用例</title>
</head>
<body>

<h1 align="center">「郵便番号⇒住所」変換システム</h1>

<?php
   //入力された郵便番号を変数にセットする
   if(isset($_GET['yonketa'])&&isset($_GET['sanketa'])) {
      $zn=$_GET['sanketa'].$_GET['yonketa'];
   } else {
      $zn="2750016";
      $_GET['sanketa']="275";
      $_GET['yonketa']="0016";
   }
?>
<!-- form文で郵便番号を入力する -->
<form method="GET" action="kadai2.php">
   郵便番号： <input type="text" name="sanketa" size="2" value=<?php echo $_GET['sanketa']; ?>>-<input type="text" name="yonketa" size="4" value=<?php echo $_GET['yonketa']; ?>>
   <input type="submit" value="変換する">
</form>

<?php
   //郵便番号API用リクエストURLを生成する
   $req = "http://zip.cgis.biz/xml/zip.php?zn=".$zn;
   //郵便番号APIを用いてXMLデータをダウンロードする
   $xml= simplexml_load_file($req);

   echo "<font color=red>取得したXMLデータをprint_r関数を用いて画面上に表示する．</font><br>\n";
   print_r($xml);
   echo "<br><br>\n";

   echo "<font color=red>取得したXMLデータを表形式に整理して画面上に表示する．</font><br>\n";
   $tmp = json_decode(json_encode($xml), true);
   //XMLデータから目的とするデータを抽出する
   $state_kana = $tmp["ADDRESS_value"]["value"]["0"]["@attributes"]["state_kana"];//チバケン
   $city_kana = $tmp["ADDRESS_value"]["value"]["1"]["@attributes"]["city_kana"];//ナラシノシ
   $address_kana = $tmp["ADDRESS_value"]["value"]["2"]["@attributes"]["address_kana"];//ツダヌマ
   $company_kana = $xml; 
   $state = $tmp["ADDRESS_value"]["value"]["4"]["@attributes"]["state"];//千葉県
   $city = $tmp["ADDRESS_value"]["value"]["5"]["@attributes"]["city"];//習志野市
   $address = $tmp["ADDRESS_value"]["value"]["6"]["@attributes"]["address"];//津田沼
   $company = $xml;

   //抽出したデータを表形式に整理して表示する
   if(isset($state)){
      echo "<table>\n";
      echo "<tr><td></td><td>";
      if($state_kana<>"none"){ echo $state_kana;}
      echo "</td><td>";
      if($city_kana<>"none") { echo $city_kana; }
      echo "</td><td>";
      if($address_kana<>"none"){ echo $address_kana; }
      echo "</td>";
      if($company_kana<>"none"){ echo "<td> $company_kana </td>"; }
      echo "</tr>\n";
      echo "<tr><td>住所</td><td> $state </td><td> $city </td><td> $address </td>";
      if($company<>"none"){ echo "<td> $company </td>"; }
      echo "</tr>\n";
      echo "</table>\n";
   } else {
      echo "該当するデータがありませんでした．<br>";
   }
?>
</body>
</html>

