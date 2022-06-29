<?php
    session_start();
     if(isset($_POST['submit'])){
        if(empty($_POST['username'])){
            die("Please enter your name correctly for registration.");
        }
        $name= $_POST['username'];
        $pass=$_POST['password'];
        $_SESSION['name']= $name;
        $_SESSION['pass']= $pass;
        if(!empty($_POST['remember'])){
            setcookie('username',$name,time()+3600,"/");
            setcookie('password',$pass,time()+3600,"/");
        }
        else{
            setcookie('username',"",time()+3600,"/");
            setcookie('password',"",time()+3600,"/");
        }
        
     }
    
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
                <input type="text" id="username" class="space" name="username" placeholder="Username" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} ?>" required><br><br>
            </div>
            <div class="formCenter">
                <label for="password">Password </label>
                <input type="password" class="space" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>" required><br><br>
            </div>

            <div class="formCenter">
            <input type="checkbox" name="remember" value="RememberMe">
            <label for="remember"> Remember Me</label><br>
            </div>

            <br><br>
            <div class="buttons">
                <input class="btn btn-success m-auto" type="submit" value="Submit" name="submit">
            </div>
            
        </form>
    </div>
    <div>
        Not signed up yet? <a href="http://localhost/Remember_Me/SignUpR.php">Register Now</a>
    </div>
    <?php
        if(isset($_POST['submit'])){
            
            $pass=md5($pass);
            $sql="SELECT * from users where Username='$name' AND Password='$pass'";
            $result=$mySql->query($sql);
            if($result->num_rows>0){
                header('location: http://localhost/Remember_Me/mainPageR.php');
            }
            else{
                echo "No result here!";
        }

        $mySql->close();

        }
    ?>
    

</body>
</html>