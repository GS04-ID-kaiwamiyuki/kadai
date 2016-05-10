 <!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>POSTデータ登録</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
 <link href="IconHoverEffects/css/component.css" type="text/css" rel="stylesheet" media="all">
 <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
 <script src="js/jquery.scrollTo.min.js" type="text/javascript"></script> 
<script src="js/jquery.easing.min.js" type="text/javascript"></script> 
<script src="js/jquery.fullContent.min.js" type="text/javascript"></script>  
  <script>
    function itiran(){
        location.href = "select.php";
    }
    function touroku(){
        location.href = "index.php";
    }
     function osiran(){
        location.href = "count.php";
    }
  </script>
</head>

<body id="top">
<!-- メインページ -->
<div id="" >
    <header class="clearfix">
        <h1 class="left"><img src="img/logo.png"></h1>
        <img class="right" src="img/catch.png">
    </header>
    <input type="button" name="" value="会員一覧" onclick="itiran()">
    <input type="button" name="" value="登録画面へ戻る" onclick="touroku()">
    <input type="button" name="" value="推し曲ランキング" onclick="osiran()">
    <!--メインビジュアル-->
    <div class="main_img"></div>
    <div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3b">
        <a href="#stage1" class="hi-icon hi-icon-images">あああ</a>
        <a href="#stage3" class="hi-icon hi-icon-pencil">Edit</a>
        <a href="#stage4" class="hi-icon hi-icon-link">Link</a>
        <a href="#set-3" class="hi-icon hi-icon-mail">Mail</a>
        <a href="#set-3" class="hi-icon hi-icon-location">Location</a>
    </div>
</div>
<!-- //メインページ -->
<!-- movieページ -->
<div id="">
    <h2 class="inner">MOVIE</h2>
    <p>2016/03/30<br>Perfumeの新曲『FLASH』公開！</p>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/q6T0wOMsNrI" frameborder="0" allowfullscreen></iframe>
</div>
<!-- //movieページ -->
   <!-- newsページ -->

        <h2>NEWS</h2>

<!-- //newsページ -->

</body>
</html>