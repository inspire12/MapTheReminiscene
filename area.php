<!--
각 장소별 게시판 목록 페이지
- 과거, 현재 모습 목록
- 장소 이름, 위치 등 간단한 설명
- 글쓰기 폼
- 글목록(내용) 리스트
-->

<?php
@require('conn.php')
?>
<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>장소 페이지</title>
  <link rel="stylesheet" href="./style.css">
 </head>

<?php
$num = (int)$_SERVER['QUERY_STRING'];
$marketData = getMarketData($num);

if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['post'])){

	if(!$_POST['name'] || !$_POST['password'] || !$_POST['post']){
		echo("<script language='javascript'>alert('입력값이 없음!');</script>");
		exit(0);
	}

	$name = $_POST['name'];
	$password = $_POST['password'];
	$post = $_POST['post'];
	$tag = "";
	$img = "";

	writePost($num, $name, $password, $post, $tag, $img);
}

if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['comment'])){
	if(!$_POST['name'] || !$_POST['password'] || !$_POST['comment']){
		echo("<script language='javascript'>alert('입력값이 없음!');</script>");
		exit(0);
	}

	$id = $_POST['name'];
	$password = $_POST['password'];
	$comment = $_POST['comment'];
	$postNumber = $_POST['postNumber'];

	writeComment($postNumber, $comment, $id, $password);

}
?>

 <body id="area">
	<header>
		<!--<ul id="areaList">
			<li>카페2012</li>
			<li>카페2013</li>
			<li>카페2014</li>
			<li>카페2015</li>
		</ul>-->
		<h1><?php
			echo $marketData[0]['market_name'];

			$board = readPost($num);
		?>
		</h1>
		<p id="descript"><?php echo $marketData[0]['descript']; ?></p>
		<form id="areaForm" action="./area.php?<?php echo $num; ?>" method="post">
			<input type="text" placeholder="글쓴이" name="name">
			<input type="password" placeholder="암호" name="password"><br>
			<textarea cols="58" rows="3" name="post"></textarea>
			<input type="submit" value="글 등록"><br>
			이미지 첨부 : <input type="file" name="img">
		</form>
	</header>
	<article>
		<ol class="comment">			
			
			<?php 
			for($i=count($board)-1; $i >= 0; $i--){
				echo "<li> <!-- 글 출력 -->";
				echo "<div class='writer'>".$board[$i]['id']."</div>"; 
				echo "<div class='time'>".$board[$i]['date']."</div>";
				echo "<div class='edit'><a href='./editPost.php?".$board[$i]['postNumber']."' target='_blank'>수정</a> / <a href='./deletePost.php?".$board[$i]['postNumber']."' target='_blank'>삭제</a></div>";
				echo "<p>".$board[$i]['post']."</p>";
				echo "<form action='./area.php?".$num."' method='post'> <!-- 댓글 작성 폼 -->";
				echo "<input type='hidden' value='".$board[$i]['postNumber']."' name='postNumber'>";
				echo "<input type='text' placeholder='글쓴이' name='name'><input type='password' placeholder='암호' name='password'><br><textarea cols='58' rows='1' name='comment'></textarea><input type='submit' value='댓글 등록'></form>";
				echo "</li>";
				
				$comment = readComment($board[$i]['postNumber']);
				if(count($comment) > 0){
					echo "<ol class='commentChild'> <!-- 댓글 출력 -->";

					for($j=0; $j<count($comment); $j++){
						echo "<li>";
						echo "<div class='writer'>".$comment[$j]['id']."</div>";
						echo "<div class='time'>".$comment[$j]['date']."</div>";
						echo "<p>".$comment[$j]['comment']."</p>";
						echo "</li>";
					}

					echo "</ol>";
				}
			}

			?>
		</ol>
	</article>
 </body>
</html>
