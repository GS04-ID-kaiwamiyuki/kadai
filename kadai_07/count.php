<?php
//1.  DB接続します
$pdo=new PDO('mysql:dbname=an;charset=utf8; host=localhost', 'root', '');

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT favorite,count(id) as cnt FROM an_table group by favorite ORDER BY cnt DESC");

//３．SQL実行
$flag = $stmt->execute();

//４データ表示
$view="";//初期値が空（null）
if($flag==false){
  $view = "SQLエラー";
  
}else{
    $juni = 1;
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //5.✴︎表示文字列を作成→変数に追記で代入(tableでもlistでもおけ)
      //($view = '<p>'$view .$result['name'].','.$result['email'].'</p>'; と同じ
    $view .= '<tr><td>'.$juni.'</td><td>'.$result['favorite'].'</td><td>'.$result['cnt'].'</td></tr>';
      $juni = $juni +1; 
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
<style>div{padding: 10px;font-size:16px;}</style>
<script>
    function modoru(){
        location.href = "top.php";
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
<body id="main">
    <div id="count">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">推し曲投票ランキング</a>
      <input type="button" name="" value="トップへ戻る" onclick="modoru()">
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
  <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
</div>
<!-- Main[End] -->

<!--棒グラフ処理start-->
 <script>
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
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
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: 'Dataset 1',
                backgroundColor: "rgba(220,220,220,0.5)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            },
                       {
                label: 'Dataset 3',
                backgroundColor: "rgba(151,187,205,0.5)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }]
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
                            borderWidth: 2,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart'
                    }
                }
            });
        };
        $('#randomizeData').click(function() {
            var zero = Math.random() < 0.2 ? true : false;
            $.each(barChartData.datasets, function(i, dataset) {
                dataset.backgroundColor = randomColor();
                dataset.data = dataset.data.map(function() {
                    return zero ? 0.0 : randomScalingFactor();
                });
            });
            window.myBar.update();
        });
        $('#addDataset').click(function() {
            var newDataset = {
                label: 'Dataset ' + barChartData.datasets.length,
                backgroundColor: randomColor(),
                data: []
            };
            for (var index = 0; index < barChartData.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }
            barChartData.datasets.push(newDataset);
            window.myBar.update();
        });
        $('#addData').click(function() {
            if (barChartData.datasets.length > 0) {
                var month = MONTHS[barChartData.labels.length % MONTHS.length];
                barChartData.labels.push(month);
                for (var index = 0; index < barChartData.datasets.length; ++index) {
                    //window.myBar.addData(randomScalingFactor(), index);
                    barChartData.datasets[index].data.push(randomScalingFactor());
                }
                window.myBar.update();
            }
        });
        $('#removeDataset').click(function() {
            barChartData.datasets.splice(0, 1);
            window.myBar.update();
        });
        $('#removeData').click(function() {
            barChartData.labels.splice(-1, 1); // remove the label first
            barChartData.datasets.forEach(function(dataset, datasetIndex) {
                dataset.data.pop();
            });
            window.myBar.update();
        });
    </script>
    <!--棒グラフ処理end-->
</div><!--#count-->
</body>
</html>
