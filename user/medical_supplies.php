<?php

session_start();


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy Inventory Management System</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="products.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg py-3 sticky-top navbar-dark">
        <div class="container">
          <img class="logo" src="../images/company_logo.png">
          <a class="navbar-brand" href="#">P.I.M.S ph</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="medical_supplies.php">Medical Supplies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="protection_and_hygine.php">Protection & Hygine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mom_and_baby.php">Mom & Baby</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="covid_essential.php">Covid Essential</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                       <button class="btn" onclick="window.location.href= '../index.php'; alert('Logging out...');" style = "padding:10px;height: 40px; background: white; color: #526dfe;">
            Log Out
          </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="toTop">
        <h3>MEDICAL SUPPLIES</h3>
        <?php echo $_SESSION['username'];?>
        
    
</div>


<div class="section" style="width: 90%;">
  <?php
  $connect = mysqli_connect('localhost','root','','pims_db2');
  $query = 'SELECT * FROM inventory WHERE category="Medical Supplies"';
  $result = mysqli_query($connect, $query);
  if($result):
    if(mysqli_num_rows($result)>0):
      while($product = mysqli_fetch_assoc($result)):
        //print_r($product);
        ?>
  <div class="lalagyan">
      <form method="POST" action="create_reservation.php">
        <div class="product">
          <img src="../admin/images/<?php echo $product['image']; ?>" class="img-responsive" />
          <h4 style="font-size: 18px;color:#526dfe;margin-left: 10px;"><?php echo $product['product_name']; ?></h4>
          <h4 style="margin-left: 10px;">₱<?php echo $product['price']; ?></h4>
          <h4 style="font-size:13px;margin-left: 10px;">Stocks :<?php echo $product['quantity']; ?></h4>
          <input type="text" name="quantity" class="form-control" style="width: 90%;" value="1" />
          <input type="hidden" name="product_id" class="form-control" value="<?php echo $product['id']; ?>" />
          <input type="hidden" name="product_name" class="form-control" value="<?php echo $product['product_name']; ?>" />
          <input type="hidden" name="price" class="form-control" value="<?php echo $product['price']; ?>" />
          <input type="hidden" name="username" class="form-control" value="<?php echo $_SESSION['username'];?>" />
          <input type="submit" name="add_to_cart" style="width:90%;margin-top:5px;" class="btn btn-info deletebtn" value="Add to Cart" />
        </div>

      </form>
  </div>
  <?php
  endwhile;
endif;
endif;
?>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {
                $('#viewmodal').modal('show');
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "display.php",
                    dataType: "html", //expect html to be returned                
                    success: function (response) {
                        $("#responsecontainer").html(response);
                        //alert(response);
                    }
                });
            });

        });
    </script>


    <!-- <script>
        $(document).ready(function () {

            $('#datatableid').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Your Data",
                }
            });

        });
    </script> -->

    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>
</body>
</html>