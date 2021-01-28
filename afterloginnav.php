<?php

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand">CodeMind</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="_handlelogin.php">Home <span class="sr-only">(current)</span></a>
          </li>
    </ul>
    <div class="mx-2">
    
        <span class="mx-2" style="color:white;">
            Welcome, '.$_SESSION["username"].'
        </span>
    
        <a href="logout.php" class="btn btn-outline-danger mx-2" >
            Logout
        </a>
    </div>
</div>
</nav>

';

?>