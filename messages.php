<?php 

session_start();
include 'dbconnect.php';

if (isset($_SESSION['ID']) && $_SESSION['loggedin'] == true) {

 ?>

<!DOCTYPE html>

<html>

<head>
    <title>AShit | Messages</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="Images/saas-s-a-abstract-letters-260nw-1807739923.ico">
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<header>
    <h1 style="font-size: 2vw">Hello, <?php echo $_SESSION['username']; ?> 
    <a class="knopjesmsg" href="logout.php">Logout</a>
    <a class="knopjesmsg" href="index.php">Home</a>
    <a class="knopjesmsg" href="changenm.php">change your username</a></h1>
</header>

<body style="display: flex; flex-direction: column; flex-wrap: wrap;">
    
    <!-- <div class="form2">
        <form action="" method="POST">
            <input class="box2" type="text" name="text" id="text" placeholder="type your message here">
            <input class="buttonindex1" type="Submit" value="submit" name="Submit" id="submit" size="10">
        </form>
    </div> -->





    <?php 

    } else{

        header("Location: login.php");

        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        include 'dbconnect.php';   
            
            $text = $_POST["text"];
            $posterID = $_SESSION['ID']; 
            $date = date('d-m-y h:i:s');

        if (!isset($_POST['text'])) {  
            echo 'something is not set';

        } else {
            $sql = "INSERT INTO messages (msg, post_date, posterID) VALUES ('$text', '$date', '$posterID');";
            $result = $conn->query($sql);
            header('Location:messages.php');
        }
    }
    $sql = "SELECT msgID, msg, posterID, ID, username, post_date FROM messages INNER JOIN users ON messages.posterID = users.ID ORDER BY post_date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){

            if($row["ID"] == $_SESSION['ID']){
                echo '
                <div class="post">
                    <span class="username"> '.$row['username'].'</span>
                    <span class="postdate"> '.$row['post_date'].'</span>
                    <button  class="deletebutton" onclick="document.location=\'/deletemsg.php?msgID='.$row["msgID"].'\'">Delete post</button>
                    <p>'.$row['msg'].'</p>
                </div>';
            } else{
                echo '
                <div class="post">
                    <span class="username"> '.$row['username'].'</span>
                    <span class="postdate"> '.$row['post_date'].'</span>
                    <p>'.$row['msg'].'</p>
                </div>';
                
            }

        }
    }




?>

<footer style="display: flex; flex-direction: column; ">
    <div class="form2">
        <form action="" method="POST">
            <input class="box2" type="text" name="text" id="text" placeholder="type your message here">
            <input class="buttonindex1" type="Submit" value="submit" name="Submit" id="submit" size="10">
        </form>
    </div>
</footer>

</html>