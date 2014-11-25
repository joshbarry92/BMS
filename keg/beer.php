<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $title = "Barry's Bar" ?>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="beer.css">
</head>
<body>
<h1><p align='center'><img src='BeerLabel.gif' </img><br> <?php echo $title; ?> </h1></p>


	
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
$result = mysql_query("SELECT Beer, Brewery, Style, ABV, Hops, SRM, 
CASE 
WHEN Quantity <= 0 THEN '0'
WHEN Quantity BETWEEN 0 and 6 THEN '10' 
WHEN Quantity BETWEEN 7 AND 28 THEN '25'
WHEN Quantity BETWEEN 14 AND 28 THEN '50'
WHEN Quantity BETWEEN 29 AND 43 THEN '75'
WHEN Quantity >= 44 THEN '100' 
WHEN Quantity IS NULL THEN '0'
END AS Stock,
ROUND(Quantity/0.47) AS Pints
FROM Beer
LEFT JOIN BeerStock
ON Beer.UUID = BeerStock.ID
WHERE Quantity <> 0");
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


// printing table rows
//while($row = mysql_fetch_row($result))
//{    
//echo "<tbody><tr>";    
// $row is array... foreach( .. ) puts every element    
// of $row to $cell variable    
//foreach($row as $cell)        
//echo "<td>$cell</td>";
//    echo "</tr>\n";
//	}
//echo "</tbody>";

while($row = mysql_fetch_array($result))
  
{
  echo "<tr>";
  echo "<td><h2>" . $row['Beer'] . "</h2></td>";
  echo "<td>" . $row['Brewery'] . "</td>";
  echo "<td>" . $row['Style'] . "</td>";
  echo "<td>" . $row['ABV'] . "</td>";
  echo "<td><img src='/images/Hops/" . $row['Hops'] . " Hops.png' width='200'</td>";
  echo "<td><img src='/images/SRM/SRM "	.	$row['SRM']	.	".png' height='75'</td>";
  echo "<td><img src='/images/kegs/"	. 	$row['Stock']	.	" .png' width='40'></td>"; 
  echo "<td>" . $row['Pints'] . "</td>";  
 
  echo "</tr>";
  
  }
echo "</table>";




mysql_free_result($result);
?>

</body>
</html>
