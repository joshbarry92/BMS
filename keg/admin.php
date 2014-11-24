<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Barry's Bar</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Walter+Turncoat' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Overlock+SC' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="beer.css">
</head>
<body>

<h1><p align='center'><img src='BeerLabel.png' </img><br> <?php $title ?> </h1></p>

<div style="text-align:center">
<table class="center">
  <tr>
    <td><a href="#openModal"><h2>Add a Brew</h2></a></td>
    <td><a href="#manageStock"><h2>Manage Stock</h2></a></td>
  </tr>
</div>


<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add A Brew</h2>
		<br>
		<a href="#searchBeer"><h3>Search Beer List</h3></a>
		<hr>
		<a href="#addBeer"><h3>Add Custom Homebrew</h3></a>
		<br><br>
	</div>
</div>

<div id="addBeer" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add Custom Homebrew</h2>
		<br>
		<form action="" method="POST">
			Name: <input type="text" name="name"><br>
			Brewey: <input type="text" name="brewery"><br>
			Style: <input type="text" name="style"><br>
			ABV: <input type="text" name="style"><br>
			Hops: <input type="text" name="style"><br>
			SRM: <input type="text" name="style"><br>
			Label: <input type="file" name="img"><br>
			<input type="submit">
	</form>
	
	</div>
</div>

<div id="searchBeer" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Search the Beer List</h2>
		<br>
		<form action="#searchResult" method="GET">
			Search By: <select name="type">
						  <option value="Beer">Name</option>
						  <option value="Brewery">Brewery</option>
						  <option value="Style">Style</option>
						</select>
			<input type="text" name="search"><br>
			<input type="submit">
	</form>
	
	</div>
</div>

<div id="editStock" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Edit Stock</h2>
		<br>
		
		<?php 
		$db_host = 'localhost';
		$db_user = 'beerr';
		$db_pwd = 'beerr';
		$database = 'beer';
		$table = 'Beer';
		$id = $_GET['id'];

		if (!mysql_connect($db_host, $db_user, $db_pwd))    
			die("Can't connect to database");
		if (!mysql_select_db($database))    
			die("Can't select database");

		// sending query
		$result = mysql_query("SELECT ID, Beer, Brewery, Quantity FROM Beer LEFT JOIN BeerStock ON id = uuid WHERE Beer.UUID = '" . $id . "'");

		
		if (!$result) {    
			die("Can't Read Table");
		}
		$fields_num = mysql_num_fields($result);


		while($row = mysql_fetch_array($result))  
		{
		  echo "<form action='' method='GET'>";
		  echo "<h4>";
		  echo $row['ID'] . ": " . $row['Beer'];
		  echo "<br>";
		  echo "Quantity: " . $row['Quantity'] . "L";
		  echo "</h4>";
		  echo "<br><br>";
		  echo "<a href='?amt=58.66&id=" . $id . "&qty=" . $row['Quantity'] . "#addStock'><h3>New Keg</h3></a><hr>";
		  echo "<a href='?amt=3.54&id=" . $id . "&qty=" . $row['Quantity'] . "#addStock'><h3>New 12 Pack (10oz. Bottles)</h3></a><hr>";
		  echo "<a href='?amt=4.25&id=" . $id . "&qty=" . $row['Quantity'] . "#addStock'><h3>New 12 Pack (12oz. Bottles)</h3></a><hr>";
		  echo "<a href='?amt=29.33&id=" . $id . "&qty=" . $row['Quantity'] . "#addStock'><h3>New Half Keg</h3></a><hr>";
		  echo "<a href='?amt=14.66&id=" . $id . "&qty=" . $row['Quantity'] . "#addStock'><h3>New Quarter Keg</h3></a><hr>";
          echo "<a href='?amt=5&id=" . $id . "&qty=" . $row['Quantity'] . "#addStock'><h3>New 5L Keg</h3></a><hr>";
		  echo "<a href='#customStock'><h3>Custom Amount</h3></a><hr>";
		  echo "</form>";
		}

		mysql_free_result($result);
		
		?>
	</div>
</div>

<div id="manageStock" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Search the Beer List</h2>
		<br>
		<?php 
		$db_host = 'localhost';
		$db_user = 'beerr';
		$db_pwd = 'beerr';
		$database = 'beer';
		$table = 'Beer';

		if (!mysql_connect($db_host, $db_user, $db_pwd))    
			die("Can't connect to database");
		if (!mysql_select_db($database))    
			die("Can't select database");

		// sending query
		$result = mysql_query("SELECT ID, Beer, Brewery, Quantity FROM Beer INNER JOIN BeerStock on id = uuid WHERE Quantity <> '0' ORDER BY ID");

		
		if (!$result) {    
			die("Query Error!");
		}
		
		$fields_num = mysql_num_fields($result);


		while($row = mysql_fetch_array($result))
		  
		{
		  echo $row['ID'] . ": " . $row['Beer'] . ", " . $row['Quantity'] . " | <a href='?id=" . $row['ID'] . "#editStock'>Edit Stock</a>";
		  echo "<hr>";
		}

		mysql_free_result($result);
		
		?>
	</div>
</div>

<div id="addStock" class="modalDialog">
	<div>
		<a href="#close" onClick="history.go(0)" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add New Beer</h2>
		<br>
		<?php

		$servername = "localhost";
		$username = "beerw";
		$password = "beerwbeerrbeerw";
		$dbname = 'beer';
		$table = 'Beer';
		$id = $_GET['id'];
		$qty = $_GET['qty'];
		$amt = $_GET['amt'];
		$fin = $qty + $amt;
		

		
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE BeerStock SET Quantity = '" . $fin . "' WHERE ID = '" . $id . "'";
			$conn->exec($sql);
			echo "Beer Addeed!";
			}
		catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}
		
		?>
		
	</div>
</div>

<div id="searchResult" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Search the Beer List</h2>
		<br>
		<?php 
		$db_host = 'localhost';
		$db_user = 'beerr';
		$db_pwd = 'beerr';
		$database = 'beer';
		$table = 'Beer';
		$search = $_GET["search"];
		$type = $_GET["type"];
		if (!mysql_connect($db_host, $db_user, $db_pwd))    
			die("Can't connect to database");
		if (!mysql_select_db($database))    
			die("Can't select database");

		// sending query
		$result = mysql_query("SELECT UUID, Brewery, Beer FROM Beer INNER JOIN BeerStock ON ID=UUID WHERE Quantity = 0 AND " . $type . " like '%" . $search . "%' ORDER BY UUID");
		
		if (!$result) {    
			die("Query Error!");
		}
		$fields_num = mysql_num_fields($result);

		while($row = mysql_fetch_array($result))
		{
		  echo $row['UUID'] . ": " . $row['Brewery'] . ", " . $row['Beer'] . " | <a href='?id=" . $row['UUID'] . "#editStock'>Edit Stock</a>";
		  echo "<hr>";
		}
		
		echo "<i><br>Don't see Your beer?<br>See if its already in your <a href='#manageStock'>active inventory</a><br>or <a href='#addBeer'>add it</a> to the Database!</i>";

		mysql_free_result($result);
		
		?>
	</div>
</div>




</body>
</html>
