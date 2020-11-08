<?php
session_start();
$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊

$alert = "<script type='text/javascript'>alert('ログアウトしました。');location.href = 'https://webapp.massyu.net/game/index.html'</script>";
echo $alert;
?>