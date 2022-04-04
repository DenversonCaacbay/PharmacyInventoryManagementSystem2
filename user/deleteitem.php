<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'pims_db2');

if(isset($_POST['deletedata']))
{
    $product_id = $_POST['delete_id'];

    $query = "DELETE FROM cart WHERE product_id='$product_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> console.log("Product Removed"); </script>';
        header("Location:cart.php");
    }
    else
    {
        echo '<script> console.log("Product Not Deleted"); </script>';
    }
}

?>