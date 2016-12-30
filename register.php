<!-- Rajamani
Karthikeyan
UTA Id:1001267157 
Project 4-DPHP Scripting with Relational Database  Due Date : 11/26/2016-->
<?php

  	include ('connectDB.php');
  	$msg = "";

	if (isset($_POST['register'])){
		if(!empty($_POST['uname']) && !empty($_POST['pwd'])) {
	        $username = $_POST['uname'];    
	        $password = md5($_POST['pwd']);    
	        $address = $_POST['address'];    
			$phone = $_POST['phone'];  
	        $email = $_POST['email']; 

			
	        $newusrinsert = "INSERT INTO `Customer`(`username`, `address`, `email`, `phone`,`password`) VALUES ('$username', '$address', '$email', '$phone','$password')";
	        
	        $newusrinsert = mysqli_query($DBconn,$newusrinsert);

		    if( $newusrinsert==1)
				$msg = "New user registered, login to proceed..";
			else
				$msg = "Sorry, try a different username...";
     	}
	    else
		 	$msg = "Username and password-required..";
	}

?>
<html>
	<head>
		<title>Welcome New user-Register</title>
		<script src="CB.js"></script>
	</head>
	<body>
		<div class="container" style ='background-color: #abd8c1;'>
		
			<h2>New User Registration details</h2>
			<br>
			<h4><?php echo $msg; ?></h4>
			<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" >
				<div>
					<table>
						<tr>
							<td>Username</td>
							<td><input type="text" name="uname" id="uname"  required autofocus class="form-control" >
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" class="form-control" name="pwd" id="pwd" required>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="Address"  class="form-control" name="address" id="address">
						</tr>
						<tr>
							<td>Phone </td>
							<td><input type="text" name="phone" class="form-control" maxlength="15" id="phone">
						</tr>
						<tr>
							<td>email</td>
							<td><input type="email" class="form-control" name="email" id="email">
						</tr>
						<tr><td><br></td></tr>	
						<tr>
							<td><input type="button" name="login" id="usrlogin" value="Login" onclick="Loginfn();" class="btn btn-success">
							<td><input type="submit" name="register" id="usrregister" value="Sign me up" class="btn btn-success">
						</tr>		
					</table>
				</div>
			</form>
		</div>
	</body>
</html>