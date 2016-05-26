<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>LOGIN</title>
		<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
	</head>
	<body>
<div id="index" class="wrap">
<<header id="header" class="#">
	<h2>Sign up Form</h2>
</header><!-- /header -->
<?php
//1. HTML_STARTをインクルード
$title = "LOGIN"; //html_start.phpのtitleタグに表示
include("html_start.php");
?>
<!-- login_act.php は認証処理用のPHPです。 -->
	<h3>ログイン画面</h3>
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid" />
PW:<input type="password" name="lpw" />
<input type="submit" value="LOGIN" />
</form>

<?php
//2. HTML_ENDをインクルード
include("html_end.php");
?>	
</div>
	</body>
	</html>	