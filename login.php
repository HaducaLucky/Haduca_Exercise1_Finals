<?php
session_start();
include("connection.php");

$msg='';
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select1 = "SELECT * FROM `users` WHERE email = '$email' AND password= '$password'";
    $select_user = mysqli_query($conn,$select1);
    if(mysqli_num_rows($select_user)>0){
        $row1 = mysqli_fetch_assoc($select_user);
        if($row1['user_type'] == 'user'){
            $_SESSION['user']= $row1['email'];
            $_SESSION['id']= $row1['id'];
            header('location:user.php');
        }
        elseif($row1['user_type'] == 'admin'){
            $_SESSION['admin']= $row1['email'];
            $_SESSION['id']= $row1['id'];
            header('location:admin.php');
        }
        else{
            $msg= "Incorrect email and password!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="form">
        <form action="" method="post">
            <h2>Login</h2>
            <p class="msg"></p>
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email" class="form-control" require>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter your password" class="form-control" require>
            </div>
            <button class="btn font-weight-bold" name="submit">Login Now</button>
            <p>Don't have an Account? <a href="register.php">Sign Up Now</a></p>
        </form>
    </div>
</body>
</html>