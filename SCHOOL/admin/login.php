<?php
//error_reporting(0);
session_start();
include("connection.php");
echo $_SESSION["userlogin"];

if (isset($_POST['submit'])){
 $user1 = $_POST['user'];
 $password1 = $_POST['password'];

 $sel = "SELECT * FROM users where username='$user1' and password='$password1'";
$result = mysqli_query($conn, $sel);

if(mysqli_num_rows($result)==1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_nm']="[".$row['username']."] ".$row['email'];
    echo "hello";
    header("Location:admin_index.php?id=1");    
}
    else{
        echo "not correct";
        $reply = "Invalid Credentials !!";
        header("Location: login.php?reply=" .urlencode($reply));
        exit();
    }

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
        #forms{
            border: 1px solid #e7e7e7ff; 
            justify-content: center;
            margin-top: 90px !important;
            background-color: white; 
            border-radius: 20px;
            box-shadow: 0px 4px 6px #b9b9b9ff;
            width: 300px;
            margin: auto;
            height: 180px;
            padding: 30px;
        }
        @keyframes example {
        from {height: 180px;}
        to {height: 350px;}
        }
        .username {
        color: grey !important;
        position: relative;
        width: 270px;
        }
        .password {
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
        #teacher{
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
        #teacher:active{
            color:white;
            background-color: #0048e3ff;
        }
            #teacher:hover{
            color:white;
            background-color: #0048e3ff;
        }
            @keyframes teachk {
            0% {
            transform: translate(0px, 0px);
        }
            50% {
                transform: translate(0px, -60px);
                width: 130px;
        }
            100% {
                width: 305px;
                transform: translate(0px, -60px);
            }
            }
        #usee{
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
#usee:active{
            color:white;
            background-color: #0048e3ff;
        }
            #usee:hover{
            color:white;
            background-color: #0048e3ff;
        }
            @keyframes usek {
            0% {
            transform: translate(0px, 0px);
        }
            50% {
                transform: translate(0px, -60px);
                width: 130px;
        }
            100% {
                width: 305px;
                transform: translate(0px, -60px);
            }
            }
            #formmain{
            opacity: 0;
            }
            @keyframes maink {
            0% {
            opacity: 0;
        }
            50% {
                transform: translate(0px, -50px);
                opacity: 0.5;
        }
            100% {
                opacity: 1;
                transform: translate(0px, -50px);
            }
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
        #Select{
        text-align: center;
        }
        @keyframes selectk {
        0% {
        opacity: 1;
      }
      20% {
        opacity: 0.8;
      }
      40% {
        opacity: 0.6;
      }
      60% {
        opacity: 0.4;
      }
      80% {
        opacity: 0.2;
      }
      100% {
        opacity: 0;
      }
        }
    </style>

    <script>
        function teach(){
            // localStorage.setItem("LoginType","teach");
            teacher.style.animationName = "usek";
            teacher.style.animationDuration = "0.5s";
            teacher.style.animationTimingFunction = "ease-in-out";
            teacher.style.animationFillMode = "forwards";
            alert("!");
            // usee.style.display = "hidden";
            formmain.style.animationName = "maink";
            formmain.style.animationDuration = "0.5s";
            formmain.style.animationTimingFunction = "ease-in-out";
            formmain.style.animationFillMode = "forwards";
            formmain.style.animationDelay = "0.4s";
            Select.style.animationName = "selectk";
            Select.style.animationDuration = "0.5s";
            Select.style.animationTimingFunction = "ease-in-out";
            Select.style.animationFillMode = "forwards";
            forms.style.animationName =  "example";
            forms.style.animationDuration = "0.8s";
            forms.style.animationTimingFunction = "ease-in-out";
            forms.style.animationFillMode = "forwards";
        }
        function anim(){
            // localStorage.setItem("LoginType","admin");
            usee.style.animationName = "usek";
            usee.style.animationDuration = "0.5s";
            usee.style.animationTimingFunction = "ease-in-out";
            usee.style.animationFillMode = "forwards";
           // teacher.style.display = "none";
            alert("!");
            formmain.style.animationName = "maink";
            formmain.style.animationDuration = "0.5s";
            formmain.style.animationTimingFunction = "ease-in-out";
            formmain.style.animationFillMode = "forwards";
            formmain.style.animationDelay = "0.4s";
            Select.style.animationName = "selectk";
            Select.style.animationDuration = "0.5s";
            Select.style.animationTimingFunction = "ease-in-out";
            Select.style.animationFillMode = "forwards";
            forms.style.animationName =  "example";
            forms.style.animationDuration = "0.8s";
            forms.style.animationTimingFunction = "ease-in-out";
            forms.style.animationFillMode = "forwards";
        }

        // window.onload = function(){
        //     let type= localStorage.getItem("LoginType");
        //     if(type==="admin"){
        //         anim();
        //     }else if(type ==="teach"){
        //         teach();
        //     }
        // }

        function fun_call(x)
        {
            alert("fun="+ x);
            if(x=="admin1")
            {
                anim();
            }
            else
            {
                teach();
            }
        }

        
    </script>
</head>
<body>



    <form id="forms" action="#" method="post">
        <i class="fa-solid fa-right-to-bracket" style=
        "margin: auto; display: block; font-size: 35px; color:#0b59ffff"></i>
        <h1>LOGIN</h1>
        <p id="Select">Select Login Type:</p>
        
        
        <div class="at">
        <?php if($_SESSION['userlogin']=="admin1"){ ?>
       
        <button type="button" name="admin1" id="usee" onclick="anim()">Admin</button>
       <?php } else { ?>
       
        <button type="button" name="teacher" id="teacher" onclick="teach()">Teacher</button>
        <?php } ?>  
        
    

    </div>
        <div id="formmain">
            <label for="user">Username:</label><br>
            <div class="username">
            <i class="fa fa-solid fa-user"></i>
            <input type="text" name="user" placeholder="Username"><br>
            </div>
            <div style="margin-top:10px;">
            <label for="password">Password:</label><br>
            </div>
            <div class="password">
            <i class="fa fa-solid fa-key"></i>
            <input type="password" name="password" placeholder="Password" ><br>
            </div>
            <input style="margin-top:10px;" type="checkbox">
            <label style="font-size: 14px;" for="check">Remember me</label>
            <button class="sub" name="submit">Submit</button>
            <p style="text-align: center; color: black; font-size: 14px;"><?php echo $message; ?></p>
        </div>
        
    </form>
    <p style="text-align: center; color: grey; font-size: 14px;">©2025 Panel Login</p>
    <a style="margin-left: 580px; text-decoration: underline;" href="admin_index.php?id=1">Go Back To Homepage</a>
    <script >
     var xx = "<?php  echo $_SESSION["userlogin"]; ?>";
     //alert("xx="+ xx);
        fun_call(xx);
        </script>
</body>
</html>