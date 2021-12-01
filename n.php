<?php
include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap 4 Example</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/js/uikit-icons.min.js"></script>
<script>

function voir(e) {
  var x = document.getElementById(e+"k");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function comment(e) {
  var x = document.getElementById(e);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}



//// pour Supprieme le commentaire a pres la ajoute / 
  function commentesup(){
  document.getElementById("myP1").innerHTML = "none";
  }

///////////// ajout commentaire /////
function clearInput() {
  $("#myForm :input").each( function() {
     $(this).val('');
  });
}
$("#commenteajoute").click( function() {
 $.post( $("#myForm").attr("action"), 
         $("#myForm :input").serializeArray(), 
         function(info){ $("#result").html(info); 
   });
 clearInput();
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


</script>


<style type="text/css">
  #uk-card{
    margin-top:30px;
    width:800px;
  }
</style>

</head>
<body>


<?php



$v =$_SESSION['id_user'];
$sql = "SELECT * FROM `posts` WHERE posts.id_post NOT IN (SELECT id_post FROM `sup` WHERE sup.id_user ='$v') ORDER BY posts.id_post DESC";
    $result = mysqli_query($conn, $sql);
  // output data of each row
while($row = mysqli_fetch_assoc($result)) {
  /// pour exporte le nom el le prenom /////////
$user = $row['id_user'];
$sqluser = "SELECT * FROM `user` WHERE id_user = '$user'";
$resultuser = mysqli_query($conn, $sqluser);
  // output data of each row
$rowuser = mysqli_fetch_assoc($resultuser);
$nom = $rowuser['nom'];
$prenom = $rowuser['prenom'];
      ?>
<div class="container" >
<div class="row" style="width:1115px; margin-top: 30px;">      
 <div class="ccol-8" id ="demo" style="width:1000px;">      
  <div class="uk-card uk-card-default uk-width-1-2@m" id="uk-card">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
            </div>
            <div class="uk-width-expand">
              <h3 class="uk-card-title uk-margin-remove-bottom"><?php echo $nom ." ". $prenom ; ?></h3>
                <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00"></time><?php echo $row["temp"] ; ?></p>
               <div class="uk-card-body">
                   <p><?php echo $row["post"] ; ?></p>
                </div>
                <input type="hidden" id="eng" value="<?php echo $row['id_post']; ?>" >
                <?php
                if($row['id_user'] == $v){
                 echo "<a href='server.php?sup={$row['id_post']}' uk-icon='icon: trash'><span></span>Supprimer </a>";
                }
                ?>
                <a  href="server.php?eng=<?php echo $row['id_post'];?>" uk-icon="icon: bookmark"><span>Enregistrer</span></a>
                <a  uk-icon="icon:  pencil" class ="commente" onclick="comment(<?php echo $row['id_post'];?>)" ><span>Commenter </span></a>
                <a  uk-icon="icon:  comments" class ="voir" onclick="voir(<?php echo $row['id_post'];?>)" style='margin-left: 50px;'><span> Voir les commentaires  </span></a>



<div id="<?php echo $row['id_post']; ?>" style="display:none;">
<form action="server.php" method="post" style="margin-top:20px;" id="myForm" >
  <div class="input-group">
    <input type="text" class="form-control" id="myP1" placeholder="ecrire commentaire" name="msg">
    <input type='hidden' name ="id_post" value='<?php echo $row['id_post'];?>'>
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
         <a uk-icon="icon:   check" id ="commenteajoute"></a>
         <a uk-icon="icon:   close" id ="commentesup" ></a>
      </button>
    </div>
  </div>
</form>
</div>

   
<?php

            $ju = $row['id_post'];
            $compte = 0;
            $sqlju = "
SELECT *
FROM `commentaires`
WHERE id_post ='$ju'
ORDER BY temp DESC";

            $resultju = mysqli_query($conn, $sqlju);
            if (mysqli_num_rows($resultju) > 0) {
             // output data of each row
            while($rowju = mysqli_fetch_assoc($resultju)) {
              $compte = $compte + 1 ;
              $temp = $rowju['temp'];
              $comment = $rowju['commentaire'];
              $id_comment = $rowju['id_commentaires'];
              $user = $rowju['id_user'];
              $sqluser =" SELECT * FROM `user` WHERE id_user = '$user' ";
              $resultuser = mysqli_query($conn, $sqluser);
              $rowuser = mysqli_fetch_assoc($resultuser);
              $nom = $rowuser['nom'];
              $prenom = $rowuser['prenom'];

              if($rowuser['type_user'] == 'docteur')
              {
                $flag = 'Docteur';
              }else{
                $flag = '';
              }
             
              
        
    $var = '

          <ul class="uk-comment-list" id="'.$row['id_post'].'k'.$compte.'" style="display:none;">  
            <li>
                <article class="uk-comment uk-comment-primary uk-visible-toggle" tabindex="-1">
                    <header class="uk-comment-header uk-position-relative">
                        <div class="uk-grid-medium uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-comment-avatar" src="images/avatar.jpg" width="80" height="80" alt="">
                            </div>
                            <div class="uk-width-expand">
                                <h4 class="uk-comment-title uk-margin-remove">
                            <a class="uk-link-reset" href="#">'.$flag.' '. $nom.' '.$prenom.'</a></h4>
                                <p class="uk-comment-meta uk-margin-remove-top"><a class="uk-link-reset" href="#">'.$temp.'</a></p>
                            </div>
                        </div>
                        <div class="uk-position-top-right uk-position-small uk-hidden-hover"><a class="uk-link-muted" href="#">Reply</a></div>
                    </header>
                    <div class="uk-comment-body">
                        <p>'.$comment.'</p>
                    </div>
                </article>';
                 echo $var;
                 $v = $_SESSION['id_user'];
                if($rowju['id_user'] == $v){
          echo '<a href="server.php?sup-comment='.$id_comment.'"uk-icon="icon: trash" id="sup-comment"><span>Supprimer</span></a>';
              }
           echo ' </li></ul> ';
    

          
                                            }
             }

         ?>
     
 

            </div>

        </div>
    </div>
    <div class="col-4"></div>



     <?php
   }

     ?>

<script>
  var compte = <?php echo $compte; ?> ;
  function voir(e) {

   for(var i = 1 ; i<= compte ; i++) {
  var x = document.getElementById(e+"k"+i);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
}

</script>
</body>
</html>
      
