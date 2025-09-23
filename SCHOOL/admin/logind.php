<?php
error_reporting(0);
session_start();

if(!isset($_SESSION["userlogin"])){
    $_SESSION["userlogin"] = "mt";

}

if (isset($_POST['admin']))
{
    $_SESSION["userlogin"] = "admin1";
    header("Location:login.php");
}

if (isset($_POST['teacher']))
{
    $_SESSION["userlogin"] = "teacher";
    header("Location:login.php");
}
$message = "";
if (isset($_GET['reply'])) {
    $message = $_GET['reply'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body{
            background-color: #f7f7f7ff;
            color: black;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        h1{ 
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: Center;
            font-weight: 600;
        }
        label{
            color: #181818ff;
        }
        form{
            border: 1px solid #e7e7e7ff; 
            justify-content: center;
            margin-top: 90px !important;
            background-color: white; 
            border-radius: 20px;
            box-shadow: 0px 4px 6px #b9b9b9ff;
            width: 300px;
            margin: auto;
            padding: 30px;
            height: 180px;
        }
        .username {
        display: none;
        color: grey !important;
        position: relative;
        width: 270px;
        }
        .password {
        display: none;
        color: grey !important;
        position: relative;
        width: 270px;
        }
        /* input{
            text-align: left;
            margin: 5px;
            background-color: white; 
            border: none;
            border-bottom: 1px solid black !important;
        } */
        .sub{
            display: none;
            margin: auto;
            margin-top: 10px !important;
            background-color: #0b59ffff;
            box-shadow: 0px 2.5px 4px #b9b9b9ff;
            font-weight: 500;
            border-radius: 5px;
            color: white;
            border: none;
            height: 30px;
            width: 305px;
        }
        .sub:hover{
            color:white;
            background-color: #0048e3ff;
        }
        a{
            color: black;
            text-decoration: none;
        }
        .sub:active{
            color:white;
            background-color: #0048e3ff;
        }
        .at{
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 5px;
        }
        .use{
            font-weight: 500;
            margin-top: 5px !important;
            background-color: #0b59ffff;
            box-shadow: 0px 2.5px 4px #b9b9b9ff;
            border-radius: 5px;
            color: white;
            border: none;
            height: 30px;
            width: 130px;
        }
        .use:hover{
            color:white;
            background-color: #0048e3ff;
        }
        .use:active{
            color:white;
            background-color: #0048e3ff;
        }
        .username input {
        border: 1px solid #b8b8b8ff; 
        border-radius: 8px;
        width: 100%;
        padding-left: 30px;
        height: 30px;
        }
        .password input {
        border: 1px solid #b8b8b8ff; 
        border-radius: 8px;
        width: 100%;
        padding-left: 30px;
        height: 30px;
        }
        .username .fa {
        color: grey !important;
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        }
        .password .fa {
        position: absolute;
        color: grey !important;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        }
    </style>
</head>
<body>
    <form action="#" method="post">
        <i class="fa-solid fa-right-to-bracket" style=
        "margin: auto; display: block; font-size: 35px; color:#0b59ffff"></i>
        <h1>LOGIN</h1>
        <p style="text-align:center;">Select Login Type:<p>
        <div class="at">
        <button class="use" name="admin">Admin</button>
        <button class="use" name="teacher">Teacher</button>
        </div>
</body>
</html>