<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$uid=$_SESSION['id'];
$category=$_POST['category'];
$subcat=$_POST['subcategory'];
$complaintype=$_POST['complaintype'];
$state=$_POST['state'];
$noc=$_POST['noc'];
$complaintdetials=$_POST['complaindetails'];
$compfile=$_FILES["compfile"]["name"];



move_uploaded_file($_FILES["compfile"]["tmp_name"],"complaintdocs/".$_FILES["compfile"]["name"]);
$query=mysqli_query($bd, "insert into tblcomplaints(userId,category,subcategory,complaintType,state,noc,complaintDetails,complaintFile) values('$uid','$category','$subcat','$complaintype','$state','$noc','$complaintdetials','$compfile')");

$sql=mysqli_query($bd, "select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
while($row=mysqli_fetch_array($sql))
{
 $cmpn=$row['complaintNumber'];
}
$complainno=$cmpn;
echo '<script> alert("Your complain has been successfully filled and your complaintno is  "+"'.$complainno.'")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      body{
        background-color:blue;
      }
      </style>
          <style>
        #otpless{ 
            float:left;
            margin-top:10px;    
            margin-left: 80%;
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>User Register Complaint</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script>
function getCat(val) {
  //alert('val');

  $.ajax({
  type: "POST",
  url: "getsubcat.php",
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
    
  }
  });
  }
  </script>
  
  </head>

  <body>

  <section id="container" >
     <?php include("includes/header.php");?>
      <?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Register Complaint</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	

                      <?php if($successmsg)
                      {?>
                      <div class="alert alert-success alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Well done!</b> <?php echo htmlentities($successmsg);?></div>
                      <?php }?>

   <?php if($errormsg)
                      {?>
                      <div class="alert alert-danger alert-dismissable">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Oh snap!</b> </b> <?php echo htmlentities($errormsg);?></div>
                      <?php }?>

                      <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data" >


<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Complaint Type</label>
<div class="col-sm-4">
<select name="complaintype" class="form-control" required="">
                <option value=" Complaint"> Complaint</option>
                  <option value="General Query">General Query</option>
                </select> 
</div>

</div>



<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Complaint Details (max 200 words) </label>
<div class="col-sm-6">
<textarea  name="complaindetails" cols="5" rows="5" class="form-control" maxlength="200"></textarea>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Complaint Related Pic</label>
<div class="col-sm-5">
<input type="file" name="compfile" class="form-control" value="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label"> Location</label>

<a class="btn btn-success" href="http://localhost/complaint-management-system/Complaint%20Management%20System/location/google_maps.php" target="_blank">Capture your location</a>


 </div>




                          <div class="form-group">
                           <div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
</div>

                          </form>
                          </div>
                          </div>
                          </div>
                          
          	
          	
		</section>
      </section>

    <?php include("includes/footer.php");?>
  </section>
  <div id="otpless">
    <script type="text/javascript" src="https://otpless.com/auth.js"></script>
    <!-- Get user's whatsapp number and name -->
    <script type="text/javascript">
      function otpless(otplessUser) {
       var waName = otplessUser.waName;
       var waNumber = otplessUser.waNumber;
       // Signup/signin the user and redirect to next page
      }
    </script>
    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="assets/js/jquery.tagsinput.js"></script>
	
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	
	
	<script src="assets/js/form-component.js"></script>    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
<?php } ?>
