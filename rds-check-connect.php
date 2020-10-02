<?php

// DB情報をElasticBeanstalkの環境変数から読み取る

$host = $_SERVER['DB_HOST'];
$username = $_SERVER['DB_USERNAME'];
$password = $_SERVER['DB_PASSWORD'];
$dbname = $_SERVER['DB_DATABASE'];

try {
    require('db-config.php');
} catch ( Exception $ex){
    return true;
}

$link = mysqli_connect($host,$username,$password,$dbname);

// 接続状況をチェックします
if (mysqli_connect_errno()) {
    die("Connection failed : " . mysqli_connect_error() . "\n");
} else {
    echo "Connection Success!!\n";
}

?>