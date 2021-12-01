<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Page de Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
      <!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit-icons.min.js"></script>
<style type="text/css">
.formbg{
    background-color: red;
}
#formbg{
    background-color: red;
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
         </a>      </li>
      <li class="nav-item">
        <a class="nav-link" id="rvd" >Rendez Vous</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="consultation.php?home=home">Consultation Médicale</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="evd"> Êtes-Vous Docteur</a>
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
                     <span> Êtes-Vous Docteur</span>  
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


    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay" style="opacity: .6; background: #2dbffc"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"> 
          	</p>
            <h1 class="mb-0 bread">Nous sommes là pour vous aider</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper">
							<div class="row no-gutters">
								<div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Formulaire de contact</h3>
										<div id="form-message-warning" class="mb-4"></div> 
					      		<div id="form-message-success" class="mb-4">
					            Votre message a été envoyé, merci!
					      		</div>
										<form method="POST" id="contactForm" name="contactForm" class="contactForm">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="name">Nom et Prénom</label>
														<input type="text" class="form-control" name="name" id="name" placeholder="Nom et Prénom">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="email"> Addresse Email</label>
														<input type="email" class="form-control" name="email" id="email" placeholder="Email">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="subject">Objet</label>
														<input type="text" class="form-control" name="subject" id="subject" placeholder="Objet">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="#">Message</label>
														<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" value="Envoyer" class="btn btn-primary">
														<div class="submitting"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-lg-4 col-md-5 d-flex align-items-stretch" >
									<div class="info-wrap bg-primary w-100 p-md-5 p-4" id='formbg' >
										<h3>Informations de contact</h3>
										<p class="mb-4">Nous sommes ouverts à toute suggestion ou tout simplement pour discuter</p>
					        	<div class="dbox w-100 d-flex align-items-start">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-map-marker"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Addresse:</span> N17, CITE TOUCHKA PRES LA PISCINE MUNICIPALE ERRACHIDIA , 52000 <br> Maroc </p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-phone"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Téléphone:</span> <a href="tel://1234567920">+ 212652420203</a></p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-paper-plane"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@sitepfe.com</a></p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-globe"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Website</span> <a href="#">sitepfe.com</a></p>
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

   	<div id="map" class="map"></div>

    <section class="ftco-section ftco-no-pb ftco-no-pt bg-secondary">
      <div class="container py-5">
    		<div class="row">
          <div class="col-md-7 d-flex align-items-center">
            <h2 class="mb-3 mb-sm-0" style="color:black; font-size: 22px;">Inscrivez-vous à votre première consultation comptable gratuite</h2>
          </div>
          <div class="col-md-5 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="entrer l'adresse E-mail">
                <input type="submit" value="Abonner" class="submit px-3">
              </div>
            </form>
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
						              <li><a href="#" class="py-1 d-block">Contract Nous</a></li>
						              <li><a href="#" class="py-1 d-block">Carrières</a></li>
						              <li><a href="#" class="py-1 d-block">Politique de Confidentialité</a></li>
						              <li><a href="#" class="py-1 d-block">Stratégies</a></li>
						            </ul>
											</div>
											<div class="col-md-4 mb-md-0 mb-4">
												<h2 class="footer-heading">Resources</h2>
												<ul class="list-unstyled">
						              <li><a href="#" class="py-1 d-block">Sécurité</a></li>
						              <li><a href="#" class="py-1 d-block">Global</a></li>
						              <li><a href="#" class="py-1 d-block">Charts</a></li>
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
                <input type="text" class="form-control" placeholder="Nom et Prénom">
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
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
    
  </body>
</html>