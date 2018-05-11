<?php 
    //start session
    session_start();

    //setting up a cookie
    $SID = session_id(); //store session id

    //generate CSRF token
    if(empty($_SESSION['KEY']))
    {
        $_SESSION['KEY']=bin2hex(random_bytes(32));
    }

    $token123 = hash_hmac('sha256',$SID,$_SESSION['key']);
    

    setcookie("session_id2",$SID,time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
    setcookie("csrf_token",$token123,time()+3600,"/","localhost",false,true); //csrf token cookie


?>

<!DOCTYPE html>
<html>
<head>
	<title>SSS Assignment 2 - IT16137660</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="config.js"> </script>
</head>
<body>

	<div class="header">
		<h2>Cross-Site Request forgery protection - Login</h2>
	</div>
	
	<form method="post" action="server.php">


		<div class="input-group">
			<label>Username</label>
			<input type="text" name="usrnm" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="usrpwd">
		</div>
        <div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> Remember me</small></div>
		<div class="spacing"><input type="hidden" id="TokenCS"  name="XYZ" /></div>
		<div class="input-group">
			<button type="submit" class="btn" name="submit123">Login</button>
		</div>
	</form>

<!-- Assign CSRF token to hidden variable -->
<script> document.getElementById("TokenCS").value = '<?php echo $token123; ?>' </script>


</body>
</html>