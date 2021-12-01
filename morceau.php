<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit-icons.min.js"></script>

</head>
<body>
   <?php  
//// pour recherche les posts  que sup a  l utilisateur et plus que sa un ordre Decroissante/////

if(isset( $_SESSION['id_user']))
{
  $v =  $_SESSION['id_user'];

}

$sql ="SELECT * FROM `posts`";
$result = mysqli_query($conn, $sql);
 while($row = mysqli_fetch_assoc($result)) {
 
echo "<h2><meta charset='utf-8'>{$row['post']}</h2>";



 }

      ?>

</body>
</html>
