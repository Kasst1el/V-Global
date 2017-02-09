<!DOCTYPE html>
<html lang="en">
<head>
<title>Администрирование</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
require('views/admin/header.html');?>
<h4>Добро пожаловать, 
<?php 	if(isset($_SESSION['username'])){
			echo $_SESSION['username'].'!';
	} else 
		{
			echo 'Guest!';
		}
	?>
</h4>
</body>
</html>
