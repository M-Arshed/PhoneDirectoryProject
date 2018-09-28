<?php
    session_start();
    require_once('php/connect.php');
    $update_msg="";
    if(!isset($_SESSION['uid']))
            {
                    header("location: index.php");
            }
    if(isset($_SESSION['update_success']))
    {
        $update_msg="Contact Successfully Updated !";
        unset($_SESSION['update_success']);
    }
    

    $uid = $_SESSION["uid"];
?>

<html>

<head>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-1.12.2.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
table {
    font-family: arial, sans-serif;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;

}

tr:nth-child(even) {
    background-color: #dddddd;
}
    </style>
    <title> Dashboard </title>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Logo -->
        <?php include 'logonavbar.php'; ?>

        <!-- Menu on Left -->
        <div>
            <ul class="nav navbar-nav">
                <li class="active"  > <a href="home.php"> Home </a> </li>
                <li> <a href="create.php"> Add Contact </a> </li>
            </ul>

            <!-- Menu on the right -->
            <?php include 'logoutnavbar.php'; ?>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-2" ></div>
        <div class="col-xs-8" style="background-color:white ">
            <div class="jumbotron">
                <h1> <center>WELCOME</center></h1>
                <h5></center>

                [<?php echo $uid ; ?>]

                 To Your Personal Phone Book Directory!</center></h5>
                <p>Now You Can Easily Create New Contacts as well as Manage Your Existing Contacts. Its Your Personal Phone Book Directory which helps you to permanently save your contacts.</p>
            </div>
        <h3 align="center" class="text-success"><?php echo $update_msg ; ?></h3>

<?php
$query ="select * from contact where email = '$uid'" ;
$result=mysqli_query($con,$query);

echo "

<table border='1'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Mobile # 1</th>
<th>Mobile # 2 (optional)</th>
<th>Home Address </th>
<th>Update </th>
<th>Delete </th>

</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['fname'] . "</td>";
  echo "<td>" . $row['lname'] . "</td>";
  echo "<td>" . $row['emailcontact'] . "</td>";
  echo "<td>" . $row['mobile'] . "</td>";
  echo "<td>" . $row['landline'] . "</td>";
  echo "<td>" . $row['address'] . "</td>";
  ?>
  <td><a href="updatedata.php?updatecontact=<?php echo $row['contactid']; ?>"><button class="btn btn-primary">Update</button></a></td>   
  <td><a href="home.php?deletecontact=<?php echo $row['contactid']; ?>"><button class="btn btn-primary">Delete</button></a></td>
                
    <?php    

  echo "</tr>";
  }
echo "</table>";

?>

<?php


     $uid = $_SESSION['uid'];
// Delete Contact No Code:

if(isset($_GET['deletecontact'])){

    $deletecontact = $_GET['deletecontact'];
    $deletequery = "Delete from contact where contactid = $deletecontact";

    mysqli_query($con,$deletequery);

        //header("location:home.php");
        mysqli_close($con); 

}
?>

        </div>
        <div class="col-xs-2" ></div>
    </div>
</div>
</body>
</html>