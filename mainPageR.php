<?php
    session_start();
        if(!isset($_SESSION['name'])){
            die("Plaese register first");
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
    <title>Main Page</title>
</head>
<body class="p-3 mb-2 bg-dark text-white ">
    <div class="p-3 mb-2 bg-dark text-white">
        <h2 class="mainHead">
        <?php
        echo "Welcome to  main page ".$_SESSION['name'];
        ?>
        </h2>
        <?php
            if(isset($_POST['loggOut'])){
                header('location: http://localhost/Remember_Me/logOutR.php');
            };
        ?>
        <br><br>
        <form method="post">
            <input class="btn btn-warning logOutBtn" type="submit" value="logOut" name="loggOut">
        </form>
    </div>
    
</html>