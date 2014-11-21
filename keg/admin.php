<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $title = "Barry's Bar" ?>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php $title ?></title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Walter+Turncoat' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="beer.css">
</head>
<body>

<h1><p align='center'><img src='BeerLabel.png' </img><br> <?php $title ?> </h1></p>

<div style="text-align:center">
<table class="center">
  <tr>
    <td><a href="#openModal"><h2>Add a Brew</h2></a></td>
    <td><a href="#openModal"><h2>Manage Stock</h2></a></td>
  </tr>
</div>


<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add A Brew</h2>
		<br>
		<a href="#searchBeer"><h3>Search Beer List</h3></a>
		<a href="#addBeer"><h3>Add Custom Homebrew</h3></a>
		<br><br>
		<button>Add Homebrew</button>
	</div>
</div>

<div id="addBeer" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Add Homebrew</h2>
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
		<h2 style="color:#000000;">Search the BdB</h2>
		<br>
		<form action="#searchResult" method="POST">
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

<div id="searchResult" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2 style="color:#000000;">Search the BdB</h2>
		<br>
		<?php 
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pwd = 'beer';
		$database = 'beer';
		$table = 'Beer';
		$search = $_GET["search"];
		$type = $_GET["type"];
		if (!mysql_connect($db_host, $db_user, $db_pwd))    
			die("Can't connect to database");
		if (!mysql_select_db($database))    
			die("Can't select database");

	

		// sending query
		$result = mysql_query("SELECT Beer.Beer,
		        Beer.Brewery, 
		        Beer.Quantity,
		FROM    Beer
		        INNER JOIN BeerStock
		            ON Beer.Beer = BeerStock.Beer
		Where Beer.Live=100
		AND ".$type." = ".$search."
		GROUP BY Beer.Beer, 
		        Beer.Brewery
		ORDER BY Beer ASC
		");
		if (!$result) {    
			die("Query to show fields from table failed");
		}
		$fields_num = mysql_num_fields($result);
		echo "<table align='center'><col><col id='middle'><col><col id='middle'><col><col><col><col><thead>";

		// printing table headers
		for($i=0; $i<$fields_num; $i++)
		{    $field = mysql_fetch_field($result);
		    echo "<th>{$field->name}</th>";
		}
		echo "</thead>\n";


		while($row = mysql_fetch_array($result))
		  
		{
		  echo "<tr>";
		  echo "<td><h2>" . $row['Beer'] . "</h2></td>";
		  echo "<td>" . $row['Brewery'] . "</td>";
		  echo "<td>" . $row['Quantity'] . "</td>";  
		  echo "</tr>";
		  }
		echo "</table>";

		mysql_free_result($result);
		?>
	</div>
</div>




</body>
</html>
