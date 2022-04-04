<?php
session_start();

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `cart` WHERE CONCAT(`id`,`product_name`, `price`, `quantity`, `total`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `cart`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "pims_db2");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}


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
        <h3>My Cart</h3>


<div class="card-body">
                <form action="inventory.php" method="post">
                </div>

            <div class="card">
                <div class="card-body">
                <?php
                $connection = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($connection, 'pims_db2');


                $user_check = $_SESSION['username'];
               // $result = $mysqli->query("");
                $query = "SELECT * FROM cart WHERE username='$user_check'";
                $query_run = mysqli_query($connection, $query);
            ?>
                    <table id="datatableid" class="table table-bordered table-dark">

                            <tr>
                            <th scope="col"> Product Id </th>
                                <th scope="col">Product Name </th>
                                <th scope="col"> Price </th>
                                <th scope="col"> Quantity </th>
                                
                                
                                <th scope="col"> Total</th>
                                <th scope="col"> Delete </th>
                                <th scope="col"> Reserved </th>
                            </tr>
                            <?php while($row = mysqli_fetch_array($search_result)):?>
                                <?php
                                    $mysqli = new mysqli('localhost', 'root', '', 'pims_db2');
                                    $user_check = $_SESSION['username'];
                                    $result = $mysqli->query("SELECT * FROM cart WHERE username='$user_check'");
                                ?>
                            <tr>
                                
                            <td> <?php echo $row['product_id']; ?> </td>
                                <td> <?php echo $row['product_name']; ?> </td>
                                <td> <?php echo $row['quantity']; ?> </td>
                                <td> <?php echo $row['price']; ?> </td>
                                
                                <td> <?php echo $row['total']; ?> </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> Delete </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> Reserved </button>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </table>
                    </form>
                </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
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