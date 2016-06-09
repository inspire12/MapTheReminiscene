<?php
$mysqli = new mysqli("127.0.0.1", "mp3", "projectwall", "mp3");

function writePost($marketNumber, $id, $password, $post, $tag, $image_name){
	global $mysqli;
	$query = "insert into mp3_board (marketNumber,id,password,post,tag,image_name) values('$marketNumber', '$id', '".md5($password)."', '$post', '$tag', '$image_name')";
	$mysqli->query($query);
}

function listPost(){
      global $mysqli;
      $i=0;
      $query = "select * from mp3_board order by date desc limit 0 , 5";
      $result = $mysqli->query($query);
      if(!$result){
          printf("Error: %s\n",mysqli_error($con));
      }
      $arr = array();
  
      while($data = mysqli_fetch_array($result)){
          $arr[$i]['postNumber'] = $data['postNumber'];
          $arr[$i]['marketNumber'] = $data['marketNumber'];
          $arr[$i]['id'] = $data['id'];
          $arr[$i]['password'] = $data['password'];
          $arr[$i]['post'] = $data['post'];
          $arr[$i]['tag'] = $data['tag'];
          $arr[$i]['image_name'] = $data['image_name'];
          $arr[$i]['date'] = $data['date'];
          $i++;
      }
      return $arr;
}

function readPost($marketNumber){
	global $mysqli;
	$i=0;
	$query = "select * from mp3_board where marketNumber =".$marketNumber;
	$result = $mysqli->query($query);
	$arr = array();
	while($data = mysqli_fetch_array($result)){
		$arr[$i]['postNumber'] = $data['postNumber'];
		$arr[$i]['id'] = $data['id'];
		$arr[$i]['password'] = $data['password'];
		$arr[$i]['post'] = $data['post'];
		$arr[$i]['tag'] = $data['tag'];
		$arr[$i]['image_name'] = $data['image_name'];
		$arr[$i]['date'] = $data['date'];
		$i++;
	}
	return $arr;
}

function updatePost($postNumber, $post, $password){
	global $mysqli;
	$passwordCheck = "select * from mp3_board where password = '$password' ";
	if(!mysqli_fetch_array($mysqli->query($passwordCheck))){
		echo("<script language='javascript'>alert('Password가 잘못됨!');</script>");
		exit(0);
	}
	$query = "update mp3_board set post='$post' where postNumber = $postNumber";
	$mysqli->query($query);
}

function deletePost($postNumber, $password){
	global $mysqli;
	$passwordCheck = "select * from mp3_board where password = '$password' ";
	if(!mysqli_fetch_array($mysqli->query($passwordCheck))){
		echo("<script language='javascript'>alert('Password가 잘못됨!');</script>");
		exit(0);
	}
	$query = "delete from mp3_board where postNumber = $postNumber";
	$mysqli->query($query);
}

function writeComment($postNumber, $comment, $id, $password){
	global $mysqli;
	$query = "insert into mp3_comment(postNumber, comment, id, password) values('$postNumber', '$comment', '$id', '".md5($password)."')";
	$mysqli->query($query);
}

function readComment($postNumber){
	global $mysqli;
	$i = 0;
	$query = "select * from mp3_comment where postNumber = $postNumber";
	$result = $mysqli->query($query);
	$arr = array();
	while($data = mysqli_fetch_array($result)){
		$arr[$i]['comment'] = $data['comment'];
		$arr[$i]['id'] = $data['id'];
		$arr[$i]['password'] = $data['password'];
		$arr[$i]['date'] = $data['date'];
		$i++;
	}
	return $arr;
}

function updateComment($commentNumber, $comment, $password){
	global $mysqli;
	$passwordCheck = "select * from mp3_comment where password = '$password' ";
	if(!mysqli_fetch_array($mysqli->query($passwordCheck))){
		echo("<script language='javascript'>alert('Password가 잘못됨!');</script>");
		exit(0);
	}
	$query = "update mp3_comment set comment='$comment' where commentNumber = $commentNumber";
	$mysqli->query($query);
}

function deleteComment($commentNumber, $password){
	global $mysqli;
	$passwordCheck = "select * from mp3_comment where password = '$password' ";
	if(!mysqli_fetch_array($mysqli->query($passwordCheck))){
		echo("<script language='javascript'>alert('Password가 잘못됨!');</script>");
		exit(0);
	}
	$query = "delete from mp3_comment where commentNumber = $commentNumber";
	$mysqli->query($query);
}

function login($id, $passwd){
	global $mysqli;
	$query = "select * from mp3_account where id = '$id'";
	$result = $mysqli->query($query);
	while($data = mysqli_fetch_array($result)){
		if ($data['passwd'] == md5($passwd))
			return true;
	}
	return false;
	
}

function addAcount($id, $passwd, $age, $sex, $name){
	global $mysqli;
	$check = "select id from mp3_account where id = '$id'";
	$result = $mysqli->query($check);
	if( mysqli_fetch_array($result) )
		return 1;

	$query = "insert into mp3_account values('$id', '".md5($passwd)."', $age, '$sex', '$name')";
	$mysqli->query($query);
	return 0;
}


function getUserInformation($id){
	global $mysqli;
	$query = "select age, sex, nickname from mp3_account where id = '$id'";
	$result = $mysqli->query($query);
	$data = mysqli_fetch_array($result);
	return $data;
}
function changeName($id, $newName){
	global $mysqli;
	$query = "update mp3_account set nickname ='$newName' where id='$id'";
	$mysqli->query($query);
}

function changePassword($newPassword){
	
}

function getBuildingForMap($latLow, $lngLow, $latHigh, $lngHigh) {
	global $mysqli;
	$i = 0;
	$query = "select * from mp3_building_data where lat between $latLow and $latHigh and lng between $lngLow and $lngHigh";
	$result = $mysqli->query($query);
	$arr = array();
	while($data = mysqli_fetch_array($result)){
		$arr[$i]['building_no'] = $data['building_no'];
		$arr[$i]['lat'] = $data['lat'];
		$arr[$i]['lng'] = $data['lng'];
		$arr[$i]['pre3'] = $data['pre3'];
		$arr[$i]['pre2'] = $data['pre2'];
		$arr[$i]['pre1'] = $data['pre1'];
		$arr[$i]['current'] = $data['current'];
		$i++;
	}
	return $arr;
}

function getBuildingData($lat, $lng){
	global $mysqli;
	$i = 0;
	$query = "select * from mp3_building_data where lat=$lat and lng=$lng ";
	$result = $mysqli->query($query);
	$arr = array();
	while($data = mysqli_fetch_array($result)){
		$arr[$i]['building_no'] = $data['building_no'];
		$arr[$i]['lat'] = $data['lat'];
		$arr[$i]['lng'] = $data['lng'];
		$i++;
	}
	return $arr;
}

function addBuildingData($lat, $lng){
	global $mysqli;
	$query = "insert into mp3_building_data (lat, lng) values ($lat, $lng)";
	$mysqli->query($query);
}

function addMarketData($building_no, $year, $market_name, $floor, $descript){
	global $mysqli;
	$query = "insert into mp3_market_data (building_no, year, market_name, floor, descript) values ($building_no, $year, '$market_name', $floor, '$descript') ";
	$mysqli->query($query);
}

function getMarketList($building_no){
	global $mysqli;
	$i = 0;
	$query = "select * from mp3_market_data where building_no = $building_no Order by year";
	$result = $mysqli->query($query);
	$arr = array();
	while($data = mysqli_fetch_array($result)){
		$arr[$i]['market_no'] = $data['market_no'];
		$arr[$i]['year'] = $data['year'];
		$arr[$i]['market_name'] = $data['market_name'];
		$arr[$i]['market_image'] = $data['market_image'];
		$arr[$i]['hit'] = $data['hit'];
		$arr[$i]['floor'] = $data['floor'];
		$arr[$i]['descript'] = $data['descript'];
		$i++;
	}
	return $arr;

}

function getMarketData($market_no){
	global $mysqli;
	$i = 0;
	$query = "select * from mp3_market_data where market_no = $market_no";
	$result = $mysqli->query($query);
	$arr = array();
	while($data = mysqli_fetch_array($result)){
		$arr[$i]['building_no'] = $data['building_no'];
		$arr[$i]['year'] = $data['year'];
		$arr[$i]['market_name'] = $data['market_name'];
		$arr[$i]['market_image'] = $data['market_image'];
		$arr[$i]['hit'] = $data['hit'];
		$arr[$i]['floor'] = $data['floor'];
		$arr[$i]['descript'] = $data['descript'];
		$i++;
	}
	return $arr;

}



// 조회수 


?>
