<!DOCTYPE html>

<html>
    
<head>
    <title>AShit | Account management</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="Images/saas-s-a-abstract-letters-260nw-1807739923.ico">
    <meta charset="utf-8"> 
    <meta name="viewport" content=
        "width=device-width, initial-scale=1, 
        shrink-to-fit=no">
</head>

<body>
    
    <?php

    if($showAlert) {
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Your account is 
            now created and you can login. 
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button> 
        </div> '; 
    }
    
    if($showError) {
    
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
            <strong>Error!</strong> '. $showError.'
            <button type="button" class="close" 
                data-dismiss="alert aria-label="Close">
                <span aria-hidden="true">×</span> 
            </button> 
        </div> '; 
   }
           
   if($exists) {
    echo ' <div class="alert alert-danger 
        alert-dismissible fade show" role="alert">

            <strong>Error!</strong> '. $exists.'
            <button type="button" class="close" 
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button>
        </div> '; 
    }
    ?>

    <div class=wrapper>

        <header>
            <div class=title>
                <h1>Account</h1>
            </div>
        </header>
        <div class="checkbox">
            <div class="nav">
                <input type="checkbox">
                <span></span>
                <span></span>
                <div class="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="AShit-About-Me.php">About</a></li>
                    <li><a href="AShit-Works.php">Random</a></li>
                </div>
            </div>
        </div>
        <div class=text>
            <p>
                Here you can register, login and manage your account.
            </p>
        </div>
        <div class="form">
            <form action="" method="post">
            <div>
                <label for="username">Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" name="userName" id="username" size="20" placeholder="Type your username here" required>
            </div>
            <div>
                <label for="email">E-Mail adress: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="email" name="email" id="email" size="20" placeholder="Here your E-Mail" required>
            </div>
            <div>
                <label for="password">Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="password" name="password" id="password" size="20" placeholder="Type your password" required>
            </div>
            <div>
                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpassword" id="cpassword" size="20" placeholder="Confirm your password" required>
            </div>
            <div>
                <input type="submit" value="Submit" name="Submit" id="submit" size="10">
            </div>
            </form>
        </div>
        <div class="emailgif">
            <video height=auto width=60% autoplay loop>
                <source src="Images/NegligiblePaltryCorydorascatfish.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</body>

</html>

<?php
$showAlert = false; 
$showError = false; 
$exists=false;
    
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    include 'dbconnect.php';   
    
    $username = $_POST["username"]; 
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        echo $username;
    }
            
    
    $sql = "Select * from users where username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    $sql = "Select * from users where email='$email'";
    
    $result1 = mysqli_query($conn, $sql);
    
    $num1 = mysqli_num_rows($result1); 

    if($num == 0 && $num1 == 0) {
        if(($password == $cpassword) && $exists==false) {
    
            $hash = password_hash($password, 
                                PASSWORD_DEFAULT);
                
            $sql = "INSERT INTO `users` ( `username`, `email`, 
                `password`, `date`) VALUES ('$username', '$email', 
                '$hash', current_timestamp())";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $showAlert = true; 
            }
        } 
        else { 
            $showError = "Passwords do not match"; 
        }      
    }
    
   if($num>0) 
   {
      $exists="Username not available"; 
   } 
   if($num1>0)
   {
        $exists="Email already used";
   }
    
}
?>