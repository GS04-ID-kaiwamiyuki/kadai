<?php
// //入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["age"]) || $_POST["age"]=="" ||
  !isset($_POST["favorite"]) || $_POST["favorite"]=="" 
){
  exit('ParamError');
}
  //1. POSTデータ取得(okであればうけとる)
$name = $_POST["name"];
$email = $_POST["email"];
$favorite = $_POST["favorite"];
$age = $_POST["age"];

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}
  //３．データ登録SQL作成 （値の変な記号とか勝手に削除してくれる)
  $stmt = $pdo->prepare("INSERT INTO gs_an_table (id, name, email, age, favorite, indate )VALUES(NULL, :a1, :a2, :a3, :a4, sysdate())");
  $stmt->bindValue(':a1', $name);//$name の値をクリーンに(安全)して :a1へ
  $stmt->bindValue(':a2', $email);
  $stmt->bindValue(':a3', $age);
  $stmt->bindValue(':a4', $favorite);
  $status = $stmt->execute();//sqlを実行

  //４．データ登録処理後
  if($status==false){
     //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }else{
//    //５．index.phpへリダイレクト
//      header("Location: index.html");
//      exit();
  }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
<meta charset="UTF-8">
<title>登録完了</title>
<link href="css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body id="insert" class="wrap">
<h2>Thank You!</h2>
<p class="inner"><?=$name?>さん、ご登録ありがとうございます♡</p>
<a href="index.html" class="b_btn">SITE TOP ▶︎</a>
</body>
</html>