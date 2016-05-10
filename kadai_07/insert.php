<?php
  //1. POSTデータ取得（）
$name = $_POST["name"];
$email = $_POST["email"];
$favorite = $_POST["favorite"];
$age = $_POST["age"];


  //2. DB接続します
$pdo=new PDO('mysql:dbname=an;charset=utf8; host=localhost', 'root', '');

  //３．データ登録SQL作成 （値の変な記号とか勝手に削除してくれる)
  $stmt = $pdo->prepare("INSERT INTO an_table (id, name, email, age, favorite, indate )VALUES(NULL, :name, :email, :age, :favorite, sysdate())");
  $stmt->bindValue(':name', $name);//$name の値をクリーンに(安全)して :nameへ
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':age', $age);
  $stmt->bindValue(':favorite', $favorite);
  $status = $stmt->execute();//sqlを実行

  //４．データ登録処理後
  if($status==false){
    //Errorの場合$status=falseとなり、エラー表示
    echo "SQLエラー";
    exit;
    
  }else{
//    //５．index.phpへリダイレクト
//      header("Location: top.php");
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
<body id="insert">
<h1><?=$name?>さん、ご登録ありがとうございます♡</h1>
<a href="index.html">サイトTOPへ</a>
</body>
</html>