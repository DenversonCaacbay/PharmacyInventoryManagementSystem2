<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'pims_db2');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $query = "UPDATE inventory SET product_name='$product_name', price='$price', quantity='$quantity' WHERE id='$id'  ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:inventory.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>