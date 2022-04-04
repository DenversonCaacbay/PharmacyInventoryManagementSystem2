<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `inventory` WHERE CONCAT(`id`,`image`, `product_name`, `price`, `market`, `generic_name`,`category`, `packaging_type`, `quantity`,`expiration_date`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `inventory`";
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
    <title>Pharmacy Inventory Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
    
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
                        <a class="nav-link" href="reservation.php">RESERVATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory.php">INVENTORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payment.php">PAYMENT</a>
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

    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Data </h5>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>

                <form action="insertcode.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Product Image </label>
                            <input type="hidden" name="size" value="1000000">
                            <div>
                                <input type="file" name="image">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label> Product Name </label>
                            <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name">
                        </div>

                        <div class="form-group">
                            <label> Price </label>
                            <input type="text" name="price" class="form-control" placeholder="Enter Price">
                        </div>

                        <div class="form-group">
                            <label> Market By </label>
                            <input type="text" name="market" class="form-control" placeholder="Market By">
                        </div>
                        <div class="form-group">
                            <label> Generic Name </label>
                            <input type="text" name="generic_name" class="form-control" placeholder="Enter Generic Name">
                        </div>

                        <div class="form-group">
                            <label> Category </label>
                            <select class="txtb box" name="category">
                                <option value="Medical Supplies">Medical Supplies</option>
                                <option value="Mom And Baby">Mom And Baby</option>
                                <option value="Protection And Hygine">Protection And Hygine</option>
                                <option value="Covid Essential">Covid Essential</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Packaging Type </label>
                            <input type="text" name="packaging_type" class="form-control" placeholder="Enter Packaging Type">
                        </div>

                        <div class="form-group">
                            <label> Quantity </label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity">
                        </div>
                    </div>
                    <div style="width: 46%;margin-left:20%;">
                        <label><b>Expiration Date :</b></label>
                        <input type="date" name="expiration_date" value="2021-12-15">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Product Info </h5>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>

                <form action="updatecode.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label> Product Name </label>
                            <input type="text" name="product_name" id="product_name" class="form-control"
                                placeholder="Enter New Product Name">
                        </div>

                        <div class="form-group">
                            <label> Price </label>
                            <input type="text" name="price" id="price" class="form-control"
                                placeholder="Enter New Price">
                        </div>

                        <div class="form-group">
                            <label> Quantity </label>
                            <input type="text" name="quantity" id="quantity" class="form-control"
                                placeholder="Enter New Quantity">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- VIEW POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> View Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">

                        <input type="text" name="view_id" id="view_id">

                        <!-- <p id="fname"> </p> -->
                        <h4 id="fname"> <?php echo ''; ?> </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> CLOSE </button>
                        <!-- <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button> -->
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="">
        <div class="jumbotron">
            <div class="toTop">
                <h3>P.I.M.S RESERVATIONS</h3>
            </div>

                <div class="card-body">
                <form action="inventory.php" method="post">
            <div class="sub-btn">
                <input type="text" style="width:40%" name="valueToSearch" placeholder="Search Product...">
                <input class="btn btn-primary" type="submit" name="search" value="Search">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button>
            </div>
                    
                </div>

            <div class="card">
                <div class="card-body">

                    <?php
                $connection = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($connection, 'pims_db2');

                $query = "SELECT * FROM inventory";
                $query_run = mysqli_query($connection, $query);
            ?>
                    <table id="datatableid" class="table table-bordered table-dark">
                        
                            <tr>
                                <th scope="col"> ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name </th>
                                <th scope="col"> Price </th>
                                <th scope="col"> Marketed By </th>
                                <th scope="col"> Generic Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Packaging Type </th>
                                <th scope="col"> Quantity </th>
                                <th scope="col"> Expiration Date </th>
                                <th scope="col"> EDIT </th>
                                <th scope="col"> DELETE </th>
                            </tr>
                            <?php while($row = mysqli_fetch_array($search_result)):?>
                                <?php
                                    $mysqli = new mysqli('localhost', 'root', '', 'pims_db2');
                                    $result = $mysqli->query("SELECT * FROM inventory")
                                ?>
                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['image']; ?> </td>
                                <td> <?php echo $row['product_name']; ?> </td>
                                <td> <?php echo $row['price']; ?> </td>
                                <td> <?php echo $row['market']; ?> </td>
                                <td> <?php echo $row['generic_name']; ?> </td>
                                <td> <?php echo $row['category']; ?> </td>
                                <td> <?php echo $row['packaging_type']; ?> </td>
                                <td> <?php echo $row['quantity']; ?> </td>
                                <td> <?php echo $row['expiration_date']; ?> </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </table>
                    </form>
                </div>
            </div>


        </div>
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

    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#product_name').val(data[2]);
                $('#price').val(data[3]);
                $('#quantity').val(data[8]);
            });
        });
    </script>

</body>
</html>