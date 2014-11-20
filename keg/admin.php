<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $title = "Barry's Bar" ?>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php $title ?></title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
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
		<a href="#addBeer"><h3>Search Beer List</h3></a>
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




</body>
</html>
