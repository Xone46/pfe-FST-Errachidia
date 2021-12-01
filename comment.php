 <?php
 session_start();
include("connect.php");
            $ju = 7;
            $sqlju = "
SELECT *
FROM `commentaires`
WHERE id_post ='$ju'
ORDER BY temp DESC";

            $resultju = mysqli_query($conn, $sqlju);
            if (mysqli_num_rows($resultju) > 0) {
             // output data of each row
            while($rowju = mysqli_fetch_assoc($resultju)) {

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

          <ul class="uk-comment-list" id="uk-comment-list" style="display:block;">  
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