<!-- Building Page 
	층별로 가게 출력 -->
<?php
@require('conn.php')
?>
<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>건물 페이지</title>
  <link rel="stylesheet" href="./style.css">
 </head>
 <body id="building">
 <?php
 	$building_no = (int)$_SERVER['QUERY_STRING'];

	$market = getMarketList($building_no);

	echo "<ol id='marketList'> <!-- 장소 출력 -->";

	for($i=0; $i<count($market); $i++){
		echo "<li>";
		echo "<a href='./area.php?".$market[$i]['market_no']."'>";
		echo $market[$i]['market_name']."(".$market[$i]['floor']."층, ".$market[$i]['year'].")";
		echo ": ".$market[$i]['descript'];
		echo "</a>";
		echo "</li>";
	}

	echo "</ol>";
	echo "<a href='./marketAddForm.php?".$building_no."' target='_blank'>장소 추가(addMarket)</a>";
 ?>
 </body>
</html>