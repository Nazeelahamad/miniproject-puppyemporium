<?php 
session_start();
include('../assets/connection/connection.php'); 
if(isset($_POST['login'])) { 
    $email=$_POST['email']; 
    $password=$_POST['password'];

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email');</script>";
        exit;
    }

    // Password validation
    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters');</script>";
        exit;
    }

    $user="select *from tbl_user where user_email='".$email."' AND user_password= '".$password."'";
    $admin="select *from tbl_admin where admin_email='".$email."' AND admin_password= '".$password."'";
    $owner="select *from tbl_owner where owner_email='".$email."' AND owner_password= '".$password."' and owner_status='1'";
    $resuser=$con->query($user); 
    $resadmin=$con->query($admin); 
    $resowner=$con->query($owner); 
    if($datauser=$resuser->fetch_assoc()) { 
        $_SESSION['uid']=$datauser['user_id']; 
        $_SESSION['uname']=$datauser['user_name']; 
        header('location:../User/HomePage.php'); 
    } else if($dataadmin=$resadmin->fetch_assoc()) { 
        $_SESSION['aid']=$dataadmin['admin_id']; 
        $_SESSION['aname']=$dataadmin['admin_name']; 
        header('location:../admin/HomePage.php'); 
    } else if($dataowner=$resowner->fetch_assoc()) { 
        $_SESSION['oid']=$dataowner['owner_id']; 
        $_SESSION['oname']=$dataowner['owner_name']; 
        header('location:../seller/HomePage.php'); 
    } else { 
        echo "<script>alert('invalid data');</script>"; 
    } 
} 
?> 

<!DOCTYPE html> 
<html lang="en" dir="ltr"> 
<head> 
    <meta charset="utf-8"> 
    <title>Login and Registration Form in HTML </title> 
    <link rel="stylesheet" href="../assets/Templates/Login/style.css"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head> 
<body> 
    <div class="wrapper"> 
        <div class="title-text"> 
            <div class="title login"> User Login Form </div> 
        </div> 
        <div> 
            <div> 
                <input type="radio" name="slide" id="login" checked> 
                <input type="radio" name="slide" id="signup"> 
                <div class="slider-tab"></div> 
            </div> 
            <div class="form-inner"> 
                <form action="" class="login" method="POST"> 
                    <div class="field"> 
                        <input type="email" name="email" id="email" placeholder="Email Address" required> 
                    </div> 
                    <div class="field"> 
                        <input type="password" name="password" id="password" placeholder="Password" required> 
                    </div> 
                    <div class="pass-link"> 
                        <!-- <a href="#">Forgot password?</a> --> 
                    </div> 
                    <div class="field btn"> 
                        <div class="btn-layer"></div> 
                        <input type="submit" name="login" id="login" value="Login"> 
                    </div> 
                    <div class="signup-link"> 
                        Not a member? 
                        <a href="NewUser.php">New User/</a> 
                        <a href="NewSeller.php">New Seller</a> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div> 

    <script> 
        const loginText = document.querySelector(".title-text .login"); 
        const loginForm = document.querySelector("form.login"); 
        const loginBtn = document.querySelector("label.login"); 

        loginBtn.onclick = (()=>{ 
            loginForm.style.marginLeft = "0%"; 
            loginText.style.marginLeft = "0%"; 
        }); 
    </script> 
</body> 
</html>