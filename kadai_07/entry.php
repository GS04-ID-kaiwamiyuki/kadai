 <!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>POSTデータ登録</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">

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
<h2>Entry Form</h2>

</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php" id="form01" >
  <div class="#">
   <fieldset>
    <legend>ファンクラブ入会フォーム</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>Email：<input type="text" name="email"></label><br>
     <label>年齢：<input type="text" name="age"></label><br>
     <label>好きな曲：<select name="favorite">
        <option value="">選択してください</option>
        <option value="ポリリズム">ポリリズム</option>
        <option value="チョコレートディスコ">チョコレートディスコ</option>
        <option value="マカロニ">マカロニ</option>
        <option value="FAKE IT">FAKE IT</option>
        <option value="ねえ">ねえ</option>
    </select>
    </label><br>
     <input type="button" value="送信" onclick="FormSubmit();">
    </fieldset>
  </div>
<!--  ,#-->
</form>
<!-- Main[End] -->
</div>
<!--#index-->
</body>
</html>
