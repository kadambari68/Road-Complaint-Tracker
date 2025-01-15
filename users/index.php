<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($bd, "SELECT * FROM users WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="change-password.php";//
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($bd, "insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($bd, "insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$errormsg="Invalid username or password";
$extra="login.php";

}
}



if(isset($_POST['change']))
{
   $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=md5($_POST['password']);
$query=mysqli_query($bd, "SELECT * FROM users WHERE userEmail='$email' and contactNo='$contact'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($bd, "update users set password='$password' WHERE userEmail='$email' and contactNo='$contact' ");
$msg="Password Changed Successfully";

}
else
{
$errormsg="Invalid email id or Contact no";
}
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>User Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<script type="text/javascript">
function valid()
{
 if(document.forgot.password.value!= document.forgot.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.forgot.confirmpassword.focus();
return false;
}
return true;
}
</script>
<style>
        #whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: green;
            border-radius: 50%;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }
        #whatsapp-button img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
    </style>
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
                                                                       CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" name="login" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Email"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		           </form>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="registration.php">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		           <form class="form-login" name="forgot" method="post">
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your details below to reset your password.</p>
<input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br >
<input type="text" name="contact" placeholder="contact No" autocomplete="off" class="form-control" required><br>
 <input type="password" class="form-control" placeholder="New Password" id="password" name="password"  required ><br />
<input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required >

		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		          </form>
		
		      	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>

<!-- WhatsApp Button -->
<a href="https://wa.me/8949176142?text=Hello%2C%20Welcome%20to%20Road%20Complaint%20Tracker!!" target="_blank" id="whatsapp-button">
    <img src="data:image/jpeg;base64,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" alt="WhatsApp">
</a>
</body>
</html>
