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
        <h3>Profile</h3>
        <?php echo $_SESSION['username'];?>

        <div class="section" style="width: 90%;">
        <?php
  $connect = mysqli_connect('localhost','root','','pims_db2');
  $user_check = $_SESSION['username'];

  $query="SELECT * FROM accounts WHERE username='$user_check'";
  $result = mysqli_query($connect, $query);
  if($result):
    if(mysqli_num_rows($result)>0):
      while($product = mysqli_fetch_assoc($result)):
        //print_r($product);
        ?>
  <div class="lalagyan">
      <form method="POST">
        <div class="product">
        <h4 style="font-size: 18px;color:#526dfe;margin-left: 10px;">Customer ID : <?php echo $product['customer_id'] ?></h4>
          <h4 style="font-size: 18px;color:#526dfe;margin-left: 10px;">Name : <?php echo $product['full_name'] ?></h4>
          <h4 style="margin-left: 10px;">Username : <?php echo $product['username']; ?></h4>
          <h4 style="font-size:13px;margin-left: 10px;">Email :<?php echo $product['email']; ?></h4>
        </div>

      </form>
  </div>
</div>
<?php
  endwhile;
endif;
endif;
?>
</div>

</body>
</html>