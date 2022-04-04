<?php

$db = mysqli_connect("localhost", "root", "", "pims_db2");

$msg = "";

if(isset($_POST['insertdata']))
{
    $image = $_FILES['image']['name'];
    // Get text
    $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $market = mysqli_real_escape_string($db, $_POST['market']);
  $category = mysqli_real_escape_string($db, $_POST['category']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);

    // image file directory
    $target = "images/".basename($image);

    $query = mysqli_query($db,"SELECT * FROM inventory WHERE product_name='$product_name' ");
      if(mysqli_num_rows($query) > 0)
      {
        echo '<script>
        window.location = "inventory.php.";
        alert("Product Already Exists !");
        </script>';
      }
      else
      {
        $sql = "INSERT INTO inventory (image, product_name, price, market,category,quantity) VALUES ('$image', '$product_name','$price','$market','$category','$quantity')";
        // execute query
        mysqli_query($db, $sql);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target))
        {
           echo '<script>
           window.location = "inventory.php";
           alert("Added successfully.");
           </script>';
        }
        else
        {
          echo 'not added';
        }
      }
}

?>