<?php

include "dbconnect.php";

session_start();
if ($_SESSION["loggedin"]!=true&&isset($_SESSION['username'])){
    header("location:index.php?logtrue=false");
}
else {
    include "afterloginnav.php";
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

    <title>Welcome</title>
</head>

<body>

    <?php
  include "dbconnect.php"
  ?>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/1.jpg" class="d-block w-100" width="2600" height="410" style="height: 548px;">
            </div>
            <div class="carousel-item">
                <img src="assets/2.png" class="d-block w-100" width="2600" height="548" style="height: 548px;">
            </div>
            <div class="carousel-item">
                <img src="assets/3.jpg" class="d-block w-100" width="2600" height="548" style="height: 548px;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="container my-4">
        <h1><u>Browse Categories</u></h1>
        <div class="row">
            <?php
          $sql="SELECT * FROM `categories`";
          $result=mysqli_query($conn,$sql);

          while ($row=mysqli_fetch_assoc($result)) {
          $id=$row['category_id'];      
         $cat=$row['category_name'];   
         echo '
         <div class="col-md-4 my-2">

             <!-- use of for loop -->
             <div class="card" style="width: 18rem;">
                 <img src="https://source.unsplash.com/500x300/?code,'.$cat.'" class="card-img-top" alt="...">
                 <div class="card-body">
                     <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$row['category_name'].'</a></h5>
                     <p class="card-text">'.substr($row['category_description'],0,30).'..</p>
                     <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">view threads</a>
                   
                 </div>
             </div>
         </div>';
          };
          ?>

        </div>
    </div>
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