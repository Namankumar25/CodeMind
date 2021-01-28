<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Congratulations</title>
    <style>
    .alert{
        background: linear-gradient(to right top, #000000,#551166);
    color: white;
    }
    </style>
</head>

<body style="background-color:black;">
    <div class="container my-4">
        <?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include "dbconnect.php";
    $signupemail=$_POST['signupemail'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

//check whether this email exists 

if($password==$cpassword){
    $hashpassword=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `users` (`S.no`, `user_email`, `user_password`, `user_time`) VALUES (NULL, '$signupemail', '$hashpassword', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo '<div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Please Wait..</h4>
        <p>Thanks for connecting with us enjoy this application and share your knowledge with others</p>
        <hr>
        <p class="mb-0">Now you can login with this Username and password</p>
        <p class="mb-0">Redirecting you Please wait....</p>
      </div>';
      
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Request not processed</h4>
        <p>Already Email is taken try another email</p>
        <hr>
        <p class="mb-0">Account with this user name is already exists</p>
      </div>';
    }
}
else {
    header("location:index.php?pass=no");
}


}

?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script>
    setTimeout(() => {
        window.location = "index.php";
    }, 5000);
    </script>

</body>

</html>