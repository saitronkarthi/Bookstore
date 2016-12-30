<!-- Rajamani
Karthikeyan
UTA Id:1001267157 
Project 4-DPHP Scripting with Relational Database  Due Date : 11/26/2016-->
<?php
	include ('connectDB.php');
	// output buffer on
	ob_start();
	//start the session
	session_start();
?>
<html>
	<head>
		<title>Cheap Books-cheapbooks.com</title>

	</head>
	<body>
	<div class="jumbotron text-center">
		<h2> Welcome  to Cheapbooks.com- Online Bookworld </h2>
		<h4>Name: Karthikeyan Rajamani<br>UTA ID: 1001267157</h4>
		
		</div>
		<?php
			$message = '';
			if (isset($_POST['login']) && !empty($_POST['uname']) && !empty($_POST['pwd'])) {
				$username = $_POST["uname"];
				$password = md5($_POST["pwd"]);

				$querysel = "SELECT * FROM customer WHERE username='$username' and password='$password'";
				$result = mysqli_query($DBconn,$querysel);
				$count = mysqli_num_rows($result);

				if ($count==1) {
					$_SESSION['valid'] = true;
					//2 hours session
					$_SESSION['timeout'] = time() + 7200;
					$_SESSION['username'] = $_POST['uname'];
					$_SESSION['password'] = md5($_POST["pwd"]);
		   			$_SESSION['titlesearch'] = $message;
		   			$_SESSION['authorsearch'] = $message;
					$_SESSION['testtosearch'] = $message;
					$BID = uniqid();
					$_SESSION['BID'] = $BID;
					$_SESSION['searchResults'] = array();
					
					$queryins = "INSERT INTO ShoppingBasket VALUES ('$BID','$username');";
					$result1 = mysqli_query($DBconn,$queryins);
					if ($result1==true) {
						header("location: http://localhost:7777/pr4/search.php");
					}
					else
						$message = 'Sorry! basket not initialzed ';
				} else {
					$message = 'Please check your login credentails';
				}
			}
		?>
		<div class="container" align="center" style ='background-color: #abd8c1;'>
			<form  method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  id="formLogin"> 
				<div>
				<h3>Please login to continue</h3>
					<p>
						<label>Enter Username *: </label>
						<input type="text" name="uname" required autofocus><br>
					</p>
					<p>
						<label>Enter Password *: </label>
						<input type="password" name="pwd" required><br>
					</p>
					<p>
						<input type="submit" name="login" value="Login" class="btn btn-success">
					</p>
					<br>
					<p>
						<h4><?php echo $message; ?></h4>
					</p>
					
				
					<p>
						<label>New Users Register Here-></label>
						<input type="button" value="Register" onclick="Regfn();" class="btn btn-success">
					</p>
				</div>
			</form>
		</div>
	</body>
</html>