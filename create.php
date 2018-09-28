<?php
    session_start();

    if(!isset($_SESSION['uid']))
            {
                    header("location: index.php");
            }

    $uid = $_SESSION["uid"];
	if(isset($_SESSION['insert_success']))
	{
		if($_SESSION['insert_success']==1)
			$cs = " Contact Successfully Created !";
		else
			$cs = " Contact Already Exists !";
		
		unset($_SESSION['insert_success']);
	}

	else
	{
		$cs="";
	}
?>

<html>
<head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/jquery-1.12.2.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Custom Script -->
	<script rel="stylesheet">
		
	</script>
		<title> Create Contact </title>
</head>	
<body>
    <nav class="navbar navbar-inverse">
		<div class="container-fluid">
		
			<!-- Logo -->
			<?php include 'logonavbar.php'; ?>
			
			<!-- Menu on Left -->
        <div>
            <ul class="nav navbar-nav">
                <li  > <a href="home.php"> Home </a> </li>
                <li class="active" > <a href="create.php"> Add Contact </a> </li> 
            </ul>

            <!-- Menu on the right -->
            <?php include 'logoutnavbar.php'; ?>
        </div>
		</div>
	</nav>
   <div class="container-fluid">
    <div class="row">
		<div class="col-xs-4" ></div>
		<div class="col-xs-4" style="background-color:white ">

		<form method="post" action=""  >
			<table class="table table-hover"  width="100%" >
				<tr>
					<th colspan="3" ><h2 align="center"> Add Your Contact Details </h2> </th>
				</tr>
				<tr>
					<td> <input type="text" name="txtfname"  class="form-control" placeholder="First Name" title="only alpha value allowed" required /></td>
				</tr>
				<tr>
					<td> <input type="text" name="txtlname" class="form-control" placeholder="Last Name" required/> </td>
				</tr>
				<tr>
					<td> <input type="number" maxlength="11" name="txtmobile" class="form-control" placeholder="Mobile Number" required/>  </td>
				</tr>
				<tr>
					<td> <input type="number" name="txtLandline" class="form-control" placeholder="Mobile (optional)" pattern="{11}" title="11 Digits only"/></td>
				</tr>
				<tr>
					<td> <input type="email" name="txtemail" class="form-control" placeholder="Email Address" required/></td>
				</tr>
				<tr>
					<td> <input type="text" name="txtaddress"  class="form-control" placeholder="Home Address" required /> </td>
				</tr>
				<tr>
					<td> <br/> <input type="submit" name="insertdata" class="btn btn-primary" value="Save Contact"/></td>
				</tr>
			</table>
			</form>
			<br/><br/>
			<h3 align="center" class="text-primary"><?php echo $cs ?> </h3>
		</div>
		<div class="col-xs-4" >
		</div>
    </div>
    </div>
</body>
</html>

<?php 
	
	require_once("php/connect.php");
	
	$uid = $_SESSION['uid'];
	

# Extract Form values
	if(isset($_POST['insertdata'])){
	// check ctype function 
	if(!ctype_alpha($_POST['txtfname'])){
		echo "Only Alpha Characters Allowed in fname..!!";
	}elseif (!ctype_alpha($_POST['txtlname'])){
		echo "Only Alpha Characters Allowed in lname..!!";
	}elseif (!ctype_digit($_POST['txtmobile'])) {
		echo "Only Digits Allowed in Mobile Number..!!";
	}elseif (!ctype_digit($_POST['txtLandline'])) {
		echo "Only Digits Allowed in Mobile (optional) Number..!!";
	}else{
	# Extract Form values
	$fname = $_POST['txtfname'];
	$lname = $_POST['txtlname'];
	$mobile = $_POST['txtmobile'];
	$landline = $_POST['txtLandline'];
	$emailcontact = $_POST['txtemail'];
	$address = $_POST['txtaddress'];
	
  $query = "insert into contact (fname, lname, mobile, landline, emailcontact, address ,email,contactid) values('$fname','$lname',$mobile,$landline,'$emailcontact','$address','$uid','')";

	$_SESSION['insert_success']=1;
		header("Location:home.php");
		mysqli_query($con,$query);

}
	mysqli_close($con);
	}
?>