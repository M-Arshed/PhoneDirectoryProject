<?php

    session_start();

    $_SESSION['success']="false";

    require_once("connect.php");

    $fname = $_POST['txtfname'];
    $lname = $_POST['txtlname'];
    $dob = $_POST['txtdob'];
    $mobile = $_POST['txtmobile'];
    $email = $_POST['txtemail'];
    $pass = md5($_POST['txtpassword']);



   $sql="insert into user(fname, lname,dob,mobile, email, password) values ('$fname','$lname','$dob',$mobile,'$email','$pass')";
   $_SESSION['success']="true";
     mysqli_query($con,$sql) or die("Somethings Wrong ".mysqli_error($con));
        header("Location: ..\index.php");

?>