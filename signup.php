
<?php 
    $showAlert=false;
    $showError=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include 'partials/_dbconnect.php';
    $username=$_POST["username"];
    $password= $_POST["password"];
    $cpassword= $_POST["cpassword"];
    if($password==""){
      echo "Password need to set blank password is not allowed";
      $exists=true; // Here users setting password blank so I am doing this otherwise I needed to make another variable and so many ways. 
      sleep(5);
      header("location: signup.php");
    }
    $exists= false;
    $sql1 = "SELECT `username` FROM `users` WHERE `username`='$username'";
    $result1 = mysqli_query($conn, $sql1);
    
    if(mysqli_num_rows($result1) > 0) {
        echo "Username already exists";
        $exists = true;
    }

    if(($password==$cpassword) && $exists==false){
      $hash=password_hash($password, PASSWORD_DEFAULT); //Need to set lenght of 255 in database recomended
      $sql= "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp());";
      $result=mysqli_query($conn, $sql);
      if($result){
          $showAlert=true;
      }
    }

    else{
        $showError="Password do not match";
    }


}


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body>
    <?php require'partials/_nav.php' ?> 
    <?php
    if($showAlert){
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!!</strong> Your account is created and you can log in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
    if($showError){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!!</strong> '.$showError.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>
    <div class="container">
        <h1 class="text-center">SignUp to our website</h1>
        <form action= "/loginsystem/signup.php" method="post">
  <div class="form-group ">
    <label for="username">User Name</label>
    <input type="text" maxlength="20" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group ">
    <label for="password">Password</label>
    <input type="password" maxlength="23" class="form-control" id="password" name="password">
  </div>
  <div class="form-group ">
    <label for="cpassword">Confirm Password</label>
    <input type="password" maxlength="23" class="form-control" id="cpassword" name="cpassword">
    <small id="emailHelp" class="form-text text-muted">Make sure to type same password</small>
  </div>    
  
  <button type="submit" class="btn btn-primary ">SignUp</button>
  <button type="reset" class="btn btn-primary ">Reset</button>
</form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>