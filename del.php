<?php
$servername="localhost";
$username="root";
$user_pwd="";
$dbName="student";

$con = mysqli_connect($servername,$username,$user_pwd,$dbName);
if(!$con){
    die("Connection is failed".mysqli_connect_error());
}
if(isset($_GET['del'])){
    $id=$_GET['del'];
    $del="delete from my_std where id = '$id'";
    if(mysqli_query($con,$del)){
        echo "<script>alert('student is deleted')</script>";
         echo "<script>window.open('CRUD.php','_self')</script>";
    }


}


?>