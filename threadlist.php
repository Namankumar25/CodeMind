<?php
    $user_loggedin;
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
  include "dbconnect.php"
  ?>

    <?php
  $id=$_GET['catid'];
  $sql="SELECT * FROM `categories` WHERE category_id=$id";
  $result=mysqli_query($conn,$sql);
  $noresult=true;
  while($row=mysqli_fetch_assoc($result)){
      
        $catname=$row['category_name'];
        $desc=$row['category_description'];
    };
    
    ?>
    
    <!-- form submission  -->

    <?php
    $alert=false;

if($_SERVER['REQUEST_METHOD']=="POST"){
    $alert=true;
    $th_title=$_POST['thtitle'];
    $th_desc=$_POST['desc'];

    $th_desc=str_replace("<","&lt;",$th_desc);
    $th_desc=str_replace(">","&gt;",$th_desc);

    $th_title=str_replace("<","&lt;",$th_title);
    $th_title=str_replace(">","&gt;",$th_title);

    $sql="INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user`, `timestamp`) VALUES (NULL, '$th_title', '$th_desc', '$id', '$user_loggedin', current_timestamp())";
    $result=mysqli_query($conn,$sql);
}

if($alert){
echo '<div class="alert alert-success alert-success fade show" role="alert">
                    <strong></strong>Your Question is added to list please wait for community to answer 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
</div>';
}
?>

    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
    <p class="lead">No Spam / Advertising / Self-promote in the forums. ...
        <br> Do not post copyright-infringing material. ...
        <br> Do not post “offensive” posts, links or images. ...
        <br> Do not cross post questions. ...
        <br> Do not PM users asking for help. ...
        <br> Remain respectful of other members at all times.</p>
    <hr class="my-4">
    <p><strong><?php echo $desc ;?></strong></p>

    </div>
    </div>




    <div class="container">
        <h1>Ask a Question</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Question title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="thtitle">
                <small id="emailHelp" class="form-text text-muted">keep your title short
                </small>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Question</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container my-2">
        <h1 class="py-2">Browse Questions</h1>

        <?php
            $id=$_GET['catid'];
            $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                    $thid=$row['thread_id'];
                    $thques=$row['thread_title'];
                    $thdesc=$row['thread_desc'];
                    $thuser=$row['thread_user'];
                    $thcatid=$row['thread_cat_id'];

                echo'
                    <div class="media py-2">
                        <img src="assets/user.png" class="mr-3" width="60px">
                        <div class="media-body">
                            
                            <a href="thread.php?threadid='.$thid.'&&thcatid='.$thcatid.'">'.$thques.'</a><br>
                            '.$thdesc.'<br>
                            Question by : '.$thuser.'
                        </div>
                    </div>             
               ';

             };
       
          if ($noresult) {
              echo '<div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-4">No Questions</h1>
                <p class="lead">Be the first Person to ask the question</p>
              </div>
            </div>';
          }

            ?>
    </div>



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