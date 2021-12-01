<?php
include("connect.php");
session_start();
if(!isset($_SESSION['id_user']))
{
  header('Location:home.php');
}
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

<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">

  <style type="text/css">
    .uk-input{
      width:255px;
      margin-top: 10px;
    }
  img {
  position: absolute;
  left: 0px;
  top: 0px;
  z-index: -1;
}
.modal-body-cn{
  margin-left: 92px;
}

  </style>
</head>

<body>

<?php

   $v = $_SESSION['id_user'];
   $sqluser = "SELECT * FROM user WHERE  id_user = '$v' " ;
    $resultuser = mysqli_query($conn,$sqluser);
    if($resultuser){
          $rowuser = mysqli_fetch_array($resultuser,MYSQLI_ASSOC);
            $_SESSION['id_user'] = $rowuser['id_user'];
            $nom = $rowuser['nom'];
            $prenom = $rowuser['prenom'];
              

    }else{
      header("Location:erreur.php?erreur=erreurevd");
    }

?>
<?php

   $v = $_SESSION['id_user'];
   $sqlchoix = " SELECT COUNT( * )  AS count
FROM `demandes`
WHERE `con` =0
AND `to` = '$v'
AND `cas` = 'non'  " ;
    $resultchoix = mysqli_query($conn,$sqlchoix);
    if($resultchoix){
          $rowchoix = mysqli_fetch_array($resultchoix,MYSQLI_ASSOC);
            $count = $rowchoix['count'];

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
        <a class="nav-link" href="consultation.php">Consultation Médicale</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" id="connexion">Bienvenu <?php echo $nom." ".$prenom; ?> </a>
      </li>
       <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Paramètres</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" id ="notification" onclick="notification()">Notifications <span class="badge badge-primary badge-pill"><?php echo " " .$count. " "; ?></span></a>
          <a class="dropdown-item" id="messages" onclick = "messagesdocteur()" value="<?php echo $user; ?>">Messages</a>
          <a class="dropdown-item" onclick="moncompte()">Mon compte</a>
          <a class="dropdown-item" onclick="gestion()">Gestion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
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
    <div class="col-sm">
    <div id='secdoc'>
      
    </div>  
    <section class="ftco-section ftco-no-pt bg-light ftco-faqs" id='instructions'>
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="img-faqs w-100">
              <div class="img mb-4 mb-sm-0" style="background-image:url(images/b.jpg);">
              </div>
              <div class="img img-2 mb-4 mb-sm-0" style="background-image:url(images/e.jpg);">
              </div>
            </div>
          </div>
          <div class="col-lg-6 pl-lg-5">
            <div class="heading-section mb-5 mt-5 mt-lg-0">

              <h2 class="mb-3">Bienvenue sur le site officiel  DOCSOINS </h2>
              <p>
                La médecine est une profession noble honorée par Dieu, une industrie en plus d'être une science à étudier et un art à pratiquer.
              </p>
            </div>
            <div id="accordion" class="myaccordion w-100" aria-multiselectable="true">
              <div class="card">
                <div class="card-header p-0" id="headingOne">
                  <h2 class="mb-0">
                    <button href="#collapseOne" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                      <p class="mb-0">Conseils lors de l'acceptation du patient ?</p>
                      <i class="fa" aria-hidden="true"></i>
                    </button>
                  </h2>
                </div>
                <div class="collapse show" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
                  <div class="card-body py-3 px-0">
                    <ol>
                      <li>Les prix des services de santé fournis par la clinique, il est nécessaire de prendre en compte la situation sociale.</li>
                      <li>Médecins et spécialistes travaillant dans ces cliniques, et les types de spécialités médicales disponibles dans cette clinique.</li>
                      <li>Veuillez bien évaluer les patients, traiter soigneusement leurs demandes et noter tous les points et observations importants.</li>
                      <li>Les capacités disponibles dans les cliniques d'urgence, leur capacité à faire face à des situations critiques et leur capacité à contrôler les cas dans lesquels la santé du patient peut soudainement se détériorer.</li>
                      <li>Les installations disponibles pour les patients, les heures de visite et leur adéquation avec la famille et les amis du patient, en particulier dans les cas qui peuvent nécessiter que le patient reste longtemps à la clinique.</li>
                    </ol>
                  </div>
                </div>
              </div>

             
                <div class="collapse" id="collapseFour" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="card-body py-3 px-0">
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
  </div>
</div>




 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content" style="width: 300px;"> 
           <!-- header  -->
                <div class="modal-header"> 
                     <span>Connexion</span>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                      
                </div>  
<!--             body 
 -->            <div class="modal-body" id="employee_detail">  
                </div> 
<!-- footer
 -->                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  

           </div>  
      </div>  
 </div>

  <div id="dataModalevd" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <!-- header  -->
                <div class="modal-header"> 
                     <span> Êtes-Vous Docteur</span>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                      
                </div>  
<!--             body 
 -->            <div class="modal-body" id="employee_detailevd">  
                </div> 
<!-- footer
 -->                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  

           </div>  
      </div>  
 </div>  

   <div id="dataModalrvd" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <!-- header  -->
                <div class="modal-header"> 
                     <span> Prendre un rendez-vous</span>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                      
                </div>  
<!--             body 
 -->            <div class="modal-body" id="employee_detailrvd">  
                </div> 
<!-- footer
 -->                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  

           </div>  
      </div>  
 </div>   
 </div>
<div class="container" style='margin-top:30px;'>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <ul class="list-group" id="result">

       </ul>
    </div>
    <div class="col-1"></div>
  </div>
</div>

<div class="container" style='margin-top:30px;'>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
       <div id ="voir"></div>
    </div>
    <div class="col-1"></div>
  </div>
</div>




   

   <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
        <div class="row d-flex no-gutters">
          <div class="col-md-6 d-flex">
            <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(images/docteur.jpg);">
            </div>
          </div>
          <div class="col-md-6 pl-md-5 py-md-5">
            <div class="heading-section pl-md-4 pt-md-5">
              <span class="subheading" style="color:#3ea8da;">Bienvenue</span>
              <h2 class="mb-4">Nous sommes la meilleure site de rendez-vous et télé conseillé médical </h2>
            </div>

            <div class="services-2 w-100 d-flex">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-accountant"></span></div>
              <div class="text pl-4">
                <h4>Créer un nouveau compte</h4>
                <p>La première chose est de créer un nouveau compte ou de connecter l'utilisateur .</p>
              </div>
            </div>
            <div class="services-2 w-100 d-flex">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-teamwork"></span></div>
              <div class="text pl-4">
                <h4>Trouvez le bon médecin</h4>
                <p>Recherche du bon médecin dans la liste par ville, nom ou spécialité .</p>
              </div>
            </div>
            <div class="services-2 w-100 d-flex">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-accounting"></span></div>
              <div class="text pl-4">
                <h4>Demander un rendez-vous médical</h4>
                <p>Demander un rendez-vous médical au médecin et le confirmer en saisissant les informations correctes et en attendant la réponse et l'acceptation du médecin .</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>







     <section class="ftco-counter bg-light ftco-no-pt" id="section-counter">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="50">0</strong>
              </div>
              <div class="text">
                <span>Docteur</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="8500">0</strong>
              </div>
              <div class="text">
                <span>Patient</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="20">0</strong>
              </div>
              <div class="text">
                <span>Demande Rendez-vous</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="20">0</strong>
              </div>
              <div class="text">
                <span>Consultation médicale</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


     <section class="ftco-section testimony-section bg-light">
      <div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section heading-section-white text-center ftco-animate">
            <span class="subheading">Qui sommes-nous</span>
            <h2>Développeurs</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
 
              <div class="item">
                <div class="testimony-wrap py-4">
                  <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4">
                      
                    </p>
                    <div class="d-flex align-items-center">
                      <div class="user-img" style="background-image: url(images/oussama.jpg)"></div>
                      <div class="pl-3">
                        <p class="name">OUSSAMA TAALI</p>
                        <span class="position">Développeur et concepteur Web</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                  <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4">
                      
                    </p>
                    <div class="d-flex align-items-center">
                      <div class="user-img" style="background-image: url(images/achraf.jpg)"></div>
                      <div class="pl-3">
                        <p class="name">Achraf Ait Lhaj Lahcen</p>
                        <span class="position">Développeur Web</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="testimony-wrap py-4">
                  <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4"></p>
                    <div class="d-flex align-items-center">
                      <div class="user-img" style="background-image: url(images/person_22.jpg)"></div>
                      <div class="pl-3">
                        <p class="name">AIT ALI ABD ELLAH</p>
                        <span class="position">Responsable support et coordinateur de projet</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>







    <footer class="footer">
      <div class="container-fluid px-lg-5">
        <div class="row">
          <div class="col-md-9 py-5">
            <div class="row">
              <div class="col-md-4 mb-md-0 mb-4">
                <h2 class="footer-heading">À propos de nous</h2>
                <p>Rendez-vous médical par Internet.</p>
                <ul class="ftco-footer-social p-0">
                  <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa fa-twitter"></span></a></li>
                  <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="fa fa-facebook"></span></a></li>
                  <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="fa fa-instagram"></span></a></li>
                </ul>
              </div>
              <div class="col-md-8">
                <div class="row justify-content-center">
                  <div class="col-md-12 col-lg-10">
                    <div class="row">
                      <div class="col-md-4 mb-md-0 mb-4">
                        <h2 class="footer-heading">Services</h2>
                        <ul class="list-unstyled">
                          <li><a href="#" class="py-1 d-block">Analyse de marché</a></li>
                          <li><a href="#" class="py-1 d-block">Conseiller comptabler</a></li>
                          <li><a href="#" class="py-1 d-block">Conseil général</a></li>
                          <li><a href="#" class="py-1 d-block">Évaluation structuréet</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 mb-md-0 mb-4">
                        <h2 class="footer-heading">Découvrir</h2>
                        <ul class="list-unstyled">
                          <li><a href="#" class="py-1 d-block">À propos de nous</a></li>
                          <li><a href="#" class="py-1 d-block">Contract </a></li>
                          <li><a href="#" class="py-1 d-block">Termes et Conditions</a></li>
                          <li><a href="#" class="py-1 d-block">Stratégies</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 mb-md-0 mb-4">
                        <h2 class="footer-heading">Resources</h2>
                        <ul class="list-unstyled">
                          <li><a href="#" class="py-1 d-block">Sécurité</a></li>
                          <li><a href="#" class="py-1 d-block">Global</a></li>
                          <li><a href="#" class="py-1 d-block">Graphiques</a></li>
                          <li><a href="#" class="py-1 d-block">Intimité</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-md-5">
              <div class="col-md-12">
                <p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
             Droits d'auteur &copy;<script>document.write(new Date().getFullYear());</script> Tous droits réservés | Ce modèle est fait par <a href="" target="_blank">pfe FST Errachidia 2020 </a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
              </div>
            </div>
          </div>
          <div class="col-md-3 py-md-5 py-4 aside-stretch-right pl-lg-5">
            <h2 class="footer-heading">Gratuit consultation</h2>
            <form action="#" class="form-consultation">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Nom">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Objet">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="form-control submit px-3">Envoyer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </footer> 



  <script>  

    ////////////////////////////////////////////

////////////////////////////////////////////////////////
   function accepter(str){
alert('Vous avez accepté la demande, veuillez contacter le patient dans les plus brefs délais, soit par téléphone soit par email');

  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
window.location.replace("docteur.php");

    }
  }
  xmlhttp.open("GET","server.php?accepter="+str,true);
  xmlhttp.send();
}
///////////////////////////////////////////////
   function refusse(str){
alert('Vous avez Refusse la demande');

  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
window.location.replace("docteur.php");

    }
  }
  xmlhttp.open("GET","server.php?refusse="+str,true);
  xmlhttp.send();
}
///////////////////////////////////////////////////
function notification(){
  var str = <?php echo $v; ?>;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

      document.getElementById("result").innerHTML=this.responseText;
      document.getElementById("instructions").style.display='none';  
      document.getElementById("mespatient").style.display='none';
      document.getElementById("reglement").style.display='none';
      document.getElementById("rendezvouspatient").style.display='none';
      document.getElementById("ajouterunregg").style.display='none';

    }
  }
  xmlhttp.open("POST","server.php?notification="+str,true);
  xmlhttp.send();
}

function moncompte(){
  <?php
$v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?> 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {


      document.getElementById("result").innerHTML=this.responseText;
      table();
      secdoc();

      document.getElementById("instructions").style.display='none';

      document.getElementById("ajouterunregg").style.display='none';
      document.getElementById("discuter").style.display = 'none';
      document.getElementById("discuterf").style.display = 'none';
      secdoc();


    }
  }
  xmlhttp.open("POST","server.php?moncompte="+str,true);
  xmlhttp.send();

}


function gestion(){

  <?php
$v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?> 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {
           
            
            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';
            document.getElementById("moddocteur").style.display = 'none';
            document.getElementById("me").style.display ='none';
            
    }
  }
  xmlhttp.open("POST","server.php?gestionn="+str,true);
  xmlhttp.send();

}


function mespatient(){
  <?php
$v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?> 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';

            
            
           

    }
  }
  xmlhttp.open("POST","server.php?mespatient="+str,true);
  xmlhttp.send();

}


function dsm(e){

  var str = e;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';
            
            
           

    }
  }
  xmlhttp.open("POST","server.php?dsm="+str,true);
  xmlhttp.send();

}



function inspecter(e){

  var str = e;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';
            
            
           

    }
  }
  xmlhttp.open("POST","server.php?inspecter="+str,true);
  xmlhttp.send();

}
/////////////////////////////

function rendezvouspatient(){

   <?php
     $v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?> 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';
            
            
           

    }
  }
  xmlhttp.open("POST","server.php?rendezvouspatient="+str,true);
  xmlhttp.send();

}
//////////////////////////////////////////
function ajouterunrdv(){

   <?php
     $v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?> 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';
            
            
           

    }
  }
  xmlhttp.open("POST","server.php?ajouterunrdv="+str,true);
  xmlhttp.send();

}
//////////////////////////////////////////
function ajouterunregg(){

   <?php
     $v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?> 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';
            
            
           

    }
  }
  xmlhttp.open("POST","server.php?ajouterunregg="+str,true);
  xmlhttp.send();

}
/////////////////////////////
function suprdvv(e){

  
  var str = e ; 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
             rendezvouspatient();

            
           

    }
  }
  xmlhttp.open("POST","server.php?suprdv="+str,true);
  xmlhttp.send();

}
/////////////////////////////////////////////////////////
function changea(e){

  
  var str = e ; 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';

            
           

    }
  }
  xmlhttp.open("POST","server.php?changea="+str,true);
  xmlhttp.send();

}
//////////////////////////////
function reglement(){

  <?php
$v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?>  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';

            
           

    }
  }
  xmlhttp.open("POST","server.php?reglement="+str,true);
  xmlhttp.send();

}
///////////////////////////////


/////////////////////////////

function suppatient(e){

  var str = e;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {

            document.getElementById("secdoc").innerHTML=this.responseText;
            document.getElementById("instructions").style.display = 'none';
            
            
           

    }
  }
  xmlhttp.open("POST","server.php?suppatient="+str,true);
  xmlhttp.send();

}

function messagesdocteur(){
  <?php
$v = $_SESSION['id_user'];
  ?>
  var str = <?php echo $v;?> 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {
            document.getElementById("result").innerHTML=this.responseText;
      document.getElementById("instructions").style.display='none';
      document.getElementById("mespatient").style.display='none';
      document.getElementById("reglement").style.display='none';
      document.getElementById("rendezvouspatient").style.display='none';
      document.getElementById("ajouterunregg").style.display='none';
            document.getElementById("result").innerHTML=this.responseText;
                document.getElementById("discuter").style.display = 'none';
                document.getElementById("discuterf").style.display = 'none';
                document.getElementById("instructions").style.display='none';


    }
  }
  xmlhttp.open("POST","server.php?messagesdocteur="+str,true);
  xmlhttp.send();

}
/////////////////// gestionn///////
    function voir(str){
 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("voir").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","server.php?voir="+str,true);
  xmlhttp.send();
}
///////////////////////////////////////
function discuter(str){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {
            document.getElementById("voir").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","server.php?discuter="+str,true);
  xmlhttp.send();

}
////////////////////////////////////
function sin(str){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("voir").innerHTML=this.responseText;
            
    }
  }
  xmlhttp.open("POST","server.php?sin="+str,true);
  xmlhttp.send();

}
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