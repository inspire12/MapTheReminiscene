<?php
@require('conn.php')
?>
<!doctype html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Login page</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>	
			@import url(http://fonts.googleapis.com/css?family=Montserrat:400,700|Handlee);
			body {
				background: url('wall.jpg') repeat center center #fafafa;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.5);
			}
		</style>
    </head>
    <?php
	    if(isset($_POST['id']) && isset($_POST['password']) && isset($_POST['sex']) && isset($_POST['age']) ){

	    	$id = $_POST['id'];
	    	$password = $_POST['password'];
	    	$sex = $_POST['sex'];
	    	$age = $_POST['age'];
	    	$name = "Unknown";

	    	$result = addAcount($id, $password, $age, $sex, $name);
	    	if($result == 1)
    			echo("<script language='javascript'>alert('이미 아이디가 존재합니다.');</script>");
    		else if($result == 0){
    			echo("<script language='javascript'>alert('회원가입 성공!');</script>");
    			echo("<script language='javascript'>location.replace('./index.php');</script>");    			
    		}

    	}

    ?>
    <body>
        <div class="container">

			
			<header>
			
				<h2 style = "font-size:18px" ><b>담벼락</b>에 오신 것을 환영합니다!</h2>
				
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			
			<section class="main">
				<form class="form-5 clearfix" action="./login.php" method="post">
				    <p>
				        <input type="text" id="login" name="id" placeholder="Username">
				        <input type="password" name="password" id="password" placeholder="Password"> 
						<input type = "text" name = "sex" id = "sex" placeholder ="male or female">
						<input type = "text" name = "age" id = "age" placeholder ="age">
				    </p>
				    <button type="submit" name="submit">
				    	<i class="icon-arrow-right"></i>
				    	<span>Sign in</span>
				    </button>     
				</form>​​​​
			</section>
			
        </div>
		<!-- jQuery if needed -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
		<script type="text/javascript">
		$(function(){
			$('input, textarea').placeholder();
		});
		</script>
    </body>
</html>
