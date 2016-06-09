<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<title>회원가입</title>
</head>
<body>
	<form action="./SignUpCheck.php" method="post">
			<label>ID: <input type="text" name="member_id"></label><br>
			<label>PW: <input type="password" name="member_pw"></label><br>
			<label>닉네임: <input type="text" name="member_nickname"></label><br>
			성별: <label><input type="radio" name="member_gender" value="m">남자</label> <label><input type="radio" name="member_gender" value="f">여자</label><br>
			<label>생년월일: <input type="date" name="member_birthyear" placeholder="2016-03-01"></label><br>
			<input type="submit" value="가입">
	</form>
</body>
</html>