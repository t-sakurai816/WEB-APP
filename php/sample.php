<html>
<head>
    <title>インターネット経由でHTMLデータ（の一部）を取得し，表示する</title>
</head>
    <body>
        <?php
	//PHPで書かれたプログラムの開始を表す記号

        $url = "http://www-ns8.bb.net.it-chiba.ac.jp/test.txt";
        //HTMLデータ取得先のURL（熊本研究室のサーバ上にあるテキストファイル）を
	//変数$urlにセットする

        $xml_String = file_get_contents($url);
        //HTMLデータ（の一部）を取得し、変数$xml_Stringにセットする
	//プロキシはなし

        //取得したHTMLデータ（の一部）をそのままブラウザ上に出力する
        echo $xml_String;

        ?>
        <!--
        PHPで書かれたプログラムの終わりを表す記号
	HTML側のコメント作成用記号。複数行に対応可能
        -->
    </body>
</html>
