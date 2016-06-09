<!doctype html>

<?php
@require('conn.php');
?>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>MP3 Project</title>
  <link rel="stylesheet" href="./style.css">
 </head>
 <body id="index">
 <div id="container">
 <script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=910b1f77f510f05e488fde171fec51da"></script>
  <!-- -->
  <div id="map"></div>
  <script type="text/javascript" src="./map.js"></script>
  <div id="sidebar">
	  <div id="searchbar">
	  	<form action="./search.php" method="get">
			<input type="text" name="q" size="19"/>
			<input type="submit" value="검색">
		</form>
	  </div>
	  <div id="recent">
	  	<h1>최근 글</h1>
	  	<ul>
<?php
	   $recentList = listPost();
             print($recentList[0]['postNumber']);
             for($i=0; $i< 5; $i++){
                 echo "<li>";
                 echo "<a href='./area.php?".$recentList[$i]['postNumber']."'>";
                 echo $recentList[$i]['id']."-".$recentList[$i]['post'].", ".$recentList[$i]['date'].    ")";
 
                 echo "</a>";
                 echo "</li>";
             }
?>
		</ul>
	  </div>
	  <div id="top_tag">
	  	<h1>인기 태그</h1>
	  	<ul>
	  		<li>태그1</li>
	  		<li>태그2</li>
	  		<li>태그3</li>
	  	</ul>
	  </div>
  </div>
  </div>
 </body>
</html>
