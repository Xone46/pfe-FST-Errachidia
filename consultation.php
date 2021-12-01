<?php
include("connect.php");
session_start();
if(!isset($_SESSION['id_user']))
{

                header('Location:erreur.php?consultation=consultation');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Page de Consultaion</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit-icons.min.js"></script>


<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">



<style type="text/css">
  #uk-card{
    margin-top:30px;
    width:800px;
  }
</style>

</head>
<body>
  <?php

if(isset($_SESSION['id_user']))
{
     $v = $_SESSION['id_user'];
     $sql = " SELECT * FROM `user` WHERE `id_user` = '$v' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $flag = $row['type_user'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    if($flag == "docteur")
    {
      echo "<script>

                      document.getElementById('rvd').style.display='none';

      </script>";
    }
  
}

?>

	
<nav id="nav-gra" class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
         <a href="home.php">
         <h4 style="color: #1ba12d;">DocSoins</h4>
         </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"><?php echo "Bienvenu {$nom} {$prenom} " ; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deconnexion.php">Deconnexion</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Reherche</button>
    </form>
  </div>
</nav>

<br>

<div class="container">
  <div class="row">


    <div class="col-12"><h1 class="display-4">Consultation medicale</h1>
    </div>

  </div>
  <div class="row">
    <div class="col-8"><h5> Posez la question aux medecins et specialistes <span class="badge badge-pill badge-danger">Creer un nouvelle posts</span> </h5>
   </div>
    <div class="col-4">
      <h5><span class="badge badge-pill badge-info"></span></h5>
    </div>


  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-8">

         <form action="server.php" method="POST">
           <div class="form-group">
           </div>
           <div class="form-group">
              <label for="exampleFormControlTextarea1">Objet</label>
             <textarea class="form-control" name="objet" rows="3"></textarea>
           </div>
           <button type="submit" class="btn btn-primary" name='publier'>Publier</button>
         </form>
    </div>

    <div class="col-4">
        <?php

            include("populaire.php");

         ?>
    </div>

  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-8">

           <?php

               include("n.php");


             ?>
    </div>

    <div class="col-4">
    </div>
  </div>
</div>




 





<script>
</script>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>



</body>
</html>