<?php
//1.  DB接続します
$pdo=new PDO('mysql:dbname=an;charset=utf8; host=localhost', 'root', '');

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM an_table");

//３．SQL実行
$flag = $stmt->execute();

//４データ表示
$view="";
if($flag==false){
  $view = "SQLエラー";
  
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //5.✴︎表示文字列を作成→変数に追記で代入(tableでもlistでもおけ)
      //($view = '<p>'$view .$result['name'].','.$result['email'].'</p>'; と同じ
    $view .= '<tr><td>'.$result['name'].'</td><td>'.$result['email'].'</td><td>'.$result['age'].'</td><td>'.$result['favorite'].'</td></tr>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<script>
    function modoru(){
        location.href = "top.php";
    }
</script>
</head>
<body id="main">
<div id="select">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">登録リスト一覧</a>
      <input type="button" name="" value="トップへ戻る" onclick="modoru()">
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <table>
        <tr>
            <th>名前</th>
            <th>mail</th>
            <th>年齢</th>
            <th>お気に曲</th>
        </tr>
        <?=$view?>
    </table>
    </div>
  </div>
</div>
<!-- Main[End] -->
</div>
<!--#select-->
</body>
</html>
