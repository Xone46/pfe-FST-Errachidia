<?php

//fetch_user.php

include('connect.php');

session_start();

$_SESSION['id_user'] = '10';
$v = $_SESSION['id_user'];

$sql = "
SELECT * FROM user 
WHERE id_user != '10'
";


$output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>Nom et Prenom</td>
  <td>Status</td>
  <td>Action</td>
 </tr>
';

foreach($result as $row)
{
 $output .= '
 <tr>
  <td>'.$row['nom'].' '.$row['prenom'].'</td>
  <td></td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id_user'].'" data-tousername="'.$row['nom'].'">Start Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;