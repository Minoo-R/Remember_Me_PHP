<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Log In Page</title>
</head>
<body class="p-3 mb-2 bg-dark text-white">
    <?php

    //Connecting to database
        $host= "localhost";
        $username= "root";
        $password= "";
        $db= "Registration";

        $mySql= new mysqli($host, $username, $password, $db);

        if($mySql->connect_error){
            die("Couldn't connect to mySql".$mySql->connect_error);
        }

        
    ?>
    <div class="p-3 mb-2 bg-dark text-white ">
        <form class="m-5" method="post" action="#">
            <div class="formCenter">
                <label for="username">Username</label> 
                <input type="text" id="username" class="space" name="username" placeholder="Admin" required><br><br>
            </div>
            <div class="formCenter">
                <label for="username">Email</label> 
                <input type="text" id="username" class="space" name="email" placeholder="Admin@login.com" required><br><br>
            </div>
            <div class="formCenter">
                <label for="password">Password </label>
                <input type="password" class="space" name="password" placeholder="Password" required><br><br>
            </div>
            <div class="formCenter">
                <label for="password">Confirm Password </label>
                <input type="password" class="space" name="confPassword" placeholder="Password" required><br><br>
            </div>

            <br><br>
            <div class="buttons">
                <input class="btn btn-success m-auto" type="submit" value="Submit" name="submit">
            </div>
        </form>
    </div>
    <div>
        Already have an account? <a href="http://localhost/Remember_Me/LogInR.php">Log In</a>
    </div>
    <?php
        if(isset($_POST['submit'])){
            $user=$_POST['username'];
            $mail=$_POST['email'];
            $passw=$_POST['password'];
            $confPassw=$_POST['confPassword'];

            //Check if passwords match

            if($passw!==$confPassw){
                echo "Passwords doesn't match!";
            }
            else{
                $sqlCheckUser="SELECT * from users where Username='$user'";
                $sqlCheckMail="SELECT * from users where Email='$mail'";
                $resultCheckUser=$mySql->query($sqlCheckUser);
                $resultCheckMail=$mySql->query($sqlCheckMail);
                //Check if username or email was used before
                if($resultCheckUser->num_rows>0 or $resultCheckMail->num_rows>0){
                    echo "Your Username/Email was used by another person. Pleace insert a new Username/Email";
                }

                //THE CLASS DID THIS(MUCH BETTER AND MORE EFFICIENT)
                // $sqlCheck="SELECT * from users where Username='$user' or Email='$mail'"
                //if($sqlCheck>num_rows>0){
                    //die("Username or Email already exist.")
                //}
                else{
                //New row in database
                    $passw= md5($passw);
                    $sql="INSERT INTO users( Username, Email, Password)
                                VALUES('$user','$mail','$passw')";
                    $result=$mySql->query($sql);
                    $mySql->close();
                    $_SESSION['name']= $user;
                    header('Location: http://localhost/Remember_Me/mainPageR.php');
                }
            }

            
            }
            
    ?>
    

</body>
</html>