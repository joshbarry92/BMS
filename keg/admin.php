<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php $title = "Barry's Bar" ?>
<title><?php echo $title; ?></title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Walter+Turncoat' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Overlock+SC' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="beer.css">
</head>
<body>

<h1><p align='center'><img src='BeerLabel.gif' </img><br> <?php echo $title; ?> </h1></p>

<div style="text-align:center">
<table class="center">
  <tr>
    <td><a href="#openModal"><h2>Add a Brew</h2></a></td>
    <td><a href="#manageStock"><h2>Manage Stock</h2></a></td>
  </tr>
</table>
</div>


<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add A Brew</h2>
		<br>
		<a href="#searchBeer"><h3>Search Beer List</h3></a>
		<hr>
		<a href="#addBeer"><h3>Add New Brew</h3></a>
	</div>
</div>

<div id="addBeer" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add a Brew</h2>
		<br>
		<form action="#newBeer" method="GET">
			Brewery: <input type="text" name="brewery"><br>
			Name: <input type="text" name="name"><br>
			Style: <input type="text" name="style"><br>
			ABV: <input type="text" name="abv"><br>
			Hops: <select name="hops"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><br>
			SRM: <select name="SRM"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40+</option></select><br>
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

<div id="newBeer" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add New Beer</h2>
		<br>
		<?php

		$servername = "localhost";
		$username = "beerw";
		$password = "beerwbeerrbeerw";
		$dbname = 'beer';
		$table = 'Beer';
		$name = $_GET['name'];
		$brewery = $_GET['brewery'];
		$style = $_GET['style'];
		$abv = $_GET['abv'];
		$hops = $_GET['hops'];
		$srm = $_GET['SRM'];
		
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Beer (Beer, Brewery, Style, ABV, Hops, SRM) VALUES ('" . $name . "','" . $brewery . "','" . $style . "','" . $abv . "','" . $hops . "','" . $srm . "')";
			$sql2 = "INSERT INTO BeerStock (Quantity) VALUES ('0')";
			$conn->exec($sql);
			$conn->exec($sql2);
			echo "Beer Addeed! Lets <a href='#manageStock'>Manage the Stock</a>!";
			$conn=NULL;
			}
		catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}
		
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
			$conn=NULL;
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
