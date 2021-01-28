<?php
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">CodeMind</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
  </ul>
  <div class="mx-2">
  <form class="form-inline my-2 my-lg-0">

    <button type="button" class="btn btn-outline-primary mx-2" data-toggle="modal" data-target="#loginmodal">
    Log in
  </button>

    <button type="button" class="btn btn-outline-danger mx-2" data-toggle="modal" data-target="#signupmodal">
    Sign up
      </button>
    </form>
  </div>
</div>
</nav>';

include "login.php";
include "signup.php";

?>