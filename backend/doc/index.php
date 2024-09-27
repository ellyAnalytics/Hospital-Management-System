
<?php
session_start();
include('assets/inc/config.php');//get configuration file
//get configuration file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $doc_number = $_POST['doc_number'];
    //$doc_email = $_POST['doc_ea']
    $doc_pwd = sha1(md5($_POST['doc_pwd']));//double encrypt to increase security
    $stmt=$mysqli->prepare("SELECT doc_number, doc_pwd, doc_id FROM his_docs WHERE  doc_number=? AND doc_pwd=? ");//sql to log in user
    $stmt->bind_param('ss', $doc_number, $doc_pwd);//bind fetched parameters
    $stmt->execute();//execute bind
    $stmt -> bind_result($doc_number, $doc_pwd ,$doc_id);//bind result
    $rs=$stmt->fetch();
    $_SESSION['doc_id'] = $doc_id;
    $_SESSION['doc_number'] = $doc_number;//Assign session to doc_number id
    //$uip=$_SERVER['REMOTE_ADDR'];
    //$ldate=date('d/m/Y h:i:s', time());
    if($rs)
        {//if its sucessfull
            header("location:his_doc_dashboard.php");
        }

    else
        {
        #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
        header("location:wrongLogin.html");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="html2index.css">
    <title>Meno Safi Clinic Management System</title>
</head>
<body>
<div class="wrapper">
    <nav class = "nav">
        <div class="nav-menu" id = "navMenu">
            <ul>
                <!-- <li> <a href="menoSafi/backend/admin/index.php" class = "link">Back To Administartor</a> </li> -->
                
            </ul>
        </div>
        <div class="nav-button">
            <button class = "btn white-btn" id="loginBtn" onclick="login()"> Sign In</button>
            
        </div>
        <div class="nav-menu-btn">
            <i class ="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
    
    <div class="form-box"> 
    
        
      
<!--log in-->
        <div class="login-container" id = "login">
            <div class="top">
               
                <header>Login</header>
            </div>
            <form action="index.php" method = "post">
                <div class="input-box">
                    <input type="text" name="doc_number" class = "input-field" placeholder="Number">
                    <i class = "bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="doc_pwd" class = "input-field" placeholder="Password">
                    <i class = "bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class = "submit" value="Login">
                </div>
                
                <div class="two-col">
                     <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check">Remember Me</label>
                     </div>
                     <div class="two">
                        <label><a href="#">|Forgot password?</a></label>
                     </div>
                </div>   
                </form> 
        </div>
      
    </div>
</div>

</script>
<script>
    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login(){
         x.style.left = "4px";
         y.style.right = "-520px";
         x.style.opacity = 1;
         y.style.opacity = 0; 
    }
    function register(){
        x.style.left = "-510px";
        y.style.right = "5px";
        x.style.opacity = 0;
        y.style.opacity = 1; 
    }
</script>
</body>
</html>