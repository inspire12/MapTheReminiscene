<!doctype html>
<html lang="ko">
<head>
	<title>건물 내 장소 추가 페이지</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body id="marketAddForm">
	<form action="./marketAdd.php" method="post">
	<?php
		$building_no = (int)$_SERVER['QUERY_STRING'];
		echo '<label>건물ID: <input type="text" name="building_no" value="'.$building_no.'" readonly></label><br>';
	?>
			<label>장소 이름: <input type="text" name="market_name"></label><br>
			<label>설명:<br><textarea rows="4" cols="50" name="descript"></textarea><br>
			<label>층수: <input type="number" name="floor"></label><br>
			<label>연도: <input type="number" name="year" placeholder="2016"></label><br>
			이미지 첨부 : <input type="file" name="img"><br>
			<input type="submit" value="추가">
	</form>
</body>
</html>