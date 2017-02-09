<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="views/app/css/header.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style>
  .content {
    background-color: rgb(242,242,242)
  }
</style>
<?php require('./views/home/header.html');
echo '	<div class="content">
        <div class="container"';
require_once('routes.php');
echo '</div></div>';
require('./views/home/footer.html');?>
  </body>
</html>