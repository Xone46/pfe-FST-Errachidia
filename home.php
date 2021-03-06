
<?php
include("connect.php");
session_start();

if(isset($_SESSION['id_user'])){
     $v = $_SESSION['id_user'];
     $sqluser = "SELECT * FROM `user` WHERE id_user='$v'";
     $resultuser = mysqli_query($conn,$sqluser);
     $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);

     if($rowuser['type_user'] == 'docteur')
     {
      header('Location:docteur.php');
     }

     if($rowuser['type_user'] == 'patient')
     {
      header('Location:patient.php');
     }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Page d'accueil</title>
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
    .owl-dots{
      display:none;
    }
.btn-danger {
    color: #fff;
    background-color: #3ea8da;
    border-color: #2dbffc;
}
.uk-input{
      width:255px;
      margin-top: 10px;
    }
.search-sec{
    padding: 2rem;
}
.search-slt{
    display: block;
    width: 100%;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #55595c;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
.wrn-btn{
    width: 100%;
    font-size: 16px;
    font-weight: 400;
    text-transform: capitalize;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
@media (min-width: 992px){
    #form-reach{
        
        
        background: rgba(26, 70, 104, 0.51);
    }
}

@media (max-width: 992px){
    #form-reach{
        background: #1A4668;
    }
}
.modal-body-cn{
  margin-left: 92px;
}
.overlay-image {
 position: relative;
 width: 100%;
}
/* Image originale */
.overlay-image .image {
 display: block;
 width: 100%;
 height: auto;
}
/* Texte original */
.overlay-image .text {
 color: #000;
 font-size: 49px;
 line-height: 1.5em;
 text-shadow: 2px 2px 2px #fdfdfd;
 text-align: center;
 position: absolute;
 top: 9%;
 left: 50%;
 transform: translate(-50%, -50%);
 width: 100%;
}
#form-reach {
 color: #000;
 font-size: 20px;
 line-height: 1.5em;
 text-shadow: 2px 2px 2px #fdfdfd;
 text-align: center;
 left: 60%;
 transform: translate(-50%, -50%);
 width: 100%;
}


  </style>
</head>

<body>



<nav id="nav-gra" class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
         <a href="home.php">
         <h4 style="color: #1ba12d;">DocSoins</h4>
         </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="rvd" >Rendez Vous</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="consultation.php?home=home">Consultation M??dicale</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="evd"> ??tes-Vous Docteur</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="connexion">Connexion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="connexion" href="contact.php">Contactez-nous</a>
      </li>      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Reherche</button>
    </form>
  </div>
</nav>

<div class="overlay-image _b0" id="overlay-image _b0">
 <img class=" image _b1 " src="photo/picture.jpg" alt="Alt text" width="100%" />
 <div class=" text _2 ">
  Simple, Rapide et Efficace.
</div>
</div>

<br>

<div class="form-reach" id="form-reache" style="margin-top: 30px; display:block;">
    <div class="container">
        <form action="server.php" method="POST" novalidate="novalidate" id="myForm">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" placeholder="Quel m??decin ?" onkeyup="rechercheNom(this.value)" name="nom">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" placeholder="Quelle ville ?" onkeyup="rechercheVille(this.value)" name="ville">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
<select class="form-control search-slt" id="exampleFormControlSelect1" name="specialite" onchange="showCustomer(this.value)">
<option value="toutes-specialites">Toutes sp??cialit??s...</option>
  <option value="medecins-generalistes">M??decine G??n??rale</option>
  <option value="gynecologie-obstetrique">Gyn??cologie-obst??trique</option>
  <option value="pediatrie">P??diatrie</option>
  <option value="ophtalmologie">Ophtalmologie</option>
  <option value="cardiologie">Cardiologie</option>
  <option value="chirurgie">Chirurgie</option>
  <option value="dermatologie-et-venereologie">Dermatologie Et V??n??r??ologie</option>
  <option value="gastro-enterologie-et-hepatologie">Gastro-ent??rologie Et H??patologie</option>
  <option value="oto-rhino-laryngologie">Oto-rhino-laryngologie</option>
  <option value="chirurgie-orthopedique-et-traumatologique">Chirurgie Orthop??dique Et Traumatologique</option>
  <option value="diabetologie-endocrinologie-nutrition">Diab??tologie-endocrinologie-nutrition</option>
  <option value="pneumologie">Pneumologie</option>
  <option value="radiologie">Radiologie</option>
  <option value="urologie">Urologie</option>
  <option value="rhumatologie">Rhumatologie</option>
  <option value="psychiatrie">Psychiatrie</option>
  <option value="nephrologie">N??phrologie</option>
  <option value="anesthesiologie-reanimation-chirurgicale">Anesth??siologie-r??animation Chirurgicale</option>
  <option value="neurochirurgie">Neurochirurgie</option>
  <option value="anatomie-et-cytologie-pathologiques">Anatomie Et Cytologie Pathologiques</option>
  <option value="neurologie">Neurologie</option>
  <option value="chirurgie-plastique-reconstructrice-et-esthetique">Chirurgie Plastique, Reconstructrice Et Esth??tique</option>
  <option value="biologie-medicale-et-physiologie">Biologie M??dicale Et Physiologie</option>
  <option value="neuropsychiatrie">Neuropsychiatrie</option>
  <option value="oncologie">Oncologie</option>
  <option value="allergologie">Allergologie</option>
  <option value="chirurgie-infantile">Chirurgie Infantile</option>
  <option value="medecins-salaries">M??decins Salari??s</option>
  <option value="hematologie">H??matologie</option>
  <option value="chirurgie-maxillo-faciale-et-stomatologie">Chirurgie Maxillo-faciale Et Stomatologie</option>
  <option value="angiologie">Angiologie</option>
  <option value="medecine-du-sport">M??decine Du Sport</option>
  <option value="osteopathie">Ost??opathie</option>
  <option value="ambulances-et-assistance-sanitaire">Ambulances Et Assistance Sanitaire</option>
  <option value="dentiste">Chirurgien-Dentiste</option>
  <option value="stomatologie">Stomatologie</option>
  <option value="geriatrie">G??riatrie</option>
  <option value="chirurgie-urologique">Chirurgie Urologique</option><option value="pedodontie">P??dodontie</option>
  <option value="medecine-d-urgence">M??decine D'urgence</option>
  <option value="hemodialyse-centres-d">H??modialyse (centres D')</option>
  <option value="pedopsychiatrie">P??dopsychiatrie</option>
  <option value="medecins-generalistes-medecine-du-travail">M??decine Du Travail</option>
  <option value="pediatres">P??diatres</option>
  <option value="medical-appareils-et-instruments">M??dical (appareils Et Instruments)</option>
  <option value="syndicats-et-ordres-professionnels">Syndicats Et Ordres Professionnels</option>
  <option value="kinesitherapeutes">Kin??sith??rapeutes</option>
  <option value="ambulances-et-assistance-sanitaire-transports-sanitaires-internationaux">Ambulances Transports Sanitaires Internationaux</option>
  <option value="pathologie-du-sommeil">Pathologie Du Sommeil</option>
  <option value="cliniques-chirurgicales">Cliniques Chirurgicales</option>
  <option value="angiologie-chirurgie">Angiologie Chirurgie</option>
  <option value="audition-appareils-audioprothesistes-et-surdite">Audition (appareils) Audioproth??sistes Et Surdit??</option>
  <option value="laboratoires-d-analyses-biologiques-ou-medicales-gynecologie-obstetrique">Laboratoires D'analyses Biologiques Ou M??dicales Gyn??cologie-obst??trique</option>
  <option value="ophtalmologie-cliniques-et-centres-d-ophtalmologie">Ophtalmologie Cliniques Et Centres D'ophtalmologie</option>
  <option value="chirurgie-digestive">Chirurgie Digestive</option>
  <option value="pharmacies">Pharmacies</option>
  <option value="infirmiers">Infirmiers</option>
  <option value="medecins-generalistes-medecine-interne">M??decine Interne</option>
  <option value="cliniques-et-centres-de-radiologie">Cliniques Et Centres De Radiologie</option>
  <option value="pediatre-homeopathe">P??diatre Hom??opathe</option>
  <option value="chirurgie-vasculaire">Chirurgie Vasculaire</option>
  <option value="cliniques-dentaires">Cliniques Dentaires</option>
  <option value="ambulance-et-assistance-sanitaire">Ambulances Et Assistance Sanitaire</option>
  <option value="esthetique">Esth??tique</option>
  <option value="psychologues-psychanalystes">Psychologues - Psychanalystes</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <button type="button" class="btn btn-success wrn-btn" id="rech">Rechercher</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="container">
  <div class="row row-cols-3" id="livesearch" style="margin-top:30px;">

  </div>
</div>






<br><br>





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
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>  
                </div>  

           </div>  
      </div>  
 </div>

  <div id="dataModalevd" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <!-- header  -->
                <div class="modal-header"> 
                     <span> ??tes-Vous Docteur</span>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                      
                </div>  
<!--             body 
 -->            <div class="modal-body" id="employee_detailevd">  
                </div> 
<!-- footer
 -->                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>  
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
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>  
                   </div>  

           </div>  
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
              <h2 class="mb-4">Nous sommes la meilleure site de rendez-vous et t??l?? conseill?? m??dical </h2>
            </div>

            <div class="services-2 w-100 d-flex">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-accountant"></span></div>
              <div class="text pl-4">
                <h4>Cr??er un nouveau compte</h4>
                <p>La premi??re chose est de cr??er un nouveau compte ou de connecter l'utilisateur .</p>
              </div>
            </div>
            <div class="services-2 w-100 d-flex">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-teamwork"></span></div>
              <div class="text pl-4">
                <h4>Trouvez le bon m??decin</h4>
                <p>Recherche du bon m??decin dans la liste par ville, nom ou sp??cialit?? .</p>
              </div>
            </div>
            <div class="services-2 w-100 d-flex">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-accounting"></span></div>
              <div class="text pl-4">
                <h4>Demander un rendez-vous m??dical</h4>
                <p>Demander un rendez-vous m??dical au m??decin et le confirmer en saisissant les informations correctes et en attendant la r??ponse et l'acceptation du m??decin .</p>
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
                <span>Consultation m??dicale</span>
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
            <h2>D??veloppeurs</h2>
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
                        <span class="position">D??veloppeur et concepteur Web</span>
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
                        <span class="position">D??veloppeur Web</span>
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
                <h2 class="footer-heading">?? propos de nous</h2>
                <p>Rendez-vous m??dical par Internet.</p>
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
                          <li><a href="#" class="py-1 d-block">Analyse de march??</a></li>
                          <li><a href="#" class="py-1 d-block">Conseiller comptabler</a></li>
                          <li><a href="#" class="py-1 d-block">Conseil g??n??ral</a></li>
                          <li><a href="#" class="py-1 d-block">??valuation structur??et</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 mb-md-0 mb-4">
                        <h2 class="footer-heading">D??couvrir</h2>
                        <ul class="list-unstyled">
                          <li><a href="#" class="py-1 d-block">?? propos de nous</a></li>
                          <li><a href="#" class="py-1 d-block">Contract </a></li>
                          <li><a href="#" class="py-1 d-block">Termes et Conditions</a></li>
                          <li><a href="#" class="py-1 d-block">Strat??gies</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 mb-md-0 mb-4">
                        <h2 class="footer-heading">Resources</h2>
                        <ul class="list-unstyled">
                          <li><a href="#" class="py-1 d-block">S??curit??</a></li>
                          <li><a href="#" class="py-1 d-block">Global</a></li>
                          <li><a href="#" class="py-1 d-block">Graphiques</a></li>
                          <li><a href="#" class="py-1 d-block">Intimit??</a></li>
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
             Droits d'auteur &copy;<script>document.write(new Date().getFullYear());</script> Tous droits r??serv??s | Ce mod??le est fait par <a href="" target="_blank">pfe FST Errachidia 2020 </a>
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
    /////// function responsable a l connexion  de l use ////////
 $(document).ready(function(){  
      $('#connexion').click(function(){  
           var connexion_id = $(this).attr("id");  
           $.ajax({  
                url:"server.php",  
                method:"post",  
                data:{connexion_id:connexion_id},  
                success:function(data){  
                     $('#employee_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      }); 
 });  
 /// function use about admission ////
  $(document).ready(function(){  
      $('#evd').click(function(){  
           var evd_id = $(this).attr("id");  
           $.ajax({  
                url:"server.php",  
                method:"post",  
                data:{evd_id:evd_id},  
                success:function(data){  
                     $('#employee_detailevd').html(data);  
                     $('#dataModalevd').modal("show");  
                }  
           });  
      });  
 }); 
  //// function use pour prendre RDV
    $(document).ready(function(){  
      $('#rvd').click(function(){  
           var rvd_id = $(this).attr("id");  
           $.ajax({  
                url:"server.php",  
                method:"post",  
                data:{rvd_id:rvd_id},  
                success:function(data){  
                     $('#employee_detailrvd').html(data);  
                     $('#dataModalrvd').modal("show");  
                }  
           });  
      });  
 }); 





    function rechercheNom(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("overlay-image _b0").style.display='none';
    }
  }
  xmlhttp.open("GET","server.php?q="+str,true);
  xmlhttp.send();
}

    function rechercheVille(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("overlay-image _b0").style.display='none';
    }
  }
  xmlhttp.open("GET","server.php?v="+str,true);
  xmlhttp.send();
}

$("#rech").click( function() {
 $.post( $("#myForm").attr("action"), 
         $("#myForm :input").serializeArray(), 
         function(info){ $("#livesearch").html(info); 
  });
});

function showCustomer(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("livesearch").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("livesearch").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "server.php?s="+str, true);
  xhttp.send();
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