<?php
//1.  DB接続します
$pdo=new PDO('mysql:dbname=an;charset=utf8; host=localhost', 'root', '');

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT favorite,count(id) as cnt FROM an_table group by favorite ORDER BY cnt DESC");

//３．SQL実行
$flag = $stmt->execute();

//４データ表示
$view="";//初期値が空（null）
$label="";//初期値が空（null）グラフのラベル
$number="";//初期値が空（null）グラフの票数
if($flag==false){
  $view = "SQLエラー";
  
}else{
    $juni = 1;
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //5.✴︎表示文字列を作成→変数に追記で代入(tableでもlistでもおけ)
      //($view = '<p>'$view .$result['name'].','.$result['email'].'</p>'; と同じ
    $view .= '<tr><td>'.$juni.'</td><td>'.$result['favorite'].'</td><td>'.$result['cnt'].'0</td></tr>';
      $label .= '"'.$result['favorite'].'"'. ',';
      $number .= $result['cnt']. '0,';
      $juni = $juni +1; 
  }
    $number .= '0';
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
<style>div{padding: 10px;font-size:16px;}</style>
<script>
    function modoru(){
        location.href = "index.html";
    }
</script>
 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="dist/Chart.bundle.js"></script>
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>
<
<body id="main" style="background-image:url(img/bg.jpg);">
    <div id="count">
<!-- Head[Start] -->
<header>
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
      <h2>投票RANKING</h2>
    </div>
  </nav>
</header>
<!-- Head[End] -->
<!-- Main[Start] -->
<div>
    <div class="container">
    <table>
        <tr>
            <th>順位</th>
            <th>曲名</th>
            <th>票数</th>
        </tr>
        <?=$view?>
    </table>
    </div>
  </div>
  <div id="container" style="width: 64%;">
        <canvas id="canvas"></canvas>
    </div>
    <p><input type="button" name="" value="トップへ戻る" onclick="modoru()"></p>
</div>
<!-- Main[End] -->

<!--棒グラフ処理start-->
<script>
        var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
        };
        var randomColorFactor = function() {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function() {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
        };
        var barChartData = {
            labels: [<?=$label?>],
            datasets: [{
                label: '投票数',
                backgroundColor: "rgba(220,220,220,0.5)",
                data: [<?=$number?>]
            }
                
            ]
        };
//     #canvasに表示させる
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    // Elements options apply to all of the options unless overridden in a dataset
                    // In this case, we are setting the border of each bar to be 2px wide and green
                    elements: {
                        rectangle: {
                            borderWidth: 10,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        display: false,
                    },
                    title: {
                        display: true,
                        text: '集計結果'
                    },
                      //縦軸の目盛りの上書き許可。これ設定しないとscale関連の設定が有効にならないので注意。
                    scaleOverride : true,

                    //以下設定で、縦軸のレンジは、最小値0から5区切りで35(0+5*7)までになる。
                    //縦軸の区切りの数
                    scaleSteps : 1,
                    //縦軸の目盛り区切りの間隔
                   scaleStepWidth : 1,
                   //縦軸の目盛りの最小値
                   scaleStartValue : 1,

                }
            });
        };
    </script>
    <!--棒グラフ処理end-->
</div><!--#count-->
</body>
</html>
