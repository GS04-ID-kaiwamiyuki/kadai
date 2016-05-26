<!-- <?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //$view .= $result["name"]."[".$result["indate"]."]<br>";
      $view.= '<a href="detail.php?id='.$result["id"].'">'.$result["name"].'</a><br>';
  }
}
?> -->


<?php
/************************************************************
 *  ログイン認証OKの場合表示
 ************************************************************/
//1. SESSION開始
session_start();
include("func.php");

//2. セッションチェック(前ページのSESSION＿IDと現在のsession_idを比較)
sessionCheck();
//★SESSION IDを確認したい場合(検証→Resources→Cookies)
//echo session_id();


//セッションハイジャック対策（追加してください！）


//2. 認証後にSetされたSESSION変数を受け取り表示
$name = "<p>名前： " . $_SESSION["name"] . "</p>";

//3. 管理者FLGを表示
if( $_SESSION["kanri_flg"]==1 ) {
  $admin  =  "<p>権限：管理者</p>";
  $admin .=  '<p><a href="#">管理者メニュー</a></p>';
}else if( $_SESSION["kanri_flg"]==0 ){
  $admin = "<p>権限：一般</p>";
}

//1.  DB接続します
  $pdo = db();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

//３データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC) ){
    //管理FLGで表示を切り分けたりしてみましょう！！！（追加してください！）
    $view .= '<p><a href="detail.php?id='.$result["id"].'">'.$result["name"]." : ".$result["email"].'</a></p>';
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登録データ一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<script>
    function modoru(){
        location.href = "index.html";
    }
</script>
</head>
<body id="main">
<div id="select" class="wrap">
<!-- Head[Start] -->
<header>
  <nav class="navbar">
    <div class="container-fluid">
<h2>member list</h2>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <div style="height:500px; width:1160px; overflow-y:scroll;">
        <?=$view?>
    </div>
  </div>
      <p class="b_btn"><input type="button" name="" value="TOP PAGE" onclick="modoru()"></p>
</div>
<!-- Main[End] -->
</div>
<!--#select-->
</body>
</html>
