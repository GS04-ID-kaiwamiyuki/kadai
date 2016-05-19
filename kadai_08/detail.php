 <?php
//1.GETでidを取得
$id = $_GET["id"];

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id=:a1");
$stmt->bindValue(':a1', $id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//
$result = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>POSTデータ変更ページ</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">

<style>
p {
  margin-bottom: 2em;
  }
input {
  width: 200px;
  margin-top: 1em;
  padding: .5em;
  }
input[type="text"] {
  width: 380px;
  -webkit-transition: width .3s;
  transition: width .3s;
  }
input[type="text"]:focus {
  width: 300px;
  }
label {
  display: inline-block;
  max-width: 100%;
  margin: 1px 0 30px !important;
  font-weight: bold;
  }
</style>
<script type="text/javascript">
    //未入力チェック（未入力でアラート表示）
    function check(){
        var namae = document.getElementsByName("name");
        if(namae[0].value == ""){
            alert("名前が未入力ですYO！");
            return 0;
        }
        var email = document.getElementsByName("email");
        if(email[0].value == ""){
            alert("メールが未入力ですYO！");
            return 0;
        }
        var age = document.getElementsByName("age");
        if(age[0].value == ""){
            alert("年齢が未入力ですYO！");
            return 0;
        }
        var favorite = document.getElementsByName("favorite");
        if(favorite[0].value == ""){
            alert("推し曲が未入力ですYO！");
            return 0;
        }
        return 1;
    }
    //フォームの送信処理
    function FormSubmit(){
        if(check() == 1){
          var target = document.getElementById("form01");
          target.method = "post";
          target.submit();
        }
    }
</script>
</head>
<body>
<div id="index" class="wrap">
<!-- Head[Start] -->
<header>

    <div class="container-fluid">
    <div class="navbar-header">
<h2>Edit Form</h2>

</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php?id=<?=$id?>" id="form01" >
  <div class="">
   <fieldset class="inner">
    <h3>データ変更ページ<br>
    ※ 全項目に記入してください</h3>
     <label>名前　：　<input type="text" name="name" value="<?=$result["name"]?>"></label><br>
     <label>Email　：　<input type="text" name="email" value="<?=$result["email"]?>"></label><br>
     <label>年齢　：　<input type="text" name="age" value="<?=$result["age"]?>"></label><br>
     <label>好きな曲：<select name="favorite" value="<?=$result["favorite"]?>">
        <option value="">選択してください</option>
        <option value="ポリリズム">ポリリズム</option>
        <option value="チョコレートディスコ">チョコレートディスコ</option>
        <option value="マカロニ">マカロニ</option>
        <option value="FAKE IT">FAKE IT</option>
        <option value="ねえ">ねえ</option>
    </select>
    </label><br>
     <input type="button" value="送信" onclick="FormSubmit();">
     <a href="deleate.php?id=<?=$id?>">削除</a>
    <a href=select.php>serectへ戻る</a>
    </fieldset>
  </div>
<!--  ,#-->
</form>
<!-- Main[End] -->
</div>
<!--#index-->
</body>
</html>
