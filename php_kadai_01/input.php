
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>評価機能</title>
<link href="./css/body.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
//***************************************************************************************
//File Read (☆を表示する処理)
//***************************************************************************************
$file = "./files/data.txt";
$fp = fopen($file, "r");                    //読込み用 "r" でファイルをオープン
flock($fp, LOCK_EX);                        //ファイルロック(排他ロック)
$fp_str = fgets($fp);                       //１行読み込み
$array_fp = array();                        //配列初期化：一時受け変数を用意
$array_fp = explode("***" , $fp_str);       //配列に入れる
flock($fp, LOCK_UN);                        //ファイルロック解除
fclose($fp);                                //ファイルを閉じる
if(!is_null($array_fp[0]) && !is_null($array_fp[1])) {
//$array_fp[0] : Total(全ての評価点数を加算した値)
//$array_fp[1] : Count(評価数)
$hosi_value = $array_fp[0] / $array_fp[1];   //計算AVERAGE 
$hosi_echo  = number_format($hosi_value,1);  //現在の評価値表示：小数点(1桁)
$hosi_obj   = number_format($hosi_echo);     //現在の評価値を整数へ⇒☆を表示させる
//整数値=☆の数 を表示
$hj="";
for($i=0; $i<$hosi_obj; $i++){
$hj = $hj."★ ";
}
}

//***************************************************************************************
// File cRead(コメントを表示する処理)
//***************************************************************************************
	function cread() {
		$file02 = "./files/comment.txt";
		$fp02 = fopen($file02, "r");        //読込み用 "r" でファイルをオープン
		flock($fp02, LOCK_SH);            //ファイルロック(共有ロック)
		$i=0;                           //ループ変数初期化
		while(!feof($fp02)) {             //ファイルポインタが終端に到達
			$fp02_str = fgets($fp02);       //1行取得
			echo $fp02_str."<br>";        //表示
			$i++;                       //インクリメント(+1)
		}
		flock($fp02, LOCK_UN);            //ファイルロック解除
		fclose($fp02);                    //ファイルを閉じる
	}
    
//***************************************************************************************
//  (nameを表示する処理)
//***************************************************************************************
	function nread() {
		$file03 = "./files/name.txt";
		$fp03 = fopen($file03, "r");        //読込み用 "r" でファイルをオープン
		flock($fp03, LOCK_SH);            //ファイルロック(共有ロック)
		$i=0;                           //ループ変数初期化
		while(!feof($fp03)) {             //ファイルポインタが終端に到達
			$fp03_str = fgets($fp03);       //1行取得
			echo $fp03_str."<br>";        //表示
			$i++;                       //インクリメント(+1)
		}
		flock($fp03, LOCK_UN);            //ファイルロック解除
		fclose($fp03);                    //ファイルを閉じる
	}
?>


<header><img src="img/header_01.png" style="width:100%;"></header>
<form name="hyoka" method="post" action="output.php">
  <table width="800"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" class="tdC">カスタマーレビュー</td>
  </tr>
  <tr>
    <td class="tdA"><span class="style1"><?=$hj?></span> <br>
    ( <?=$hosi_echo?> / 5.0 )</td>
<!--    <td class="tdA">評価</td>-->
    <td class="tdB">
       <h3>あなたのご意見やご感想を教えてください</h3>
       <p>製品名：レスポンシブWebデザイン「超」実践デザイン集中講義<br><span>山崎大輔</span></p>
        <select name="hosi">
            <option>★の数で選択して評価</option>
            <option value="1">★</option>
            <option value="2">★★</option>
            <option value="3">★★★</option>
            <option value="4">★★★★</option>
            <option value="5">★★★★★</option>
        </select>
        <p><input name="name" type="text" size="50" maxlength="255" placeholder="名前を入力"></p>
        <p><input name="comment" type="text" size="50" maxlength="255" placeholder="コメントを入力"></p>
        <input type="submit" name="Submit" value="カスタマーレビューを投稿する">
    </td>
</tr>
</table>
</form>

<section class="comment_box">
<?php cread(); ?><br><?php nread(); ?>
</section>

</body>
</html>