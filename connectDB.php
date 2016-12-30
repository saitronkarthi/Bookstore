<!-- Rajamani
Karthikeyan
UTA Id:1001267157 
Project 4-DPHP Scripting with Relational Database  Due Date : 11/26/2016-->
<html>
	<head>
		<title>Cheap Books-cheapbooks.com</title>
		<script src="CB.js"></script>
		  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
</html>
<?php
	$DBconn = mysqli_connect('localhost','root','','db_cheapbooks') or die("Error " . mysqli_error($DBconn));
	# report the DB errors
	mysqli_report(MYSQLI_REPORT_STRICT);
?>