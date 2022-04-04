<?php
session_start();

// Database connection
$con = mysqli_connect('localhost','root','');


if(!$con)
{
	echo 'Not connected to the server.';
}

if(!mysqli_select_db($con, 'pims_db2'))
{
	echo 'Database not selected.';
}

$product_id = $_POST['product_id'];
$username = $_POST['username'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

$sql = "insert into cart (product_id,username, product_name,quantity,price) values ('$product_id','$username','$product_name', '$price','$quantity')";
$sql = "UPDATE cart set total = '$price' * '$quantity' WHERE product_name = '$product_name'";


if(!mysqli_query($con, $sql))
{
	echo '<script> console.log("Not Reserved"); </script>';
	header("Location:cart.php");
}

else {
	echo '<script> console.log("Product reserved"); </script>';
        header("Location:cart.php");
}