 <?php
     include "dbconnect.php";
      $user_loggedin;
      $user_accepted;
      session_start();
      if ($_SESSION["loggedin"]!=true&&!isset($_SESSION['username'])) {
          header("location:index.php?logtrue=false");
          
      }
      else {
          include "afterloginnav.php";
          $user_loggedin=$_SESSION['username'];
      }
  ?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>category threads</title>
</head>

<body>


    <?php
  $threadid=$_GET['threadid'];
  $sql="SELECT * FROM `threads` WHERE thread_id=$threadid";
  $result=mysqli_query($conn,$sql);
  
  while($row=mysqli_fetch_assoc($result)){

        $threadtitle=$row['thread_title'];
        $threaddesc=$row['thread_desc'];
  };
    

  ?>

    <!-- comment submission -->
    <?php
    $alert=false;

 if($_SERVER['REQUEST_METHOD']=="POST"){
    $alert=true;
    $th_comment=$_POST['comment'];

    $th_comment=str_replace("<","&lt;",$th_comment);
    $th_comment=str_replace(">","&gt;",$th_comment);

    $sql="INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `accepted`, `comment_time`) VALUES ( NULL, '$th_comment', '$threadid', '$user_loggedin', 'pending', current_timestamp());";
    $result=mysqli_query($conn,$sql);
 }

    if($alert){
    echo '<div class="alert alert-success alert-success fade show" role="alert">
                        <strong></strong>You answered this question !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
    </div>';
}
?>


    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $threadtitle; ?></h1>
            <p class="lead"><?php echo $threaddesc; ?></p>
            <hr class="my-4">

            <p>This is a peer to peer community and do not break the rules of forum otherwise your account has been
                <span style="color:red;font-weight:bold;">deleted</span> ! </p>

                <?php
                if (isset($_GET['threadid'])) {
                    $threadid=$_GET['threadid'];
                    $sqlpostedby="SELECT thread_user FROM `threads` WHERE `thread_id`='$threadid'";
                    $resultpostedby=mysqli_query($conn,$sqlpostedby);
                    $rowpostedby=mysqli_fetch_array($resultpostedby);
                    echo '<p><strong>Posted by: '.$rowpostedby['thread_user'].'</strong></p>';
                    $user_accepted=$rowpostedby['thread_user'];
                }
                if (isset($_GET["thcatid"])) {
                    $thread_cat_id=$_GET["thcatid"];
                    echo '    
                    <a href="threadlist.php?catid='.$thread_cat_id.'" class="btn btn-outline-primary" style="float:right;">
                    &#8592;
                    </a>
                    ';
                }
                ?>
            


        </div>
    </div>

    <!-- comment form -->

    <div class="container">
        <h1>Answer this Question</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Write your Answer here..</label>
                <textarea class="form-control" id="desc" name="comment" rows="3"></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Post Answer</button>
        </form>
    </div>



    <!-- fetching comments  -->
    <div class="container my-2">
        <h1 class="py-2">Answers</h1>

        <?php
        $tick;
        $noresult=true;
            $sql="SELECT * FROM `comments` WHERE thread_id=$threadid";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){  
                $noresult=false;       
            
                    $comment_content=$row['comment_content'];
                    $comment_time=$row['comment_time'];
                    $comm_id=$row['comment_id'];
                    $th_id=$row['thread_id'];

                if ($row['accepted']=="yes") {
                    $tick="&#10004;";
                }
                else {
                    $tick="";
                }

                echo'
                <div class="media mt-4">
                    <img src="assets/user.png" class="mr-3"  width="72px">
                    <div class="media-body">
                    <strong>'.$comment_content.'</strong><br>
                    Answer by : '.$row['comment_by'].'<br>
                    '.$row['comment_time'].'
                    '.$tick.'
                    </div>
                </div>
                
               ';
               if ($user_accepted==$user_loggedin) {
                echo '<a href="accept.php?AnswerId='.$comm_id.'&&threadid='.$th_id.'">Accept Answer</a><br>';
               }else {
                   echo '';
               }
             };
                
                
       if ($noresult) {
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No Answers </h1>
          <p class="lead">Be the first Person to Answer this question</p>
        </div>
      </div>';
    } 
          
 ?>



    </div>

    <?php
include "footer.php"
?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>