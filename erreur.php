 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Page de Erreur</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
  </script>
  <style type="text/css">
  </style>
</head>

<body>
  <?php

if(isset($_GET["erreur"]) == 'prendre'){
  echo '
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention !</h4>
  <p>
Veuillez enregistrer un nom d utilisateur ou vous assurer que les informations sont correctes. Nous protégeons le site de tout piratage ou interférence illégale
  </p>
  <hr>
  <p class="mb-0">
Veuillez appuyer sur le bouton ci-dessous
</p>
</div>
<a href="home.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Retour a page Accueil</a>
  ';
}
if(isset($_GET["prendre"]) == 'prendre'){
  echo '
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention !</h4>
  <p>
Veuillez vous connecter au compte à l avance afin de pouvoir vous connecter à la page pour prendre un RDV a Medecin. <br>
Mais si vous n avez pas de compte, vous devez créer un compte
  </p>
  <hr>
  <p class="mb-0">
Veuillez appuyer sur le bouton ci-dessous
</p>
</div>
<a href="home.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Retour a page Accueil</a>
  ';
}
if(isset($_GET["consultation"])=='consultation'){
  echo '
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention !</h4>
  <p>
Veuillez vous connecter au compte à l avance afin de pouvoir vous connecter à la page . <br>
Mais si vous n avez pas de compte, vous devez créer un compte
  </p>
  <hr>
  <p class="mb-0">
Veuillez appuyer sur le bouton ci-dessous
</p>
</div>
<center><a href="home.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Retour a page Accueil</a></center>
  ';
}
if(isset($_GET["rdv"])=='rdv'){
  echo '
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention !</h4>
  <p>
Veuillez saisir un numéro de téléphone correcte afin de confirmer votre commande
  </p>
  <hr>
  <p class="mb-0">
Veuillez appuyer sur le bouton ci-dessous
</p>
</div>
<center><a href="home.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Retour a page Accueil</a></center>
  ';
}
if(isset($_GET["login"])=='login'){
  echo '
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention !</h4>
  <p>
Veuillez vous assurer que les informations que vous avez saisies sont correctes et ressaisir le numéro de téléphone et le mot de passe corrects afin de vous connecter à votre compte.<br>
  Je vous remercie <br>
Si vous avez un problème, vous pouvez nous contacter
  </p>
  <hr>
  <p class="mb-0">
Veuillez appuyer sur le bouton ci-dessous
</p>
</div>
<center><a href="home.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Retour a page Accueil</a></center>
  ';
}
  ?>
</body>
 </html>