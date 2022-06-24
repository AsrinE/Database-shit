<?php
    include 'dbconnect.php';
    
    $msgID = $_GET['msgID'];

    echo $msgID;
    
    $sql = 'DELETE FROM messages WHERE msgID = '.$msgID.'';

    $result = $conn->query($sql);

    header("Location: messages.php");
?>