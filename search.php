<!-- Rajamani
Karthikeyan
UTA Id:1001267157 
Project 4-DPHP Scripting with Relational Database  Due Date : 11/26/2016-->
<?php

	include ('connectDB.php');
	session_start();

	$reccnt = 0;
	$username = $_SESSION["username"];
	$BID = $_SESSION["BID"];
	$selquery = "select sum(number) from contains where BasketID='$BID'";
	
	$qryres = mysqli_query($DBconn,$selquery);

	$cartcount = mysqli_fetch_array($qryres,MYSQLI_ASSOC)['sum(number)'];

	$isbn = 0;
	$reccount = 0;

	if(isset($_POST['tquery'])){
		$testtosearch = $_POST['searchbook'];
		$tquery = $_POST['tquery'];

		$_SESSION['Searchtextres'] = array();
		
		$searchtextqry="select title,price,book.isbn,name,number from book,author,writtenby,stocks where book.title like '%$testtosearch%' and author.ssn = writtenby.ssn and book.isbn = writtenby.isbn and stocks.isbn = book.isbn and number!=0 Group By book.isbn";
		$qryres=mysqli_query($DBconn,$searchtextqry);
		
	}
	if(isset($_POST['authorsearch'])){
		$testtosearch = $_POST['searchbook'];
		$authorsearch = $_POST['authorsearch'];

		$_SESSION['Searchtextres'] = array();

		$searchauthorqry="select title,price,book.isbn,name,number from book,author,writtenby,stocks where author.name like '%$testtosearch%' and author.ssn = writtenby.ssn and book.isbn = writtenby.isbn and stocks.isbn = book.isbn and number!=0 Group By book.isbn";
		$qryres=mysqli_query($DBconn,$searchauthorqry);
		
	}

	if(isset($_POST['AddItem'])) {
		try {
			
			$isbn = $_POST['CartItems'];
			$reccount = (int)$_POST['CartItemsCount'];
			

			$cartcntqry = "insert into contains values ('$isbn','$BID', $reccount);";
			$cartqryres = mysqli_query($DBconn,$cartcntqry);

			if($cartqryres == true) {
				$x=0;
				header("Refresh:0 ; URL=http://localhost:7777/pr4/search.php");
			}
			else {
				$cartupdqry = "update contains SET number= number+$reccount where isbn = '$isbn' and BID = '$BID';";
				$cartupdqryres = mysqli_query($DBconn,$cartupdqry);

				if($cartupdqryres !== true) {
					$_SESSION['authorsearch'] = $_POST['authorsearch'];
					$_SESSION['tquery'] = $_POST['tquery'];
					$_SESSION['testtosearch'] = $_POST['search'];
					header("location: http://localhost:7777/pr4/Logout.php");
				}
				else
					header("Refresh:0 ; URL=http://localhost:7777/pr4/search.php");
			}
		} catch (Exception $ex) {
			echo $ex->errorMessage();
		}
	}

	if(isset($_POST['Logout'])){
        $BID = $_SESSION["BID"];
		$cartdelqry = "delete from shoppingBasket where BID='$BID';";
		$cartdelqryres = mysqli_query($DBconn,$cartdelqry);

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
		<title>Search CheapBooks.com</title>
		<script src="CB.js"></script>
	</head>		
	<body>
		<div style ='background-color: #abd8c1;'>
			<form method="post" action="" id="Logout">
				<div align="right" class="form-group">
					<p>
						<input type="submit" name="Logout" value="Logout" class="btn btn-success" >&nbsp;&nbsp;
						<input type="button" name="Basket" value="Shopping Basket" onclick="Basketfn();" class="btn btn-success" >&nbsp;&nbsp;
						<input type="text" name="count" id="count" value="<?php echo $cartcount ?>" >
					</p>
					<hr noshade="noshade" />
				</div>
			</form>
			
			<div>
				<form action="" name="searchbook" method="post">
					<h2>Search Books</h2>
					<p>
					<textarea name="searchbook" id="search" placeholder="Enter Book Title or Author Name" rows="3" cols="50"></textarea>
					</p>
					<p>
						<input type="submit" name="tquery" value="Search by Title" class="btn btn-success">&nbsp;&nbsp;
						<input type="submit" name="authorsearch" value="Search by Author" class="btn btn-success">
					</p>
				</form>
			</div>		
		</div>
		<form action="" name="Cartres" method="post">
			<div>
			<?php 
				$CartItem = false;
				if(mysqli_num_rows($qryres)<=0){
			?>
			<span>No Books found for this search criteria! Please try again..</span>
			<?php  
				}
				else{
			?>
					
			<?php
					$IteminCart = true;
					while($resrow = mysqli_fetch_array($qryres,MYSQLI_ASSOC)){
						$CartItem = true;
						if($IteminCart == true){
							$IteminCart = false;
			?>
				<table border="1" class="table table-striped">
					<thead>
						<tr>
							<td>Select</td>
							<td>Book Name</td>
							<td>ISBN Number</td>
							<td>Author</td>
							<td>Price</td>
							<td>Copies Available </td>
							<td>&nbsp;</td>
							
						</tr>
					</thead>
					<tbody>
			<?php

						}
			?>
						<tr>
							<td>
								<input type="radio" name="CartItems" id="<?php echo $resrow['isbn']; ?>" value="<?php echo $resrow['isbn'] ?>">
							</td>
							<td><?php echo $resrow['title'];?></td>
							<td><?php echo $resrow['isbn']; $_SESSION['Searchtextres'][] = (string)$resrow['isbn']; ?></td>
							<td><?php echo $resrow['name'];?></td>
							<td>$<?php echo $resrow['price'];?></td>
							<td><?php echo $resrow['number'];?></td>
							<td>
								<select name="CartItemsCount" id="CartItemsCount">
								<?php
									for ($resrownum = 1; $resrownum <= $resrow['number']; $resrownum++){ 
								?>
									<option value="<?php echo $resrownum;?>"><?php echo $resrownum;?></option>
								<?php 
									} 
								?>
								</select>
							</td>
							
						</tr>
			<?php
					}
					if($CartItem == true){
			?>
				<div>
					<p>
						<input type="submit" name="AddItem" value ="Add Item to Cart" class="btn btn-success"/>
					</p>
				</div>
			<?php
					}
				}
			?>
					</tbody>
				</table>
			</div>
			
		</form>
	</body>
</html>