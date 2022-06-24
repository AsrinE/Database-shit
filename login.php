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
                You can login here.
            </p>
        </div>
        <div class="form">
            <form action="" method="post">
            <div>
                <label for="username">Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input class="box1" type="text" name="username" id="username" size="20" placeholder="Type your username here" required>
            </div>
            <div>
                <label for="password">Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input class="box1" type="password" name="password" id="password" size="20" placeholder="Type your password" required>
            </div>
            <div class='logbut'>
                <input class="buttonindex1" type="Submit" value="Login" name="Submit" id="submit" size="10">
                <a class="buttonindex1" size="10" href='signup.php'>register</a>
            </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php 

session_start(); 

if($_SESSION['loggedin'] == true){
    header('Location:messages.php');
}

include "dbconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['username']) && isset($_POST['password'])) {

        function validate($data){

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

        }

        $username = validate($_POST['username']);

        $password = validate($_POST['password']);

        if (empty($username)) {

            header("Location: login.php?error=User Name is required");

            exit();

        } else if(empty($password)){

            header("Location: login.php?error=Password is required");

            exit();

        } else{

            $sql = "SELECT * FROM users WHERE username='$username'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['username'] === $username && password_verify($password, $row['passwordd'])) {

                    $_SESSION['loggedin'] = true;

                    $_SESSION['ID'] = $row['ID'];

                    $_SESSION['username'] = $row['username'];

                    header("Location: messages.php");

                    exit();

                } else{
                    echo '<div class="wrapper"><div class=form>Your username or password is incorrect</div></div>';
                }
            }
        }
    }
}
?>