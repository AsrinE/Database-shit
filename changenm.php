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
                You can change your username here.
            </p>
        </div>
        <div class="form">
            <form action="" method="post">
            <div>
                <label for="username"> New username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input class="box1" type="text" name="username" id="username" size="20" placeholder="Type your new username here" required>
            </div>
            
            <div class='logbut'>
                <input class="buttonindex1" type="Submit" value="confirm new username" name="Submit" id="submit" size="10">
            </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php 

session_start(); 

include "dbconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['username'])) {

        function validate($data){

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

        }

        $username = validate($_POST['username']);

        if (empty($username)) {

            exit();

        } else{

            $sql = "UPDATE users set username = '$username' WHERE ID = '$_SESSION[ID]' ";
            
            $_SESSION['username'] = $_POST['username'];

            $result = mysqli_query($conn, $sql);

            header('location:messages.php');
        }
    }
}
?>