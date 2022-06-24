<?php
include 'dbconnect.php';
?>

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
                You can register here.
            </p>
        </div>
        <div class="form">
            <form action="" method="post">
                
                    <label for="username">Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input class="box1" type="text" name="username" id="username" size="20" placeholder="Type your username here" required>
                    <label style="white-space: pre" for="email">E-Mail: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input class="box1" type="email" name="email" id="email" size="20" placeholder="Here your E-Mail" required>
                
                
                
                    <label style="white-space: pre" for="password">Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input class="box1" type="password" name="password" id="password" size="20" placeholder="Type your password" required>
                    <label style="white-space: pre" for="cpassword">Confirm Password:</label>
                    <input class="box1" type="password" name="cpassword" id="cpassword" size="20" placeholder="Confirm your password" required>
                
                
                <div style="padding: 2vh;">
                    <input class="buttonindex1" type="submit" value="Submit" name="Submit" id="submit" size="10">
                    <a class="buttonindex1"size="10" href='login.php'>login</a>
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

if($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'dbconnect.php';   
        
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"]; 
        $cpassword = $_POST["cpassword"];
        
    if (!isset($_POST['username'], $_POST["email"], $_POST["password"], $_POST["cpassword"])) {  
        echo 'something is not set';
    } else {
            
        $sql = "Select * from users where username='$username'";
            
        $result = mysqli_query($conn, $sql);
            
        $num = mysqli_num_rows($result); 
            
        $sql = "Select * from users where email='$email'";
            
        $result1 = mysqli_query($conn, $sql);
            
        $num1 = mysqli_num_rows($result1); 
        
        if($num == 0 && $num1 == 0) {
            if(($password == $cpassword) && $exists==false) {
            
                $hash = password_hash($password, PASSWORD_DEFAULT);
                        
                $sql = "INSERT INTO users (username, email, 
                        passwordd) VALUES ('$username', '$email', 
                        '$hash');";
                $result = $conn->query($sql);
                header('Location:login.php');
            }
        }
    }
}
?>