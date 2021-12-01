<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>page de Server</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
            // Function to check Whether both passwords 
            // is same or not. 
            function checkPassword(form) { 
                password1 = form.pass.value; 
                password2 = form.rpass.value; 
  
                // If password not entered 
                if (password1 == '') 
                    alert ("Svp enter le mot de pass"); 
                      
                // If confirm password not entered 
                else if (password2 == '') 
                    alert ("Svp entre le mot de pass de confirmation "); 
                      
                // If Not same return False.     
                else if (password1 != password2) { 
                    alert ("\nLe mot de passe ne correspond pas: veuillez réessayer ...") 
                    return false; 
                } 
  
                // If same return True. 
                else{ 
                    alert("Le mot de passe correspond  BienVenu Docteur") 
                    return true; 
                } 
            }
$("#modifierdocteur").click( function() {
 $.post( $("#moddocteur").attr("action"), 
         $("#moddocteur :input").serializeArray(), 
         function(info){ $("#result").html(info); 
  });
});

  </script>
  <style type="text/css">
#msg{
  background-color: #f8f9fa;
    width: 1500px;
    height: 100%;
    border-radius: 40px;
    border: 2px solid #ced4da;
    margin-top: 30px;
}
#msg-sub{
  background-color: red;
    width:100%;
    height: 200px;
    border-radius: 20px;
    border: 2px solid #ced4da;
    margin-top: 10px;
    margin-left:50px ;
    display:block;
}
div.a {
  text-align: center;
}
  </style>
</head>

<body>

<?php
if(isset($_SESSION['id_user'])){
  $v = $_SESSION['id_user'];
}
/////////////////// pour voir les docteurs et les patient et cree un discutition ////
if(isset($_REQUEST['messagespatient']))
{

  $v = $_REQUEST['messagespatient'];

$sql = "SELECT * FROM `demandes` WHERE `to` = '$v' OR `from` = '$v' AND `con` = 1 AND `cas` = 'oui' ";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){



  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $id = $row['to'];
    $sqluser = "SELECT * FROM `user` WHERE id_user='$id'";
    $resultuser = mysqli_query($conn,$sqluser);
    $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);

echo " <li class='list-group-item d-flex justify-content-between align-items-center' >

          <h5> Docteur ".$rowuser['nom']." ".$rowuser['prenom']."</h5> 
          <h7> Il accepte la rendez vous (Clique le bouton (Discuter) pour transfert un message)</h7>
           <button type='button' class='btn btn-success' onclick='disc(".$rowuser['id_user'].")'>Discuter</button>
       </li>";
}

}
}
/////////////////// pour voir les patient de docteur et cree un discutition ///alert/
if(isset($_REQUEST['messagesdocteur']))
{

  $v = $_REQUEST['messagesdocteur'];

$sql = "SELECT * FROM `demandes` WHERE `to` = '$v' OR `from` = '$v' AND `con` = 1 AND `cas` = 'oui' ";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){



  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $id = $row['from'];
    $sqluser = "SELECT * FROM `user` WHERE id_user='$id'";
    $resultuser = mysqli_query($conn,$sqluser);
    $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);

echo 
"<ul id='me'>
 <li class='list-group-item d-flex justify-content-between align-items-center' id='me'>

          <h5> Patient : ".$rowuser['nom']." ".$rowuser['prenom']."</h5> 
           <button type='button' class='btn btn-success' onclick='discuter(".$rowuser['id_user'].")'>Discuter</button>
 </li>
 </ul>";
}

}
}
/////////////////////////////////
if(isset($_REQUEST['sin']))
{
  $flag = $_REQUEST['sin'];
  $sql = "DELETE FROM `messages` WHERE `id_message` = '$flag'";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo '';
  }
}
///////////////////////////////////////////////////////////
if(isset($_REQUEST['disc']))
{
  echo '<ul class="list-group" id="trash-disc">';
  $v = $_SESSION['id_user'];
  $flag  = $_REQUEST['disc'];
  $sql = "SELECT *FROM `messages`WHERE `from` = '$v' AND `to` = '$flag' OR `from` = '$flag' AND `to` ='$v' ORDER BY temp ASC"; 
  $result = mysqli_query($conn,$sql);
 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  if($row['from'] == $v)
  {
     $sin = "<span uk-icon='trash' onclick='sin(".$row['id_message'].")'></span>";
  }else{
     $sin = " ";
  }



  echo '

  <li class="list-group-item" id="'.$row['id_message'].'">'.$row['message'].'<br><p>'.$row['temp'].'</p> '.$sin.'</li>

';



}
echo '</ul>';
echo '
<form style="margin-top:20px;" action="server.php" method="POST" id="reponde-disc">
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Répondre au patient</label>
    <input type="hidden" value="'.$flag.'" name = "to">
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="msg"></textarea>
  </div>
  <button type="submit" class="btn btn-warning" name="repondremsgp">Répondre</button>

</form>

<br><br>';
}
/////////////////////////////////////////////////////////////
if(isset($_POST['modfierpers']) AND !empty($_POST['id']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['ville']) AND !empty($_POST['adresse']) AND !empty($_POST['pays']) AND !empty($_POST['codepostal']))
{

  $v = $_POST['id'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $ville = $_POST['ville'];
  $adresse = $_POST['adresse'];
  $region = $_POST['region'];
  $pays = $_POST['pays'];
  $codepostal = $_POST['codepostal'];


  $sql = " UPDATE `user` SET `nom` = '$nom' , `prenom` = '$prenom' , `ville` = '$ville' , `region` = '$region' , `pays` = '$pays', `adresse` = '$adresse' , `code_postal` = '$codepostal' WHERE `id_user` = '$v'";

  $result = mysqli_query($conn,$sql);
  if($result)
  {
    echo "
<div class='alert alert-secondary' role='alert'>
 L'opération s'est bien déroulée
</div>
    ";
    header("Refresh: 5; url=docteur.php");
  }else{
        echo "
<div class='alert alert-secondary' role='alert'>
 L'opération s'est n'bien pas déroulée
</div>
    ";
  }


 

}
//////////////////////////////////////////////////
if(isset($_POST['modfiersante']))
{

   $v = $_POST['id'];
  $poids = $_POST['poids'];
  $taille = $_POST['taille'];
  $motif = $_POST['motif'];
  $diagnostique = $_POST['diagnostique'];
  $symptomes= $_POST['symptomes'];
  $pouls = $_POST['pouls'];
  $glycemie = $_POST['glycemie'];
  $cholesterol = $_POST['cholesterol'];
  $remarque = $_POST['remarque'];
  $temperature = $_POST['temperature'];


  $sql = " UPDATE `user` SET `poids` = '$poids' , `taille` = '$taille' , `motif` = '$motif' , `diagnostique` = '$diagnostique' , `symptomes` = '$symptomes', `pouls` = '$pouls' , `glycemie` = '$glycemie' , `cholesterol` = '$cholesterol' , `remarque` = '$remarque' , `temperature` = '$temperature' WHERE `id_user` = '$v'";

  $result = mysqli_query($conn,$sql);
  if($result)
  {
    echo "
<div class='alert alert-secondary' id='alert'>
 L'opération s'est bien déroulée
</div>
    ";
    header("Refresh: 5; url=docteur.php");
  }else{
        echo "
<div class='alert alert-secondary' id='alert'>
 L'opération s'est n'bien pas déroulée
</div>
    ";
  }

}
/////////////////////////////////////
if(isset($_REQUEST['suppatient']))
{
  $v = $_SESSION['id_user'];
  $flag = $_REQUEST['suppatient'];
  $sql = " DELETE FROM `demandes` WHERE `from` = '$flag' AND `to` = '$v' "; 
  $result = mysqli_query($conn,$sql);
  if($result){
        echo "
<div class='alert alert-secondary' id='alert'>
 L'opération s'est bien déroulée
</div>
    ";
    header("Refresh: 2; url=docteur.php");
  }else{
            echo "
<div class='alert alert-secondary'id='alert' >
 L'opération s'est n'bien pas déroulée
</div>
    ";
  }
}
///////////////////////////////////////reglement//////////////////////
if(isset($_REQUEST['dsm']))
{
  $flag = $_REQUEST['dsm'];

  $sql = "SELECT * FROM `user` WHERE `id_user` = '{$_REQUEST['dsm']}'"; 
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $nom = $row["nom"];
  $prenom = $row["prenom"];
  $ville = $row['ville'];
  $pays = $row['pays'];
  $code_postal = $row['code_postal'];
  $adresse = $row['adresse'];
  $tel = $row['telephone'];
  $poids  = $row['poids'];
  $taille = $row['taille'];
  $cholesterol = $row['cholesterol'];
  $glycemie = $row['glycemie'];
  $temperature = $row['temperature'];
  $pouls = $row['pouls'];
  $motif = $row['motif'];
  $diagnostique = $row['diagnostique'];
  $remarque = $row['remarque'];
  $symptomes = $row['symptomes'];



  echo '

<div class="card" style="width: 43rem; margin-left:52px;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$nom.' '.$prenom.'</h5>
    <p class="card-text"> Adresse :  '.$adresse.'  '.$ville.' '.$code_postal.' , '.$pays.'</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Telephone : '.$tel.' </li>
    <li class="list-group-item">Poids : '.$poids.' Kg</li>
    <li class="list-group-item">Taille : '.$taille.' cm</li>
    <li class="list-group-item">Cholesterol : '.$cholesterol.'</li>
    <li class="list-group-item">Glycemie : '.$glycemie.'</li>
    <li class="list-group-item">Temperature : '.$temperature.'</li>
    <li class="list-group-item">Pouls : '.$pouls.' pouls/minute</li>
    <li class="list-group-item">Motif : '.$motif.'</li>
    <li class="list-group-item">Diagnostique : '.$diagnostique.'</li>
     <li class="list-group-item">Remarque : '.$remarque.'</li>
      <li class="list-group-item">symptomes : '.$symptomes.'</li>

  </ul>
  <div class="card-body">
    <a href="#" class="card-link" onclick="suppatient('.$row["id_user"].')">Supprimer</a>
    <a href="#" class="card-link"  onclick="inspecter('.$row["id_user"].')">Modifier</a>
  </div>
</div>
  <div class="card-body">
   <a href="docteur.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Retour</a>
  </div>


  ';

}
/////////////////////////////
if(isset($_REQUEST['inspecter']))
{

  $sql = "SELECT * FROM `user` WHERE `id_user` = '{$_REQUEST['inspecter']}'"; 
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo '

<div class="alert alert-danger" role="alert">
  Vous n avez pas la possibilité de modifier les informations personnelles d un patient , sauf avec son consentement!
</div>
<br>

<h3>Les Information personnelle de <span class="badge badge-secondary">Patient</span></h3>
<br>
<form method="POST" action="server.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nom</label>
      <input type="text" class="form-control" id="inputEmail4" name ="nom" placeholder="'.$row['nom'].'" value="'.$row['nom'].'">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Prenom</label>
      <input type="text" class="form-control" id="inputPassword4" name ="prenom" placeholder="'.$row['prenom'].'"  value="'.$row['prenom'].'">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" name = "adresse" placeholder="'.$row['adresse'].'" value="'.$row['adresse'].'">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="">
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="inputCity">Ville</label>
      <input type="text" class="form-control" id="inputCity" name = "ville"  placeholder="'.$row['ville'].'"  value="'.$row['ville'].'" >
    </div>
    <div class="form-group col-md-2">
      <label for="inputCity">Pays</label>
      <input type="text" class="form-control" id="inputCity" name = "pays"  placeholder="'.$row['pays'].'"  value="'.$row['pays'].'">
    </div>
    <div class="form-group col-md-4">
      <label for="inputCity">Region</label>
      <input type="text" class="form-control" id="inputCity" name="region"  placeholder="'.$row['region'].'"  value="'.$row['region'].'" >
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Code Postal</label>
      <input type="text" class="form-control" id="inputZip" name ="codepostal" placeholder="'.$row['code_postal'].'"  value="'.$row['code_postal'].'" >
    </div>
  </div>
  <input type="hidden" value="'.$row['id_user'].'" name="id">

  <button type="submit" class="btn btn-primary" name="modfierpers">Modifier</button>
</form>
<br>
<a href="docteur.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Retour</a>
';

echo'<h3> Information sur la santé de <span class="badge badge-secondary">Patient</span></h3>';

echo '
<form method="POST" action="server.php">

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Poids</label>
    <input type="text" class="form-control" id="inputCity" name = "poids" placeholder="'.$row['poids'].'"  value="'.$row['poids'].'">
    </div>
    <div class="form-group col-md-4">
      <label for="inputCity">Taille</label>
      <input type="text" class="form-control" id="inputCity" name="taille" placeholder="'.$row['taille'].'" value="'.$row['taille'].'">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Cholesterol</label>
      <input type="text" class="form-control" id="inputZip" name = "cholesterol" placeholder="'.$row['cholesterol'].'"  value="'.$row['cholesterol'].'">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Glycemie</label>
      <input type="text" class="form-control" id="inputZip" name="glycemie" placeholder="'.$row['glycemie'].'"  value="'.$row['glycemie'].'" >
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Temperature</label>
      <input type="text" class="form-control" id="inputZip" name="temperature" placeholder="'.$row['temperature'].'" value="'.$row['temperature'].'" >
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Pouls</label>
      <input type="text" class="form-control" id="inputZip" name="pouls" placeholder="'.$row['pouls'].'" value="'.$row['pouls'].'" >
    </div>
    <div class="form-group col-md-12">
      <label for="inputZip">Diagnostique</label>
      <input type="text" class="form-control" id="inputZip" name="diagnostique" placeholder="'.$row['diagnostique'].'" value="'.$row['diagnostique'].'" >
    </div>
    <div class="form-group col-md-12">
      <label for="inputZip">Motif</label>
      <input type="text" class="form-control" id="inputZip" name = "motif" placeholder="'.$row['motif'].'" value="'.$row['motif'].'" >
    </div>
    <div class="form-group col-md-12">
      <label for="inputZip">Autres symptômes</label>
      <input type="text" class="form-control" id="inputZip" name = "symptomes" placeholder="'.$row['symptomes'].'" value="'.$row['symptomes'].'" >
    </div>
    <div class="form-group col-md-12">
      <label for="inputZip">Remarque</label>
      <input type="text" class="form-control" id="inputZip"  name ="remarque" placeholder="'.$row['remarque'].'" value="'.$row['remarque'].'" >
    </div>
  </div>
  <input type="hidden" value="'.$row['id_user'].'" name="id">

  <button type="submit" class="btn btn-primary" name="modfiersante">Modifier</button>
</form></br>
<a href="docteur.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Retour</a>
';

}
//////////////////////////////////////////////////////////////
if(isset($_REQUEST['mespatient']))
{

  echo '
  <table class="table table-striped id="table-table">
  <thead>
    <tr>
      <th scope="col">#Numero Dossier</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Ville</th>
      <th scope="col">Telephone</th>
      <th scope="col">Adresse</th>
      <th scope="col">Region</th>
      <th scope="col">Pays</th>
      <th scope="col">Code Postal</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>';
  $sql = "SELECT *
FROM `demandes`
WHERE `cas` = 'oui'
AND `con` =1
AND `to` ='{$_REQUEST['mespatient']}'";

  $result = mysqli_query($conn,$sql);
   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

        $sqluser = "SELECT * FROM `user` WHERE `id_user` = '{$row["from"]}'";
        $resultuser = mysqli_query($conn,$sqluser);
        $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);
       

    echo "
<tr>
      <th scope='row'>".$rowuser["id_user"]."</th>
      <th scope='row'>".$rowuser['nom']."</th>
      <th scope='row'>".$rowuser['prenom']."</th>
      <th scope='row'>".$rowuser['ville']."</th>
      <th scope='row'>".$rowuser['telephone']."</th>
      <th scope='row'>".$rowuser['adresse']."</th>
      <th scope='row'>".$rowuser['region']."</th>
      <th scope='row'>".$rowuser['pays']."</th>
      <th scope='row'>".$rowuser['code_postal']."</th>
      <th scope='row'>
      <button type='button' class='btn btn-link' onclick='suppatient(".$rowuser["id_user"].")'>Supprimer</button><br>
      <button type='button' class='btn btn-link' onclick='inspecter(".$rowuser["id_user"].")'>INSPECTER</button><br>
      <button type='button' class='btn btn-link'onclick='dsm(".$rowuser["id_user"].")'>Dossier médical</button>
      </th>
      
</tr>
    ";
   }

  echo '
  </tbody>
</table>';
echo"
<button type='button' class='btn btn-danger' onclick='gestion()' id='ajouterunregg'>Retour</button>

";
}

//////////////////////////////////////////////////////////////
if(isset($_REQUEST['discuter']))
{
  echo '<ul class="list-group" id="discuter">';
  $v = $_SESSION['id_user'];
  $flag  = $_REQUEST['discuter'];
  $sql = "SELECT *FROM `messages`WHERE `from` = '$v' AND `to` = '$flag' OR `from` = '$flag' AND `to` ='$v' ORDER BY temp ASC"; 
  $result = mysqli_query($conn,$sql);
 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  if($row['from'] == $v)
  {
     $sin = "<span uk-icon='trash' onclick='sin(".$row['id_message'].")'></span>";
  }else{
     $sin = " ";
  }



  echo '

  <li class="list-group-item" id="'.$row['id_message'].'">'.$row['message'].'<br><p>'.$row['temp'].'</p> '.$sin.'</li>

  ';



}
echo '</ul>';
echo '
<form style="margin-top:20px;" action="server.php" method="POST" id="discuterf">
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Répondre au patient</label>
    <input type="hidden" value="'.$flag.'" name = "to">
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="msg"></textarea>
  </div>
  <button type="submit" class="btn btn-warning" name="repondremsg">Répondre</button></br></br>
  <a href="docteur.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Retour</a></br></br>
</form>

';
}
////////////////////////////////////////////
if(isset($_REQUEST['suprdv'])){
  $v = $_REQUEST['suprdv'];
    $sql = "DELETE FROM `rdv` WHERE `id_rdv`= '$v'";
    $result = mysqli_query($conn,$sql);
     echo "
         <div class='alert alert-primary' role='alert'>
            A simple primary alert—check it out!
         </div>

     ";
}
////////////////////////////////////////////
if(isset($_POST['changerdv']))
{

$flag = $_POST['rdv'];
$dt =  $_POST['dt'];
$tm = $_POST['tm'];
$ds = $_POST['ds'];
$sql = " UPDATE `rdv` SET `date`='$dt',`heure`='$tm',`descriptionn`='$ds' WHERE `id_rdv`='$flag'";
$result = mysqli_query($conn,$sql);
if($result)
{
  echo '
<div class="alert alert-primary" role="alert">
Il a changé avec succès. Attendez un peu. Vous reviendrez à la page Accuile !
</div>
  ';
    header("Refresh: 5; url=docteur.php");

}

}
//////////////////////////////////////////
if(isset($_REQUEST['changea'])){

$v = $_REQUEST['changea'];
$sql = " SELECT * FROM `rdv` WHERE `id_rdv`= '$v'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
     echo '
           <form method="POST" action="server.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Saisir la nouvelle date</label>
    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="dt" placeholder="'.$row['date'].'" value="'.$row['date'].'">
    <small id="emailHelp" class="form-text text-muted">We ll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Saisir la nouvelle heure</label>
    <input type="time" class="form-control" id="exampleInputPassword1" name="tm" placeholder="'.$row['heure'].'" value="'.$row['heure'].'">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Changer la description</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="ds" placeholder="'.$row['descriptionn'].'" value="'.$row['descriptionn'].'">
  </div>
  <input type="hidden" value="'.$row['id_rdv'].'" name="rdv">
  <button type="submit" class="btn btn-primary" name="changerdv">Changer</button>
</form></br></br>
<a href="docteur.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Retour</a>
     ';
}
//////////////////////////////////////////////
if(isset($_REQUEST['rendezvouspatient']))
{
    echo '
  <table class="table table-striped" id="table-table">
  <thead>
    <tr>
      <th scope="col">Remarque</th>
      <th scope="col">#Numero Dossier</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Date</th>
      <th scope="col">Heure</th>
      <th scope="col">Telephone</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>



    </tr>
  </thead>
  <tbody>';
  $k = $_REQUEST['rendezvouspatient'];
$sql = "SELECT * FROM `demandes` WHERE `cas` = 'oui' AND `con` =1 AND `to` ='$k'";
$result = mysqli_query($conn,$sql);
   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
   $v = $row['from'];

     $sqluser = " SELECT *
FROM `rdv`
FULL JOIN `user`
WHERE `id_patient` = '$v'
AND `id_user` = '$v'
ORDER BY `date` DESC";
        $resultuser = mysqli_query($conn,$sqluser);

        while($rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC)){
       if($rowuser['date'] == date('Y-m-d'))
       {
        $flag = "aujourd'hui";
       }elseif(date('Y-m-d') < $rowuser['date']){
        $flag = "Attendre";
       }else{
        $flag = "Il a passé";
       }


    echo "
<tr>
      <th scope='row'>".$flag."</th>
      <th scope='row'>".$rowuser["id_user"]."</th>
      <th scope='row'>".$rowuser['nom']."</th>
      <th scope='row'>".$rowuser['prenom']."</th>
      <th scope='row'>".$rowuser['date']."</th>
      <th scope='row'>".$rowuser['heure']."</th>
      <th scope='row'>".$rowuser['telephone']."</th>
      <th scope='row'>".$rowuser['descriptionn']."</th>
      <th scope='row'>
      <button type='button' class='btn btn-link' onclick='suprdvv(".$rowuser["id_rdv"].")'>Supprimer RDV</button><br>
      <button type='button' class='btn btn-link' onclick='changea(".$rowuser["id_rdv"].")'> Change Rendez-Vous</button
      </th>
      
</tr>
    ";
  }
   }
 echo '
  </tbody>
</table>';
echo"
<button type='button' class='btn btn-primary' onclick='ajouterunrdv()'>Ajouter un RDV</button>

</br></br>";
echo"
<button type='button' class='btn btn-danger' onclick='gestion()' id='ajouterunregg'>Retour</button>

";
}
//////////////////////////////////////////////////
if(isset($_REQUEST['reglement']))
{
    echo '
  <table class="table table-striped" id="table-table">
  <thead>
    <tr>
      <th scope="col">Remarque</th>
      <th scope="col">#Numero Dossier</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Date de dernier Paiement</th>
      <th scope="col">Telephone</th>
      <th scope="col">Paye</th>
      <th scope="col">Reste</th>
      <th scope="col">Montant Complet</th>
      <th scope="col">Ajouter un paiement</th>
      <th scope="col">Action</th>



    </tr>
  </thead>
  <tbody>';

  $k = $_REQUEST['reglement'];

$sql = " SELECT * FROM `demandes` WHERE `cas` = 'oui' AND `con` = 1 AND `to` ='$k' ";
$result = mysqli_query($conn,$sql);
   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
   $v = $row['from'];

     $sqluser = " SELECT *
FROM `reglement`
FULL JOIN `user`
WHERE `id_patient` = '$v'
AND `id_user` = '$v'
ORDER BY `date` DESC";
        $resultuser = mysqli_query($conn,$sqluser);

    while($rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC)){
       if($rowuser['date'] == date('Y-m-d'))
       {
        $flag = "aujourd'hui";
       }elseif(date('Y-m-d') < $rowuser['date']){
        $flag = "Attendre";
       }else{
        $flag = "Il a passé";
       }

      if($rowuser['montant'] == $rowuser['reste'])
       {
        $flag = "Paiement terminé";
       }else{
        $flag = "Paiement n'pas terminé";
       }

  $reste = $rowuser['montant'] - $rowuser['paye'] ;

    echo "
<tr>
      <th scope='row'>".$flag."</th>
      <th scope='row'>".$rowuser["id_user"]."</th>
      <th scope='row'>".$rowuser['nom']."</th>
      <th scope='row'>".$rowuser['prenom']."</th>
      <th scope='row'>".$rowuser['date']."</th>
      <th scope='row'>".$rowuser['telephone']."</th>
      <th scope='row'>".$rowuser['paye']." DH</th>
      <th scope='row'>".$reste." DH</th>
      <th scope='row'>".$rowuser['montant']."DH</th>
      <th scope='row'>
      <form method='POST' action='server.php'>

         <input type='text' name='paye' style='width: 83px;'>
         <input type='hidden' value=".$rowuser["id_reglement"]." name='reg'>
         <input type='hidden' value=".$rowuser["paye"]." name='p'>


          <br>
          <br>
         <button class='btn btn-outline-secondary' type='submit' id='button-addon2' name='saisirreg' >Saisir</button>
      </form>
      </th>
      <th scope='row'>
      <button type='button' class='btn btn-link' onclick='suprdvv(".$rowuser["id_reglement"].")'>Supprimer la facture</button><br>
      </th>
      
</tr>
    ";
  }
   }
 echo '
  </tbody>
</table>';
echo"
<button type='button' class='btn btn-primary' onclick='ajouterunregg()' id='ajouterunregg'>Ajouter un Reglement</button></br></br>

";
echo"
<button type='button' class='btn btn-danger' onclick='gestion()' id='ajouterunregg'>Retour</button>

";
}
/////////////////////////////////////////
if(isset($_POST['saisirreg']))
{
  $paye = $_POST['paye'];
  $p = $_POST['p'];
  $somme = $paye + $p;
  $reg = $_POST['reg'];
  $sql = "UPDATE `reglement` SET `paye`='$somme' WHERE `id_reglement` = '$reg'";
  $result = mysqli_query($conn,$sql);
  if($result){

    echo '
       <div class="alert alert-primary" role="alert">
        Le montant a changé
       </div>
    ';
    header("Refresh: 5; url=docteur.php");

  }
}
///////////////////////////////////////////////////////
if(isset($_REQUEST['ajouterunrdv']))
{
   echo '
  <form method="POST" action="server.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Entre Numero Dossier de Patient SVp</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="dossie" placeholder="" value="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Saisir la date de RDV</label>
    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="dt">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Saisir l avance</label>
    <input type="time" class="form-control" id="exampleInputPassword1" name="tm" >
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="ds" >
  </div>

  <input type="hidden" value="" name="rdv">
  <button type="submit" class="btn btn-primary" name="saisirunrdv">Saisir</button>
</form></br></br>
<a href="docteur.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Retour</a>

     ';
}
///////////////////////////////////////
if(isset($_REQUEST['ajouterunregg']))
{
  echo '

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Tres Important : Attention !</h4>
  <p>
  Faites attention aux instructions pour saisir les informations correctes. Les informations sur le numéro de dossier doivent être pour la première fois. Une personne inscrite n est pas autorisée à le répéter. Soit en termes de traitement, vous pouvez traiter ou modifier les informations de la page précédente.
  </p>
  <hr>
  <p class="mb-0">Nous espérons que vous l avez compris et merci beaucoup.</p>
</div>
  ';
   echo '
  <form method="POST" action="server.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Entre Numero Dossier de Patient SVP</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="dossie" placeholder="" value="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Saisir la  date</label>
    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="dt">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Saisir la montant</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="sm" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Saisir l avance</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="sa" placeholder="" >
  </div>
  <input type="hidden" value="" name="rdv">
  <button type="submit" class="btn btn-primary" name="saisirunkkk">Saisir</button>
</form>
     ';
}
///////////////////////////////////////
if(isset($_POST['saisirunkkk']))
{

$dossie = $_POST['dossie'];
$dt =  $_POST['dt'];
$sm = $_POST['sm'];
$sa = $_POST['sa'];

$sql = " INSERT INTO `reglement`(`id_reglement`, `id_patient`, `montant`, `reste`, `date`, `paye`) VALUES ('','$dossie','$sm',0,'$dt','$sa') ";

$result = mysqli_query($conn,$sql);

if($result)
{
  echo '
<div class="alert alert-primary" role="alert">
Il a Saisir avec succès. Attendez un peu. Vous reviendrez à la page Accuile !
</div>
  ';
    header("Refresh: 5; url=docteur.php");

}

}
///////////////////////////////////////
if(isset($_POST['saisirunrdv']))
{

$dossie = $_POST['dossie'];
$dt =  $_POST['dt'];
$tm = $_POST['tm'];
$ds = $_POST['ds'];

$sql = " INSERT INTO `rdv`(`id_rdv`,`id_patient`,`date`,`heure`,`descriptionn`) VALUES ('','$dossie','$dt','$tm','$ds') ";

$result = mysqli_query($conn,$sql);

if($result)
{
  echo '
<div class="alert alert-primary" role="alert">
Il a Saisir avec succès. Attendez un peu. Vous reviendrez à la page Acceuil !
</div>
  ';
    header("Refresh: 5; url=docteur.php");

}

}
//////////////////// /////////////////notification ////////////////
if(isset($_REQUEST['gestionn']))
{

echo '
<button type="button" class="btn btn-primary" id="mespatient" onclick="mespatient()">Mes Patient</button>
<button type="button" class="btn btn-danger" id="reglement"  onclick="reglement()">Reglement</button>
<button type="button" class="btn btn-warning" id="rendezvouspatient"  onclick="rendezvouspatient()">Les rendez-vous</button></br></br>

';

}
////////////////////////////////////////////////////
if(isset($_POST['repondremsg']))
{
$msg = $_POST['msg'];
$from = $_SESSION['id_user'];
$to = $_POST['to'];
$temp = date("Y-m-d h:i:sa");
$sql = "INSERT INTO `messages`(`id_message`, `message`, `from`, `to`, `temp`) VALUES (NULL,'$msg','$from','$to','$temp')";

  $result = mysqli_query($conn,$sql);
  if($result)
  {

    header('Location:docteur.php');
  }
}
/////////////////////////////////////////////////////
if(isset($_POST['repondremsgp']))
{
$msg = $_POST['msg'];
$from = $_SESSION['id_user'];
$to = $_POST['to'];
$temp = date("Y-m-d h:i:sa");
$sql = "INSERT INTO `messages`(`id_message`, `message`, `from`, `to`, `temp`) VALUES (NULL,'$msg','$from','$to','$temp')";

  $result = mysqli_query($conn,$sql);
  if($result)
  {
    header('Location:patient.php');

  }
}
////////////////////pou accepte DR -> pat . pat -> dr et //////////////////////////////////
if(isset($_REQUEST['voirp']))
{

  $v = $_SESSION['id_user'];
  $flag  = $_REQUEST['voirp'];
  $sql = " UPDATE `demandes` SET `cas`= 'oui', `con` = 1 WHERE `from` = '$v' AND `to` = '$flag'";
  $result = mysqli_query($conn,$sql);

  if($result)
  {
     header("Refresh: 3; url=patient.php");
  }
 
}





////////////////pour voir profil de patient ///////////
if(isset($_REQUEST['voir']))
{
  $v = $_SESSION['id_user'];
  $flag  = $_REQUEST['voir'];
  $sql = "SELECT * FROM user WHERE id_user ='$flag'";
  $result = mysqli_query($conn,$sql);
  $rowuser = mysqli_fetch_array($result, MYSQLI_ASSOC);
  echo '

<div class="card" style="width:400px;">
  <div class="card-body">
    <h5 class="card-title">'.$rowuser['nom'].' '.$rowuser['prenom'].'</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Email :  '.$rowuser['email'].' </li>
    <li class="list-group-item">Telephone : '.$rowuser['telephone'].'</li>
    <li class="list-group-item">Adresse : '.$rowuser['adresse'].'<br>'.$rowuser['ville'].' , '.$rowuser['code_postal'].'<br>'.$rowuser['pays'].'</li>
  </ul>
  <div class="card-body">
<div class="alert alert-danger" role="alert">
Attention! Ces informations sont personnelles aux patients, ce qui signifie qu elles ne peuvent pas être partagées avec d autres parties , En tant que médecin, soyez professionnel Sinon, il y a des conséquences, le compte sera créé, votre compte sera mis sur liste noire , ce sera aussi un suivi juridique
</div>
  </div>
</div>

  ';



}
///////////por voir profil et existe la possiblite de modification ////
if(isset($_REQUEST['moncompte']))
{
  
  $flag  = $_REQUEST['moncompte'];
  $sql = "SELECT * FROM `user` WHERE id_user = '$flag' ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  echo' <form action="server.php" method="POST" class="needs-validation" id="moddocteur">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Nom</label>
      <input type="text" class="form-control" name="nom" value="'. $row['nom'].'" placeholder='.$row['nom'].' >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Prénom</label>
      <input type="text" class="form-control" name="prenom" value="'. $row['prenom'].'" placeholder='.$row['prenom'].'>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Téléphone </label>
      <input type="text" class="form-control" name="telephone" value="'. $row['telephone'].'" placeholder='.$row['telephone'].' >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Email</label>
      <input type="text" class="form-control" name="email" value="'. $row['email'].'" placeholder='.$row['email'].'>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Nom de Cabinet </label>
      <input type="text" class="form-control" name="nomcabinet" value="'. $row['nomcabinet'].'" placeholder='.$row['nomcabinet'].' >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label >Spécialité de Cabinet </label>
      <select name="specialite" class="custom-select" >
  <option value="'. $row['Specialite'].'">'.$row['Specialite'].'</option>
  <option value="medecins-generalistes">Médecine Générale</option>
  <option value="gynecologie-obstetrique">Gynécologie-obstétrique</option>
  <option value="pediatrie">Pédiatrie</option>
  <option value="ophtalmologie">Ophtalmologie</option>
  <option value="cardiologie">Cardiologie</option>
  <option value="chirurgie">Chirurgie</option>
  <option value="dermatologie-et-venereologie">Dermatologie Et Vénéréologie</option>
  <option value="gastro-enterologie-et-hepatologie">Gastro-entérologie Et Hépatologie</option>
  <option value="oto-rhino-laryngologie">Oto-rhino-laryngologie</option>
  <option value="chirurgie-orthopedique-et-traumatologique">Chirurgie Orthopédique Et Traumatologique</option>
  <option value="diabetologie-endocrinologie-nutrition">Diabétologie-endocrinologie-nutrition</option>
  <option value="pneumologie">Pneumologie</option>
  <option value="radiologie">Radiologie</option>
  <option value="urologie">Urologie</option>
  <option value="rhumatologie">Rhumatologie</option>
  <option value="psychiatrie">Psychiatrie</option>
  <option value="nephrologie">Néphrologie</option>
  <option value="anesthesiologie-reanimation-chirurgicale">Anesthésiologie-réanimation Chirurgicale</option>
  <option value="neurochirurgie">Neurochirurgie</option>
  <option value="anatomie-et-cytologie-pathologiques">Anatomie Et Cytologie Pathologiques</option>
  <option value="neurologie">Neurologie</option>
  <option value="chirurgie-plastique-reconstructrice-et-esthetique">Chirurgie Plastique, Reconstructrice Et Esthétique</option>
  <option value="biologie-medicale-et-physiologie">Biologie Médicale Et Physiologie</option>
  <option value="neuropsychiatrie">Neuropsychiatrie</option>
  <option value="oncologie">Oncologie</option>
  <option value="allergologie">Allergologie</option>
  <option value="chirurgie-infantile">Chirurgie Infantile</option>
  <option value="medecins-salaries">Médecins Salariés</option>
  <option value="hematologie">Hématologie</option>
  <option value="chirurgie-maxillo-faciale-et-stomatologie">Chirurgie Maxillo-faciale Et Stomatologie</option>
  <option value="angiologie">Angiologie</option>
  <option value="medecine-du-sport">Médecine Du Sport</option>
  <option value="osteopathie">Ostéopathie</option>
  <option value="ambulances-et-assistance-sanitaire">Ambulances Et Assistance Sanitaire</option>
  <option value="dentiste">Chirurgien-Dentiste</option>
  <option value="stomatologie">Stomatologie</option>
  <option value="geriatrie">Gériatrie</option>
  <option value="chirurgie-urologique">Chirurgie Urologique</option><option value="pedodontie">Pédodontie</option>
  <option value="medecine-d-urgence">Médecine D urgence</option>
  <option value="hemodialyse-centres-d">Hémodialyse (centres D)</option>
  <option value="pedopsychiatrie">Pédopsychiatrie</option>
  <option value="medecins-generalistes-medecine-du-travail">Médecine Du Travail</option>
  <option value="pediatres">Pédiatres</option>
  <option value="medical-appareils-et-instruments">Médical (appareils Et Instruments)</option>
  <option value="syndicats-et-ordres-professionnels">Syndicats Et Ordres Professionnels</option>
  <option value="kinesitherapeutes">Kinésithérapeutes</option>
  <option value="ambulances-et-assistance-sanitaire-transports-sanitaires-internationaux">Ambulances Transports Sanitaires Internationaux</option>
  <option value="pathologie-du-sommeil">Pathologie Du Sommeil</option>
  <option value="cliniques-chirurgicales">Cliniques Chirurgicales</option>
  <option value="angiologie-chirurgie">Angiologie Chirurgie</option>
  <option value="audition-appareils-audioprothesistes-et-surdite">Audition (appareils) Audioprothésistes Et Surdité</option>
  <option value="laboratoires-d-analyses-biologiques-ou-medicales-gynecologie-obstetrique">Laboratoires D analyses Biologiques Ou Médicales Gynécologie-obstétrique</option>
  <option value="ophtalmologie-cliniques-et-centres-d-ophtalmologie">Ophtalmologie Cliniques Et Centres D ophtalmologie</option>
  <option value="chirurgie-digestive">Chirurgie Digestive</option>
  <option value="pharmacies">Pharmacies</option>
  <option value="infirmiers">Infirmiers</option>
  <option value="medecins-generalistes-medecine-interne">Médecine Interne</option>
  <option value="cliniques-et-centres-de-radiologie">Cliniques Et Centres De Radiologie</option>
  <option value="pediatre-homeopathe">Pédiatre Homéopathe</option>
  <option value="chirurgie-vasculaire">Chirurgie Vasculaire</option>
  <option value="cliniques-dentaires">Cliniques Dentaires</option>
  <option value="ambulance-et-assistance-sanitaire">Ambulances Et Assistance Sanitaire</option>
  <option value="esthetique">Esthétique</option>
  <option value="psychologues-psychanalystes">Psychologues - Psychanalystes</option>
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
    </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Faculté, École, Institut </label>
      <input type="text" class="form-control" name="uni" value="'. $row['etablissement'].'" placeholder='.$row['etablissement'].' >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Formation</label>
      <input type="text" class="form-control" name="formation" value="'. $row['certificate'].'" placeholder='.$row['certificate'].'  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02"> Address </label>
      <input type="text" class="form-control" name="address" value="'. $row['adresse'].'" placeholder='.$row['adresse'].'  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Address 2</label>
      <input type="text" class="form-control" name="addressdeux">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-12 mb-3">
    <label for="validationTextarea">Description du cabinet</label>
    <input class="form-control " name="description"  value="'. $row['description'].'" placeholder='.$row['description'].' style="height:100px;">
    <input type="hidden" value="flag" name="flag">
  </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Ville</label>
      <input type="text" class="form-control" name="ville" value="'. $row['ville'].'" placeholder='.$row['ville'].'>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
<div class="col-md-6 mb-3">
      <label for="validationCustom03">Region</label>
      <input type="text" class="form-control" name="region" value="'. $row['region'].'" placeholder='.$row['region'].'>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label >Code Postal</label>
      <input type="text" name ="codepost" class="form-control" id="validationCustom05" value="'. $row['code_postal'].'" placeholder='.$row['code_postal'].'>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label name="pays">Pays</label>
      <select name="pays" class="custom-select" id="validationCustom04" required>

<option value="'.$row['pays'].'" selected="selected">'.$row['pays'].' </option>
<option value="Afrique_Centrale">Afrique_Centrale </option>
<option value="Afrique_du_sud">Afrique_du_Sud </option>
<option value="Algerie">Algerie </option>
<option value="Angola">Angola </option>
<option value="Belgique">Belgique </option>
<option value="Botswana">Botswana </option>
<option value="Burkina_Faso">Burkina_Faso </option>
<option value="Burundi">Burundi </option>
<option value="Cameroun">Cameroun </option>
<option value="Canada">Canada </option>
<option value="Comores">Colombie </option>
<option value="Congo">Congo </option>
<option value="Congo_democratique">Congo_democratique </option>
<option value="Djibouti">Djibouti </option>
<option value="France">France </option>
<option value="Gabon">Gabon </option>
<option value="Gambie">Gambie </option>
<option value="Ghana">Ghana </option>
<option value="Gibraltar">Gibraltar </option>
<option value="Guernesey">Guernesey </option>
<option value="Guinee">Guinee </option>
<option value="Guinee_Bissau">Guinee_Bissau </option>
<option value="Guinee equatoriale">Guinee_Equatoriale </option>
<option value="Guyana">Guyana </option>
<option value="Guyane_Francaise ">Guyane_Francaise </option>
<option value="Kenya">Kenya </option>
<option value="Lesotho">Lesotho </option>
<option value="Liban">Liban </option>
<option value="Liberia">Liberia </option>
<option value="Luxembourg">Luxembourg </option>
<option value="Lybie">Lybie </option>
<option value="Madagascar">Madagascar </option>
<option value="Malawi">Malawi </option>
<option value="Mali">Mali </option>
<option value="Man">Man </option>
<option value="Mariannes du Nord">Mariannes du Nord </option>
<option value="Maroc">Maroc </option>
<option value="Mauritanie">Mauritanie </option>
<option value="Monaco">Monaco </option>
<option value="Mozambique">Mozambique </option>
<option value="Namibie">Namibie </option>
<option value="Niger">Niger </option>
<option value="Nigeria">Nigeria </option>
<option value="Rwanda">Rwanda </option>
<option value="Sahara Occidental">Sahara Occidental </option>
<option value="Senegal">Senegal </option>
<option value="Somalie">Somalie </option>
<option value="Suisse">Suisse </option>
<option value="Tanzanie">Tanzanie </option>
<option value="Togo">Togo </option>
<option value="Tunisie">Tunisie </option>
<option value="Zambie">Zambie </option>
<option value="Zimbabwe">Zimbabwe </option>
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
      </div>
    </div>

  </div>

  <button class="btn btn-success" type="submit" name="modifierdocteur" id="modifierdocteur">Modifier</button>
  <button type="submit" class="btn btn-danger" name="annulerdocteur">Annuler</button>
</form>

      

             ';  
      
}
////////////////////////////////////////////////////////////////////////////
///////////por voir profil et existe la possiblite de modification ////
if(isset($_REQUEST['moncomptep']))
{
  
  $flag  = $_REQUEST['moncomptep'];
  $sql = "SELECT * FROM `user` WHERE id_user = '$flag' ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  echo' <form action="server.php" method="POST" class="needs-validation" id="moddocteur">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Nom</label>
      <input type="text" class="form-control" name="nom" value="'. $row['nom'].'" placeholder='.$row['nom'].' >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Prénom</label>
      <input type="text" class="form-control" name="prenom" value="'. $row['prenom'].'" placeholder='.$row['prenom'].'>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Téléphone </label>
      <input type="text" class="form-control" name="telephone" value="'. $row['telephone'].'" placeholder='.$row['telephone'].' >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Email</label>
      <input type="text" class="form-control" name="email" value="'. $row['email'].'" placeholder='.$row['email'].'>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <label for="validationCustom02"> Address </label>
      <input type="text" class="form-control" name="address" value="'. $row['adresse'].'" placeholder='.$row['adresse'].'  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Address 2</label>
      <input type="text" class="form-control" name="addressdeux">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Ville</label>
      <input type="text" class="form-control" name="ville" value="'. $row['ville'].'" placeholder='.$row['ville'].'>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
<div class="col-md-6 mb-3">
      <label for="validationCustom03">Region</label>
      <input type="text" class="form-control" name="region" value="'. $row['region'].'" placeholder='.$row['region'].'>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label >Code Postal</label>
      <input type="text" name ="codepost" class="form-control" id="validationCustom05" value="'. $row['code_postal'].'" placeholder='.$row['code_postal'].'>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label name="pays">Pays</label>
      <select name="pays" class="custom-select" id="validationCustom04" required>

<option value="'.$row['pays'].'" selected="selected">'.$row['pays'].' </option>
<option value="Afrique_Centrale">Afrique_Centrale </option>
<option value="Afrique_du_sud">Afrique_du_Sud </option>
<option value="Algerie">Algerie </option>
<option value="Angola">Angola </option>
<option value="Belgique">Belgique </option>
<option value="Botswana">Botswana </option>
<option value="Burkina_Faso">Burkina_Faso </option>
<option value="Burundi">Burundi </option>
<option value="Cameroun">Cameroun </option>
<option value="Canada">Canada </option>
<option value="Comores">Colombie </option>
<option value="Congo">Congo </option>
<option value="Congo_democratique">Congo_democratique </option>
<option value="Djibouti">Djibouti </option>
<option value="France">France </option>
<option value="Gabon">Gabon </option>
<option value="Gambie">Gambie </option>
<option value="Ghana">Ghana </option>
<option value="Gibraltar">Gibraltar </option>
<option value="Guernesey">Guernesey </option>
<option value="Guinee">Guinee </option>
<option value="Guinee_Bissau">Guinee_Bissau </option>
<option value="Guinee equatoriale">Guinee_Equatoriale </option>
<option value="Guyana">Guyana </option>
<option value="Guyane_Francaise ">Guyane_Francaise </option>
<option value="Kenya">Kenya </option>
<option value="Lesotho">Lesotho </option>
<option value="Liban">Liban </option>
<option value="Liberia">Liberia </option>
<option value="Luxembourg">Luxembourg </option>
<option value="Lybie">Lybie </option>
<option value="Madagascar">Madagascar </option>
<option value="Malawi">Malawi </option>
<option value="Mali">Mali </option>
<option value="Man">Man </option>
<option value="Mariannes du Nord">Mariannes du Nord </option>
<option value="Maroc">Maroc </option>
<option value="Mauritanie">Mauritanie </option>
<option value="Monaco">Monaco </option>
<option value="Mozambique">Mozambique </option>
<option value="Namibie">Namibie </option>
<option value="Niger">Niger </option>
<option value="Nigeria">Nigeria </option>
<option value="Rwanda">Rwanda </option>
<option value="Sahara Occidental">Sahara Occidental </option>
<option value="Senegal">Senegal </option>
<option value="Somalie">Somalie </option>
<option value="Suisse">Suisse </option>
<option value="Tanzanie">Tanzanie </option>
<option value="Togo">Togo </option>
<option value="Tunisie">Tunisie </option>
<option value="Zambie">Zambie </option>
<option value="Zimbabwe">Zimbabwe </option>
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
      </div>
    </div>

  </div>

  <button class="btn btn-success" type="submit" name="modifierdocteur" id="modifierdocteur">Modifier</button>
  <button type="submit" class="btn btn-danger" name="annulerpatient">Annuler</button>
</form>

      

             ';  
      
}
/////////// pour modification de profil ////////
if(isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['telephone']) AND isset($_POST['email']) AND isset($_POST['nomcabinet']) AND isset($_POST['specialite']) AND isset($_POST['uni']) AND isset($_POST['formation']) AND isset($_POST['address']) AND isset($_POST['description']) AND isset($_POST['ville']) AND isset($_POST['region']) AND isset($_POST['pays']) AND isset($_POST['codepost']) AND isset($_POST['flag'])){ 

   if($_POST['flag'] == "flag"){
   
  $v = $_SESSION['id_user'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $telephone = $_POST['telephone'];
  $email = $_POST['email'];
  $nomcabinet = $_POST['nomcabinet'];
  $specialite = $_POST['specialite'];
  $uni = $_POST['uni'];
  $formation = $_POST['formation'];
  $address = $_POST['address'];
  $description = $_POST['description'];
  $ville = $_POST['ville'];
  $region = $_POST['region'];
  $pays = $_POST['pays'];
  $codepost = $_POST['codepost'];
  $sql = "UPDATE `user` SET `nom`='$nom',`prenom`='$prenom',`ville`='$ville',`telephone`='$telephone',`adresse`='$address',`pays`='$pays',`region`='$region',`code_postal`='$codepost',`email`='$email',`Specialite`='$specialite',`etablissement`=' $uni',`certificate`='$formation',`description`='$description',`nomcabinet`='$nomcabinet' WHERE `id_user`='$v'";
    $result = mysqli_query($conn,$sql);
    if($result){
         echo '
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Bravo!!</h4>
  <p>Les informations ont été modifiées avec succès. Veuillez cliquer sur le lien ci-dessous pour revenir à la page officielle</p>
  <hr>
  <a href ="docteur.php">Cliquez ici</a>
</div>


         ';
    }
}else{
  header('Location:erreur.php');
}
}
//////////// pour annulation de modification /////
if(isset($_POST['annulerdocteur']))
{
 header('Location:docteur.php');
}
if(isset($_POST['annulerpatient']))
{
 header('Location:patient.php');
}

//////////////// pou accepte le demande de patient//////////////////////////
if(isset($_REQUEST['accepter']))
{
  $v = $_SESSION['id_user'];
  $flag  = $_REQUEST['accepter'];
   $sql = "UPDATE `demandes` SET `cas`= 'oui'  WHERE `from` = '$flag' AND `to` = '$v'";
  $result = mysqli_query($conn,$sql);

        

}

//////////pour refusse la demande de patient //////////////////////////////////
if(isset($_REQUEST['refusse']))
{
  $v = $_SESSION['id_user'];
  $flag  = $_REQUEST['refusse'];
   $sql = "DELETE FROM `demandes` WHERE `from` = '$flag' ";
  $result = mysqli_query($conn,$sql);


}
////////////// pour notifications a chaque use / table table-striped//
if(isset($_REQUEST['notification']))
{
  $v = $_SESSION['id_user'];
  $sql = "SELECT * FROM `demandes` WHERE `to` ='$v' AND con = 0";
  $result = mysqli_query($conn,$sql);
            
   // Check number of rows in the result set
if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $id = $row['from'];
    $sqluser = "SELECT * FROM `user` WHERE id_user='$id'";
    $resultuser = mysqli_query($conn,$sqluser);
    $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);



echo " <li class='list-group-item d-flex justify-content-between align-items-center' id=".$rowuser['id_user'].">
          <h5> ".$rowuser['nom']." ".$rowuser['prenom']."</h5> vous demande d'accepter un rendez-vous médical
           <button type='button' class='btn btn-success' onclick='accepter(".$rowuser['id_user'].")'>Accepter</button>
           <button type='button' class='btn btn-danger' onclick='refusse(".$rowuser['id_user'].")'>Refusse</button>
           <button type='button' class='btn btn-info' onclick='voir(".$rowuser['id_user'].")' >Voir profil patient</button>



       </li>";
}
}
}
//////////////////////// notification de patient //////
////////////// pour notifications a chaque use ///
if(isset($_REQUEST['notificationp']))
{
  $v = $_SESSION['id_user'];
  $sql = "SELECT * FROM `demandes` WHERE `from` ='$v' AND con = 0 AND cas = 'oui'";
  $result = mysqli_query($conn,$sql);
            
   // Check number of rows in the result set
if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $id = $row['to'];
    $sqluser = "SELECT * FROM `user` WHERE id_user='$id'";
    $resultuser = mysqli_query($conn,$sqluser);
    $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);



echo " <li class='list-group-item d-flex justify-content-between align-items-center' id=".$rowuser['id_user'].">
          <h5> Docteur ".$rowuser['nom']." ".$rowuser['prenom']."</h5>Votre demande a été acceptée
          <button type='button' class='btn btn-info' onclick='voirp(".$rowuser['id_user'].")' >Accepter un rendez-vous avec un médecin</button>
       </li>";
}
}
}
      
////////////// pour voir les messages ////   messagesdocteur/
if(isset($_REQUEST['messages']))
{

$flag =  $_REQUEST['messages'];

$sql = "SELECT *
FROM `messages`
WHERE (
`from` = '$flag'
OR `to` = '$flag'
)
ORDER BY temp DESC";

$result = mysqli_query($conn,$sql);


           
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

        $v  = $row['from'];
      
      $sqluser = " SELECT * FROM user WHERE id_user ='$v' ";
      $resultuser = mysqli_query($conn,$sqluser);
      $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);
      $nomuser = $rowuser['nom'];
      $prenomuser = $rowuser['prenom'];




        if($row['from'] == $flag)
        {
          $img = 'photo/small-logo.png';
        }else{

          $img = 'photo/download.jpg';
        }

    echo '<div class="a">
  <img src="'.$img.' "width="50" height="50"> <h2>'.$nomuser." ".$prenomuser.'</h2>
<p>'.$row["message"].'</p>
</div>
<div></div><div></div>';

                }
 

  echo'
<form class="was-validated">
  <div class="mb-3">
    <label for="validationTextarea">Répondre</label>
    <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Required example textarea" required></textarea>
    <div class="invalid-feedback">
      Please enter a message in the textarea.
    </div>
    <button class="btn btn-primary" type="submit">Répondre</button>
  </div>
  ';
}

///////////// disc pour prendre Rendez Vous //////

if(isset($_POST['demande']))
{
$from = $_POST['from'];
$to  = $_POST['to'];
$tel = $_POST['tel'];
$temp = date("Y-m-d h:i:sa");
$cas = 'non';
 

      $sql = " SELECT * FROM user WHERE id_user ='$from' ";
      $resultq = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($resultq, MYSQLI_ASSOC);
      $flag = $row['telephone'];

      if($flag == $tel)
      {

     $sqldemande = "INSERT INTO `demandes`(`id_demande`, `from`, `to`, `temp`,`cas`) VALUES (NULL,'$from','$to','$temp','$cas')";
          $result = mysqli_query($conn,$sqldemande);
          if($result)
          {
           echo '
                  <script>
                  location.replace("patient.php");

                  </script>
           ';
          
           }
         }

        if($flag != $tel){
            header('location:erreur.php?rdv=rdv');    
          } 


      
      


}



////// pour prendre un RDv/////
if(isset($_POST['prendre']))
{

  
    if(isset($v)){
      $user = $_POST['user'];
      $sql = " SELECT * FROM user WHERE id_user ='$v' ";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $nom = $row['nom'];
      $prenom = $row['prenom'];


       echo '
<div class="jumbotron">
  <h1 class="display-4">Salut! '.$nom.'  '.$prenom.'</h1>
  <p class="lead">Nous voulons vous informer, êtes-vous sûr de vouloir contacter ce médecin? et prendre rendez-vous...</p>
  <hr class="my-4">
  <p>Où cliquer sur le bouton ci-dessous pour confirmer le rendez-vous et vous devez entrer votre feuille de téléphone s il vous plaît</p>
  <form  action="server.php" method="POST" class="needs-validation" novalidate >

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationTooltip03">Numéro de téléphone SVP ?</label>
      <input type="text" class="form-control" id="validationTooltip03" name ="tel">
      <input type="hidden" name="to" value ="'.$user.'">
      <input type="hidden" name="from" value ="'.$v.'">

    </div>
    <button class="btn btn-primary" type="submit" name ="demande"> Prendre RDV</button>
  </div>
  </form>  
  
       ';
   }else{

         header('location:erreur.php?prendre=prendre');
       }
}

/////////// ajouter un poste //////// 
if(isset($_POST['publier']))
{
  $v = $_SESSION['id_user'];
  $objet = $_POST['objet'];
  $temp = $today = date("Y-m-d h:i:sa");
  $sql = "INSERT INTO `med`.`posts` (`id_post` ,`post` ,`temp` ,`id_user`)VALUES (NULL, '$objet','$temp', '$v')";
$result = mysqli_query($conn,$sql);
if($result)
{
 header('location:consultation.php');
}

}


//////////// sup un comment//////////
if(isset($_GET['sup-comment']))
{
  $flag = $_GET['sup-comment'];
  $sql = "DELETE FROM `commentaires` WHERE `id_commentaires` ='$flag'";
  $result = mysqli_query($conn,$sql);
  if($result)
  {
    header('Location:consultation.php');
  }

}

//////////pour ajoute un commentaire a ///
 
if( isset($_POST["id_post"]) and isset($_POST['msg']) ){
  if(!empty($_POST['msg'])){
$user = $_SESSION['id_user'];   
$msg = $_POST['msg'];
$id_post = $_POST['id_post'];
$temp = date("Y-m-d h:i:sa");
$sql = "INSERT INTO `commentaires`(`id_commentaires`, `commentaire`, `id_post`, `id_user`, `temp`) VALUES (NULL,'$msg','$id_post','$user','$temp')";
 $result = mysqli_query($conn,$sql);
 if($result)
 {
      header('Location:consultation.php');

 }
}else{
        header('Location:consultation.php');
}


}
///////// pour enregistre a chaque post 

if(isset($_GET['eng']))
{

  $user = $_SESSION['id_user'];


$val = $_GET['eng']; 
$sql = "INSERT INTO `med`.`eng` (`id_eng`,`id_post`,`id_user`) VALUES ( NULL , '$val','$user')";
 $result = mysqli_query($conn,$sql);

 if($result)
 {
  header('Location:consultation.php');
 }

}
////// pour realise les commentaires a chaque statue ///////
if(isset($_POST['commente']))
{

$user = $_SESSION['id_user'];
$today = date("Y-m-d h:i:sa");
$val = $_POST['commenter']; 
$post = $_POST['post'];
$sql = "INSERT INTO `med`.`commentaires` (
`id_commentaires` ,
`commentaire` ,
`temp` ,
`id_post` ,
`id_user`,

)
VALUES (
NULL , '$val', '$today', '$post', '$user')";
 $result = mysqli_query($conn,$sql);

 if($result)
 {
  header('Location:consultation.php');
 }


}

//////////////// pour suprimmer a chaque  a chaque post ou statue //
if(isset($_GET['sup']))
{

$user = $_SESSION['id_user'];
$val = $_GET['sup']; 
$sql = " DELETE FROM `posts` WHERE `id_post`='$val' ";
$result = mysqli_query($conn,$sql);

 if($result)
 {
  header('Location:consultation.php');
 }


}

///////////////// pour lancer la post ou statue ////////
 if(isset($_POST["submit-pub"])){

   $user = $_SESSION['id_user'];
   $msg = $_POST["objet"];
   $today = date("Y-m-d h:i:sa"); 

    $sql = "INSERT INTO posts (id_post,post,temp,id_user) VALUES (NULL,'$msg,'$today','$user')";
    $result = mysqli_query($conn,$sql);
      

       mysqli_close($conn);    
       header("location:consultation.php");
   }

/////////////// recherche live  /////////////////////////////////////////

 if(isset($_POST['specialite']) AND isset($_POST['nom']) AND isset($_POST['ville']) and !isset($_POST['flag']))
 {

  $ville = $_POST['ville'];
  $specialite = $_POST['specialite'];
  $nom = $_POST['nom'];
  

  $sql = "SELECT * FROM user WHERE type_user ='docteur' AND ville ='$ville' AND nom = '$nom' AND Specialite = '$specialite' ";
  $result = mysqli_query($conn,$sql);
            
   // Check number of rows in the result set
    if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

echo " <div class='col' style='margin-top:20px;'>
  <div class='card' style='width: 18rem;''>
  <img src='photo/download.jpg' class='card-img-top' alt='docteur'style='height:100px; width:100px;'>
  <div class='card-body'>
    <h5 class='card-title'>Dr.".$row['nom']." ".$row['prenom']."</h5>
    <p class='card-text'><span uk-icon='info'></span>  Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'><span uk-icon='location'></span>".$row['adresse']."<br>".$row['ville']." - ".$row['code_postal']."<br>".$row['pays']."</li>
    <li class='list-group-item'><span uk-icon='receiver'></span>  ".$row['telephone']."</li>
    <li class='list-group-item'><span uk-icon='copy'></span>".$row['Specialite']."</li>
  </ul>
  <div class='card-body'>
<form action='server.php' method='POST'>
  <input type='hidden' name='user' value=".$row['id_user'].">
<button type='button' class='btn btn-success' name='prendre'>Prendre un rendez-vous</button>
</form>

  </div>
</div>



                    </div>";
 }
}
}


if(isset($_REQUEST["s"])){
    // Prepare a select statement
    $search = $_REQUEST["s"];
    $sql = "SELECT * FROM user WHERE type_user ='docteur' AND Specialite LIKE '$search%'";
    $result = mysqli_query($conn,$sql);
            
   // Check number of rows in the result set
    if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                   echo " <div class='col' style='margin-top:20px;'>
  <div class='card' style='width: 18rem;''>
  <img src='photo/download.jpg' class='card-img-top' alt='docteur'style='height:100px; width:100px;'>
  <div class='card-body'>
    <h5 class='card-title'>Dr.".$row['nom']." ".$row['prenom']."</h5>
    <p class='card-text'><span uk-icon='info'></span>  Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'><span uk-icon='location'></span>".$row['adresse']."<br>".$row['ville']." - ".$row['code_postal']."<br>".$row['pays']."</li>
    <li class='list-group-item'><span uk-icon='receiver'></span>  ".$row['telephone']."</li>
    <li class='list-group-item'><span uk-icon='copy'></span>".$row['Specialite']."</li>
  </ul>
  <div class='card-body'>

<form method='POST' action='server.php'>
  <input type='hidden' name='user' value=".$row['id_user'].">
<button type='button' class='btn btn-success' name='prendre'>Prendre un rendez-vous</button>
</form>

  </div>
</div>



                    </div>";
                }
            }else{
                echo "<p>No matches found</p>";
            }
  }





if(isset($_REQUEST["q"])){
    // Prepare a select statement
    $search = $_REQUEST["q"];
    $sql = "SELECT * FROM user WHERE type_user ='docteur' AND nom LIKE '$search%'";
    $result = mysqli_query($conn,$sql);
            
   // Check number of rows in the result set
    if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo " <div class='col' style='margin-top:20px;'>
  <div class='card' style='width: 18rem;''>
  <img src='photo/download.jpg' class='card-img-top' alt='docteur'style='height:100px; width:100px;'>
  <div class='card-body'>
    <h5 class='card-title'>Dr.".$row['nom']." ".$row['prenom']."</h5>
    <p class='card-text'><span uk-icon='info'></span>  Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'><span uk-icon='location'></span>".$row['adresse']."<br>".$row['ville']." - ".$row['code_postal']."<br>".$row['pays']."</li>
    <li class='list-group-item'><span uk-icon='receiver'></span>  ".$row['telephone']."</li>
    <li class='list-group-item'><span uk-icon='copy'></span>".$row['Specialite']."</li>
  </ul>
  <div class='card-body'>
<form action='server.php' method='POST'>
  <input type='hidden'name='user' value=".$row['id_user'].">
  <button type='submit' class='btn btn-success' name='prendre'>Prendre un rendez-vous</button>
</form>

  </div>
</div>



                    </div>";
                }
            }else{
                echo "<p>No matches found</p>";
            }
  }


  if(isset($_REQUEST["v"])){
    // Prepare a select statement
    $search = $_REQUEST["v"];
    $sql = "SELECT * FROM user WHERE type_user ='docteur' AND ville LIKE '$search%'";
    $result = mysqli_query($conn,$sql);
            
   // Check number of rows in the result set
    if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                  echo " <div class='col' style='margin-top:20px;'>
  <div class='card' style='width: 18rem;''>
  <img src='photo/download.jpg' class='card-img-top' alt='docteur'style='height:100px; width:100px;'>
  <div class='card-body'>
    <h5 class='card-title'>Dr.".$row['nom']." ".$row['prenom']."</h5>
    <p class='card-text'><span uk-icon='info'></span>  Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'><span uk-icon='location'></span>".$row['adresse']."<br>".$row['ville']." - ".$row['code_postal']."<br>".$row['pays']."</li>
    <li class='list-group-item'><span uk-icon='receiver'></span>  ".$row['telephone']."</li>
    <li class='list-group-item'><span uk-icon='copy'></span>".$row['Specialite']."</li>
  </ul>
  <div class='card-body'>
<form method='POST' action='server.php'>
<input type='hidden' name ='user' value=".$row['id_user'].">
<button type='button' class='btn btn-success' name='prendre'>Prendre un rendez-vous</button>
</form>

  </div>
</div>



                    </div>";
                }
            }else{
                echo "<p>No matches found</p>";
            }
  }

if(isset($_POST['continuer']))
{

  $tel = $_POST['telephone'];
  $pass = $_POST['password'];

  $sql = "SELECT * FROM `user` WHERE `pass` = '$pass' AND `telephone` = '$tel'";
  $result = mysqli_query($conn,$sql);

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['id_user'];
      $flag = $row['type_user'];   

      $_SESSION['id_user'] = $active;
 

         if($flag == "docteur"){
      echo " <script> location.replace('docteur.php'); </script>";
         }
         elseif($flag == "patient"){
      echo " <script> location.replace('patient.php'); </script>";
         }
         else
         {          
       echo " <script> location.replace('erreur.php?login=login'); </script>";
         }
       



}


if(isset($_POST["inscrire"])){
  if($_POST["pass"] != $_POST["rpass"])
  {
    header("Location:erreur.php?erreur=erreurevd");


  }else{


  $nomcabinet = $_POST["nomcabinet"];
  $specialite = $_POST["specialite"];
  $nom = $_POST["nom"];
  $email = $_POST["email"];
  $prenom = $_POST["prenom"];
  $ville = $_POST["ville"];
  $tel = $_POST["telephone"];
  $codepostal = $_POST["codepost"];
  $password = $_POST["pass"];
  $rpassword = $_POST["rpass"];
  $region = $_POST["region"];
  $pays = $_POST["pays"];
  $today = date("m.d.y"); 
  $description = $_POST['description'];
  $uni = $_POST['uni'];
  $address = $_POST['address'];
  $addressdeux = $_POST['addressdeux'];
  $formation = $_POST['formation'];

$sql = "INSERT INTO `med`.`user` (`id_user`, `nom`, `prenom`, `type_user`, `ville`, `telephone`, `adresse`, `pays`, `region`, `code_postal`, `email`, `pass`, `date_creation`, `Specialite`, `etablissement`, `certificate`, `description`, `pin`) VALUES (NULL, '$nom', '$prenom', 'docteur', '$ville', '$tel', '$address', '$pays', '$region', '$codepostal', '$email', '$password', '$today', '$specialite', '$uni', '$formation', '$description', '')";          
         

    $result = mysqli_query($conn,$sql);

    $sqldocteur = " SELECT * FROM `user` WHERE `telephone` = '$tel' AND `type_user` ='docteur' AND `pass` = '$password' ";
    $resultdocteur = mysqli_query($conn,$sqldocteur);
    $rowdocteur = mysqli_fetch_array($resultdocteur,MYSQLI_ASSOC);
    $_SESSION['id_user'] = $rowdocteur['id_user'];
              


    header('Location:docteur.php'); 
    
    
    
}

}




if(isset($_POST["inscrirepatient"])){
  if($_POST["pass"] != $_POST["rpass"])
  {
    header("Location:erreur.php?erreur=erreurrdv");


  }else{


  $nom = $_POST["nom"];
  $email = $_POST["email"];
  $prenom = $_POST["prenom"];
  $ville = $_POST["ville"];
  $tel = $_POST["telephone"];
  $codepostal = $_POST["codepost"];
  $password = $_POST["pass"];
  $rpassword = $_POST["rpass"];
  $region = $_POST["region"];
  $pays = $_POST["pays"];
  $today = date("m.d.y"); 
  $address = $_POST['address'];
  $addressdeux = $_POST['addressdeux'];


$sql = "INSERT INTO `med`.`user` (`id_user`, `nom`, `prenom`, `type_user`, `ville`, `telephone`, `adresse`, `pays`, `region`, `code_postal`, `email`, `pass`, `date_creation`, `Specialite`, `etablissement`, `certificate`, `description`, `pin`) VALUES (NULL, '$nom', '$prenom', 'patient', '$ville', '$tel', '$address', '$pays', '$region', '$codepostal', '$email', '$password', '$today', '', '', '', '', '')";          
         

    $result = mysqli_query($conn,$sql);
    $sqlpatient = " SELECT * FROM `user` WHERE `telephone` = '$tel' AND `type_user` ='patient' AND `pass` = '$password' ";
    $resultpatient = mysqli_query($conn,$sqlpatient);
    $rowpatient = mysqli_fetch_array($resultpatient,MYSQLI_ASSOC);
    $_SESSION['id_user'] = $rowpatient['id_user'];
    header('Location:patient.php'); 
    
    
    
}

}



  if(isset($_POST["connexion_id"]))  
 {  
 
       echo  "
         <form id ='form-connexion' action='server.php' method='POST'>
             <div class='uk-margin'>
                <div class='uk-inline'>
                   <span class='uk-form-icon' uk-icon='icon: user'></span>
                  <input class='uk-input' type='text' name='telephone' placeholder=' Numero Tel'>
               </div>
             </div>

            <div class='uk-margin'>
              <div class='uk-inline'>
               <span class='uk-form-icon uk-form-icon-flip' uk-icon='icon: lock'></span>
               <input class='uk-input' type='password' name='password' placeholder='Mot de passe'>
            </div>
           </div>
            <button class='uk-button uk-button-default' name ='continuer' >Continuer</button>
            <a class='uk-button uk-button-default' href='home.php'>Fermer</a>
         </form>  
             ";  
      
     
      
 }

   if(isset($_POST["evd_id"]))  
 {  
 
echo' <form action="server.php" method="POST" class="needs-validation" novalidate onSubmit = "return checkPassword(this)">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Nom</label>
      <input type="text" class="form-control" name="nom" value=""  onkeyup="myFunction()" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Prénom</label>
      <input type="text" class="form-control" name="prenom" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Téléphone </label>
      <input type="text" class="form-control" name="telephone" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Email</label>
      <input type="text" class="form-control" name="email" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Mot de passe </label>
      <input type="password" class="form-control" name="pass" id="pass"  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Rrépéter mot de passe</label>
      <input type="password" class="form-control" name="rpass" id="rpass"  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Nom de Cabinet </label>
      <input type="text" class="form-control" name="nomcabinet"  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label >Spécialité de Cabinet </label>
      <select name="specialite" class="custom-select" >
      <option value="toutes-specialites">Toutes spécialités...</option>
  <option value="medecins-generalistes">Médecine Générale</option>
  <option value="gynecologie-obstetrique">Gynécologie-obstétrique</option>
  <option value="pediatrie">Pédiatrie</option>
  <option value="ophtalmologie">Ophtalmologie</option>
  <option value="cardiologie">Cardiologie</option>
  <option value="chirurgie">Chirurgie</option>
  <option value="dermatologie-et-venereologie">Dermatologie Et Vénéréologie</option>
  <option value="gastro-enterologie-et-hepatologie">Gastro-entérologie Et Hépatologie</option>
  <option value="oto-rhino-laryngologie">Oto-rhino-laryngologie</option>
  <option value="chirurgie-orthopedique-et-traumatologique">Chirurgie Orthopédique Et Traumatologique</option>
  <option value="diabetologie-endocrinologie-nutrition">Diabétologie-endocrinologie-nutrition</option>
  <option value="pneumologie">Pneumologie</option>
  <option value="radiologie">Radiologie</option>
  <option value="urologie">Urologie</option>
  <option value="rhumatologie">Rhumatologie</option>
  <option value="psychiatrie">Psychiatrie</option>
  <option value="nephrologie">Néphrologie</option>
  <option value="anesthesiologie-reanimation-chirurgicale">Anesthésiologie-réanimation Chirurgicale</option>
  <option value="neurochirurgie">Neurochirurgie</option>
  <option value="anatomie-et-cytologie-pathologiques">Anatomie Et Cytologie Pathologiques</option>
  <option value="neurologie">Neurologie</option>
  <option value="chirurgie-plastique-reconstructrice-et-esthetique">Chirurgie Plastique, Reconstructrice Et Esthétique</option>
  <option value="biologie-medicale-et-physiologie">Biologie Médicale Et Physiologie</option>
  <option value="neuropsychiatrie">Neuropsychiatrie</option>
  <option value="oncologie">Oncologie</option>
  <option value="allergologie">Allergologie</option>
  <option value="chirurgie-infantile">Chirurgie Infantile</option>
  <option value="medecins-salaries">Médecins Salariés</option>
  <option value="hematologie">Hématologie</option>
  <option value="chirurgie-maxillo-faciale-et-stomatologie">Chirurgie Maxillo-faciale Et Stomatologie</option>
  <option value="angiologie">Angiologie</option>
  <option value="medecine-du-sport">Médecine Du Sport</option>
  <option value="osteopathie">Ostéopathie</option>
  <option value="ambulances-et-assistance-sanitaire">Ambulances Et Assistance Sanitaire</option>
  <option value="dentiste">Chirurgien-Dentiste</option>
  <option value="stomatologie">Stomatologie</option>
  <option value="geriatrie">Gériatrie</option>
  <option value="chirurgie-urologique">Chirurgie Urologique</option><option value="pedodontie">Pédodontie</option>
  <option value="medecine-d-urgence">Médecine D urgence</option>
  <option value="hemodialyse-centres-d">Hémodialyse (centres D)</option>
  <option value="pedopsychiatrie">Pédopsychiatrie</option>
  <option value="medecins-generalistes-medecine-du-travail">Médecine Du Travail</option>
  <option value="pediatres">Pédiatres</option>
  <option value="medical-appareils-et-instruments">Médical (appareils Et Instruments)</option>
  <option value="syndicats-et-ordres-professionnels">Syndicats Et Ordres Professionnels</option>
  <option value="kinesitherapeutes">Kinésithérapeutes</option>
  <option value="ambulances-et-assistance-sanitaire-transports-sanitaires-internationaux">Ambulances Transports Sanitaires Internationaux</option>
  <option value="pathologie-du-sommeil">Pathologie Du Sommeil</option>
  <option value="cliniques-chirurgicales">Cliniques Chirurgicales</option>
  <option value="angiologie-chirurgie">Angiologie Chirurgie</option>
  <option value="audition-appareils-audioprothesistes-et-surdite">Audition (appareils) Audioprothésistes Et Surdité</option>
  <option value="laboratoires-d-analyses-biologiques-ou-medicales-gynecologie-obstetrique">Laboratoires D analyses Biologiques Ou Médicales Gynécologie-obstétrique</option>
  <option value="ophtalmologie-cliniques-et-centres-d-ophtalmologie">Ophtalmologie Cliniques Et Centres D ophtalmologie</option>
  <option value="chirurgie-digestive">Chirurgie Digestive</option>
  <option value="pharmacies">Pharmacies</option>
  <option value="infirmiers">Infirmiers</option>
  <option value="medecins-generalistes-medecine-interne">Médecine Interne</option>
  <option value="cliniques-et-centres-de-radiologie">Cliniques Et Centres De Radiologie</option>
  <option value="pediatre-homeopathe">Pédiatre Homéopathe</option>
  <option value="chirurgie-vasculaire">Chirurgie Vasculaire</option>
  <option value="cliniques-dentaires">Cliniques Dentaires</option>
  <option value="ambulance-et-assistance-sanitaire">Ambulances Et Assistance Sanitaire</option>
  <option value="esthetique">Esthétique</option>
  <option value="psychologues-psychanalystes">Psychologues - Psychanalystes</option>
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
    </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Faculté, École, Institut </label>
      <input type="text" class="form-control" name="uni" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Formation</label>
      <input type="text" class="form-control" name="formation"  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02"> Address </label>
      <input type="text" class="form-control" name="address">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Address 2</label>
      <input type="text" class="form-control" name="addressdeux">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-12 mb-3">
    <label for="validationTextarea">Description du cabinet</label>
    <textarea class="form-control " name="description" placeholder="Required example textarea" ></textarea>
    <div class="invalid-feedback">
      Please enter a message in the textarea.
    </div>
  </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Ville</label>
      <input type="text" class="form-control" name="ville">
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
<div class="col-md-6 mb-3">
      <label for="validationCustom03">Region</label>
      <input type="text" class="form-control" name="region">
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label >Code Postal</label>
      <input type="text" name ="codepost" class="form-control" id="validationCustom05">
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label name="pays">Pays</label>
      <select name="pays" class="custom-select" id="validationCustom04" required>

<option value="France" selected="selected">France </option>
<option value="Afrique_Centrale">Afrique_Centrale </option>
<option value="Afrique_du_sud">Afrique_du_Sud </option>
<option value="Algerie">Algerie </option>
<option value="Angola">Angola </option>
<option value="Belgique">Belgique </option>
<option value="Botswana">Botswana </option>
<option value="Burkina_Faso">Burkina_Faso </option>
<option value="Burundi">Burundi </option>
<option value="Cameroun">Cameroun </option>
<option value="Canada">Canada </option>
<option value="Comores">Colombie </option>
<option value="Congo">Congo </option>
<option value="Congo_democratique">Congo_democratique </option>
<option value="Djibouti">Djibouti </option>
<option value="France">France </option>
<option value="Gabon">Gabon </option>
<option value="Gambie">Gambie </option>
<option value="Ghana">Ghana </option>
<option value="Gibraltar">Gibraltar </option>
<option value="Guernesey">Guernesey </option>
<option value="Guinee">Guinee </option>
<option value="Guinee_Bissau">Guinee_Bissau </option>
<option value="Guinee equatoriale">Guinee_Equatoriale </option>
<option value="Guyana">Guyana </option>
<option value="Guyane_Francaise ">Guyane_Francaise </option>
<option value="Kenya">Kenya </option>
<option value="Lesotho">Lesotho </option>
<option value="Liban">Liban </option>
<option value="Liberia">Liberia </option>
<option value="Luxembourg">Luxembourg </option>
<option value="Lybie">Lybie </option>
<option value="Madagascar">Madagascar </option>
<option value="Malawi">Malawi </option>
<option value="Mali">Mali </option>
<option value="Man">Man </option>
<option value="Mariannes du Nord">Mariannes du Nord </option>
<option value="Maroc">Maroc </option>
<option value="Mauritanie">Mauritanie </option>
<option value="Monaco">Monaco </option>
<option value="Mozambique">Mozambique </option>
<option value="Namibie">Namibie </option>
<option value="Niger">Niger </option>
<option value="Nigeria">Nigeria </option>
<option value="Rwanda">Rwanda </option>
<option value="Sahara Occidental">Sahara Occidental </option>
<option value="Senegal">Senegal </option>
<option value="Somalie">Somalie </option>
<option value="Suisse">Suisse </option>
<option value="Tanzanie">Tanzanie </option>
<option value="Togo">Togo </option>
<option value="Tunisie">Tunisie </option>
<option value="Zambie">Zambie </option>
<option value="Zimbabwe">Zimbabwe </option>
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
      </div>
    </div>

  </div>

  <button class="btn btn-primary" type="submit" name="inscrire">Inscrire</button>
</form>

        

             ';  
      
     
      
 }  

 if(isset($_POST["rvd_id"]))  
 {  
 
echo' <form action="server.php" method="POST" class="needs-validation" novalidate onSubmit = "return checkPassword(this)">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Nom</label>
      <input type="text" class="form-control" name="nom" value=""  onkeyup="myFunction()" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Prénom</label>
      <input type="text" class="form-control" name="prenom" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Téléphone </label>
      <input type="text" class="form-control" name="telephone" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Email</label>
      <input type="text" class="form-control" name="email" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Mot de passe </label>
      <input type="password" class="form-control" name="pass" id="pass"  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Rrépéter mot de passe</label>
      <input type="password" class="form-control" name="rpass" id="rpass"  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02"> Address </label>
      <input type="text" class="form-control" name="address">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Address 2</label>
      <input type="text" class="form-control" name="addressdeux">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    
   <div class="col-md-6 mb-3">
      <label for="validationCustom03">Ville</label>
      <input type="text" class="form-control" name="ville">
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
<div class="col-md-6 mb-3">
      <label for="validationCustom03">Region</label>
      <input type="text" class="form-control" name="region">
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label >Code Postal</label>
      <input type="text" name ="codepost" class="form-control" id="validationCustom05">
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label name="pays">Pays</label>
      <select name="pays" class="custom-select" id="validationCustom04" required>

<option value="France" selected="selected">France </option>
<option value="Afrique_Centrale">Afrique_Centrale </option>
<option value="Afrique_du_sud">Afrique_du_Sud </option>
<option value="Algerie">Algerie </option>
<option value="Angola">Angola </option>
<option value="Belgique">Belgique </option>
<option value="Botswana">Botswana </option>
<option value="Burkina_Faso">Burkina_Faso </option>
<option value="Burundi">Burundi </option>
<option value="Cameroun">Cameroun </option>
<option value="Canada">Canada </option>
<option value="Comores">Colombie </option>
<option value="Congo">Congo </option>
<option value="Congo_democratique">Congo_democratique </option>
<option value="Djibouti">Djibouti </option>
<option value="France">France </option>
<option value="Gabon">Gabon </option>
<option value="Gambie">Gambie </option>
<option value="Ghana">Ghana </option>
<option value="Gibraltar">Gibraltar </option>
<option value="Guernesey">Guernesey </option>
<option value="Guinee">Guinee </option>
<option value="Guinee_Bissau">Guinee_Bissau </option>
<option value="Guinee equatoriale">Guinee_Equatoriale </option>
<option value="Guyana">Guyana </option>
<option value="Guyane_Francaise ">Guyane_Francaise </option>
<option value="Kenya">Kenya </option>
<option value="Lesotho">Lesotho </option>
<option value="Liban">Liban </option>
<option value="Liberia">Liberia </option>
<option value="Luxembourg">Luxembourg </option>
<option value="Lybie">Lybie </option>
<option value="Madagascar">Madagascar </option>
<option value="Malawi">Malawi </option>
<option value="Mali">Mali </option>
<option value="Man">Man </option>
<option value="Mariannes du Nord">Mariannes du Nord </option>
<option value="Maroc">Maroc </option>
<option value="Mauritanie">Mauritanie </option>
<option value="Monaco">Monaco </option>
<option value="Mozambique">Mozambique </option>
<option value="Namibie">Namibie </option>
<option value="Niger">Niger </option>
<option value="Nigeria">Nigeria </option>
<option value="Rwanda">Rwanda </option>
<option value="Sahara Occidental">Sahara Occidental </option>
<option value="Senegal">Senegal </option>
<option value="Somalie">Somalie </option>
<option value="Suisse">Suisse </option>
<option value="Tanzanie">Tanzanie </option>
<option value="Togo">Togo </option>
<option value="Tunisie">Tunisie </option>
<option value="Zambie">Zambie </option>
<option value="Zimbabwe">Zimbabwe </option>
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
      </div>
    </div>

  </div>

  <button class="btn btn-primary" type="submit" name="inscrirepatient">Inscrire</button>
</form>

        

             ';  
     
      
 }  
////////////////////ajouterunregg()  but-table gestionn prendre sup

  ?>

  <script>
function a(){

    swal("Good job!", "You clicked the button!", "success");  

}

  </script>
   </body>
 </html>
