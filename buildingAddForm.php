<!doctype html>
<html lang="ko">
<head>
	<title>건물 추가 페이지</title>
</head>
<body>
	<form action="./buildingAdd.php" method="post">
	<?php
		$lat = $_GET['lat'];
		$lng = $_GET['lng'];
		echo '<label>x축(lat): <input type="text" name="lat" value="'.$lat.'"></label><br>';
		echo '<label>y축(lng): <input type="text" name="lng" value="'.$lng.'"></label><br>';
	?>
			<input type="submit" value="추가">
	</form>
</body>
</html>
