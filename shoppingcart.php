<!-- Rajamani
Karthikeyan
UTA Id:1001267157 
Project 4-DPHP Scripting with Relational Database  Due Date : 11/26/2016-->
<?php

	include ('connectDB.php');
	session_start();

	$username = $_SESSION["username"];
	$BID = $_SESSION["BID"];
	$selectsql = "select title,price,book.isbn,name,number from book,author,writtenby,contains where contains.basketID like '%$BID%' and 	author.ssn = writtenby.ssn and book.isbn = writtenby.isbn and book.isbn = contains.isbn";
	$qresult = mysqli_query($DBconn,$selectsql);

	$selectcontains = "select * from contains where basketID='$BID';";
	$result2 = mysqli_query($DBconn,$selectcontains);

	$isbn = "";
	$tPrice = 0;
	$totalPrice = 0;
	while ($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
		$isbn = $row['ISBN'];
		$number = $row['number'];
		
		$selprice= "select price from book where isbn='$isbn';";
		$result3 = mysqli_query($DBconn,$selprice);
		
		$cost = mysqli_fetch_array($result3,MYSQLI_ASSOC)['price'];
		
		$totalPrice = $totalPrice+ ($number*$cost);
	}

    
	if(isset($_POST['buy'])) {

		

		$sqlbascont = "select * from Contains where basketID='$BID';";
		$result4 = mysqli_query($DBconn,$sqlbascont);
		
		while ($row1 = mysqli_fetch_array($result4,MYSQLI_ASSOC)) {
			$isbnno = $row1['ISBN'];
			$number = $row1['number'];

			echo $isbnno;
			echo $number;
			
			$sqlwhcode = "select warehousecode from stocks where isbn='$isbnno';";
			$sqlwresultshcoderesults = mysqli_query($DBconn,$sqlwhcode);
			$whc = mysqli_fetch_array($sqlwresultshcoderesults,MYSQLI_ASSOC)['warehousecode'];

			echo $whc;
			
			$shipping = "insert into shippingorder values ('$isbn','$warehousecode','$username',$number);";
			$shipres = mysqli_query($DBconn,$shipping);
			
			$updatestk = "update stocks set number=number-$number where isbn = '$isbnno';";
			$stkupdate = mysqli_query($DBconn,$updatestk);
			
			$delcontents = "delete from contains where basketID='$BID';";
			$delcont = mysqli_query($DBconn,$delcontents);
			
			header("location:http://localhost:7777/pr4/search.php");
		}
	}

	$rowcount = 0;

	if(isset($_POST['logout'])){
        $BID = $_SESSION["BID"];
		$delshopbskt = "delete from shoppingbasket where basketID='$BID';";
		$result9 = mysqli_query($DBconn,$delshopbskt);

		unset($_SESSION["username"]);
		unset($_SESSION["password"]);
		unset($_SESSION["BID"]);

		mysqli_close($DBconn);
		session_destroy();

		header('Refresh: 1; URL = http://localhost:7777/pr4/login.php');

	}
?>
<html>
	<head>
		<title>User Shopping Cart - CHEAPBOOKS</title>
		<script src="CB.js"></script>
	</head>
	<body >
		<form action="" method="post" name="logout">				
			<div align="right" style ='background-color: #abd8c1;'>
				<p>
					<input type="submit" name="logout" value="Logout" class="btn btn-success" >
					&nbsp;
					&nbsp;
					<input type="button" name="search" value="Go to Search" onclick="searchfn();" class="btn btn-success">&nbsp;&nbsp;
				</p>
				<hr noshade="noshade" />
			</div>
		</form>
		<div>
			<h2>User Shopping Cart</h2>
			<form action="" method="post" name="buy">
				<div>
				<?php 
					$cartstatus = false;
					if(mysqli_num_rows($qresult)<=0){
				?>
				<span>Your Shopping cart appears empty....</span>
				<?php  
					}
					else{
				?>
						
				<?php
						$status = true;
						while($records = mysqli_fetch_array($qresult,MYSQLI_ASSOC)){
							$rowcount++;
							$cartstatus = true;
							if($status == true){
								$status = false;
				?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td>Item.No</td>
							<td>Book Title</td>
							<td>ISBN</td>
							<td>Author</td>
							<td>Cost</td>
							<td>Copies available </td>				
						</tr>
					</thead>
					<tbody>
				<?php

						}
				?>
						<tr>
							<td><?php echo $rowcount; ?></td>
							<td><?php echo $records['title'];?></td>
							<td><?php echo $records['isbn']; ?></td>
							<td><?php echo $records['name'];?></td>
							<td>$<?php echo $records['price'];?></td>
							<td><?php echo $records['number'];?></td>
						</tr>
			<?php
					}
				}
			?>			
			<?php 
				if($cartstatus == true){
			?>
						<tr>
							<td colspan="6" align="right">Grand total:&nbsp;$<?php echo $totalPrice ?></td>
						</tr>
			<?php 
				}
			?>
					</tbody>
				</table>
			<?php 
				if($cartstatus == true){
			?>
				<div>
					<p>
						<button type ="submit" name ="buy"  class="btn btn-success">Buy books</button>
					</p>
				</div>
			<?php 
				}
			?>
			</form>
		</div>
		
	</body>
</html>