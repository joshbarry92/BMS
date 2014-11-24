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
		$db_user = 'beerw';
		$db_pwd = 'beerwbeerrbeerw';
		$database = 'beer';
		$table = 'Beer';
		$id = $_GET['id'];

		if (!mysql_connect($db_host, $db_user, $db_pwd))    
			die("Can't connect to database");
		if (!mysql_select_db($database))    
			die("Can't select database");

		// sending query
		$result = mysql_query("SELECT ID, Beer, Quantity FROM BeerStock WHERE id = '" . $id . "'");

		
		if (!$result) {    
			die($result);
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
		  echo "<a href='#'><h3>New Keg</h3></a><hr>";
		  echo "<a href='#'><h3>New 12 Pack</h3></a><hr>";
		  echo "<a href='#'><h3>New 6 Pach</h3></a><hr>";
		  echo "<a href='#'><h3>New Half Keg</h3></a><hr>";
		  echo "<a href='#'><h3>New Quarter Keg</h3></a><hr>";
          echo "<a href='#'><h3>New 5L Keg</h3></a><hr>";
		  echo "<a href='#'><h3>Custom Amount</h3></a><hr>";
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
		$result = mysql_query("SELECT ID, Beer, Quantity  FROM BeerStock WHERE Quantity <> '0'");

		
		if (!$result) {    
			die("Query Error!");
		}
		$fields_num = mysql_num_fields($result);


		while($row = mysql_fetch_array($result))
		  
		{
		  echo $row['ID'] . ": " . $row['Beer'] . ", " . $row['Quantity'] . "| <a href='?id=" . $row['ID'] . "#editStock'>Edit Stock</a>";
		  echo "<hr>";
		}

		mysql_free_result($result);
		
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
		$result = mysql_query("SELECT Brewery, Beer	FROM Beer WHERE " . $type . " like '%" . $search . "%'");
		
		if (!$result) {    
			die("Query Error!");
		}
		$fields_num = mysql_num_fields($result);

		while($row = mysql_fetch_array($result))
		{
		  echo $row['Brewery'] . ", " . $row['Beer'];
		  echo "<hr>";
		}

		mysql_free_result($result);
		
		?>
	</div>
</div>




</body>
</html>
