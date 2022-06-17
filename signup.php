
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