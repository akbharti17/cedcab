<?php
include("../operation/connection.php");
session_start();

if (!isset($_SESSION['email'])) // If session is not set then redirect to Login Page
{
    header("Location: ../logout.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="sorttable.js"></script>
    <script>
        $(function() {
            $("#pndTbl").addSortWidget();
            $("#cmpTbl").addSortWidget();
            $("#cnlTbl").addSortWidget();
        });
    </script>
    <style>
        .bg1 {
            background-color: #46523C;
        }
        th{
            background-color:  #333300;
            color: white;
        }
        /* table{
            min-height: 460px;
        } */

        #pendingridetbl,
        #compRide,
        #allride,
        #cpasswsection,#changeprofile {
            display: none;
        }
    </style>
</head>

<body>
    <?php include("header.php");  ?>
    <!-- <h1>User Dashboard</h1> -->

    <!--Pending Rides-->
    <div class="container-fluid" id="pendingridetbl" style="min-height: 520px;">
        <h1 class="text-center">Pending Rides</h1>
        <label>Filter By :</label>
        <input oninput="w3.filterHTML('#pndTbl', '.item', this.value)" placeholder="Search for names and filter">
        <table class="table table-striped" id="pndTbl">
            <thead>
                <tr>
                    <th>Ride_id</th>
                    <th>From</th>
                    <th>to</th>
                    <th>Cab_Type</th>
                    <th>Ride Date</th>
                    <th>Distance</th>
                    <th>Luggage</th>
                    <th>Fair Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pndUser = $_SESSION['user_id'];
                // echo $pndUser;
                $q = "select * from tbl_ride where status=1 and customer_user_id='$pndUser'";


                $result = $conn->query($q);
                $n1 = $result->num_rows;

                for ($i = 0; $i < $n1; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo $row['ride_id']; ?></td>
                        <td><?php echo $row['from']; ?></td>
                        <td><?php echo $row['to']; ?></td>
                        <td><?php echo $row['cab_type']; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['total_distance']; ?></td>
                        <td><?php echo $row['luggage']; ?></td>
                        <td><?php echo $row['total_fair']; ?></td>
                        <td><a href='cancelride.php?rideid=<?php echo $row['ride_id']; ?>' class="btn btn-outline-danger">Cancel</a></td>
                    </tr>


                <?php

                }
                ?>
            </tbody>
        </table>
    </div>
    <!--End of Pending Ride-->

    <!--Completed Rides-->
    <div class="container-fluid" id="compRide" style="min-height: 520px;">
        <h1 class="text-center">Completed Rides</h1>
        <label>Filter By :</label>
        <input oninput="w3.filterHTML('#cmpTbl', '.item', this.value)" placeholder="Search for names and filter">
        <table class="table table-striped" id="cmpTbl">
            <thead>
                <tr>
                    <th>Ride_id</th>
                    <th>From</th>
                    <th>to</th>
                    <th>Cab_Type</th>
                    <th>Ride Date</th>
                    <th>Distance</th>
                    <th>Luggage</th>
                    <th>Fair Amount</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $pndUser = $_SESSION['user_id'];
                $q = "select * from tbl_ride where status=2 and customer_user_id='$pndUser'";


                $result = $conn->query($q);
                $n2 = $result->num_rows;

                for ($i = 0; $i < $n2; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo $row['ride_id'] ?></td>
                        <td><?php echo $row['from']; ?></td>
                        <td><?php echo $row['to']; ?></td>
                        <td><?php echo $row['cab_type']; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['total_distance']; ?></td>
                        <td><?php echo $row['luggage']; ?></td>
                        <td><?php echo $row['total_fair']; ?></td>
                    </tr>


                <?php

                }
                ?>
            </tbody>
        </table>
    </div>
    <!--End of Completed Ride-->

    <!--Cancel Rides-->
    <div class="container-fluid" id="allride" style="min-height: 520px;">
        <h1 class="text-center">Cancel Rides</h1>
        <label>Filter By :</label>
        <input oninput="w3.filterHTML('#cnlTbl', '.item', this.value)" placeholder="Search for names and filter">
        <table class="table table-striped" id="cnlTbl">
            <thead>
                <tr>
                    <th>Ride_id</th>
                    <th>From</th>
                    <th>to</th>
                    <th>Cab_Type</th>
                    <th>Ride Date</th>
                    <th>Distance</th>
                    <th>Luggage</th>
                    <th>Fair Amount</th>
                    <th>Status</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $pndUser = $_SESSION['user_id'];
                $q = "select * from tbl_ride where customer_user_id='$pndUser' and status=0";


                $result = $conn->query($q);
                $n3 = $result->num_rows;

                for ($i = 0; $i < $n3; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo$row['ride_id'] ?></td>
                        <td><?php echo $row['from']; ?></td>
                        <td><?php echo $row['to']; ?></td>
                        <td><?php echo $row['cab_type']; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['total_distance']; ?></td>
                        <td><?php echo $row['luggage']; ?></td>
                        <td><?php echo $row['total_fair']; ?></td>
                        <td>
                            <?php if ($row['status'] == 0) {
                                echo "canceled";
                            } elseif ($row['status'] == 1) {
                                echo "pending";
                            } elseif ($row['status'] == 2) {
                                echo "completed";
                            }
                            ?>
                        </td>
                    </tr>


                <?php

                }
                ?>
            </tbody>
        </table>
    </div>
    <!--End of Cancel Ride-->

    <!--Change password -->
    <div class="container-fluid" id="cpasswsection" style="min-height: 520px;">
        <h1 class="text-center">Change Password</h1>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="Old password">Old password</label>
                        <input type="password" id="oldpass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Old password">New password</label>
                        <input type="password" id="npass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Old password">Confirm password</label>
                        <input type="password" id="cpass" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="button" id="changePass" value="Update" class="form-control btn btn-success">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <!--End of Change password-->

    <!--Update profile -->

    <?php
    $email = $_SESSION['email'];
    $query = "select * from tbl_user where email_id='$email'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    ?>

    <div class="container-fluid" id="changeprofile">
        <h1 class="text-center">Change Password</h1>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="Old password">Name</label>
                        <input type="text" value="<?php echo $row['name']; ?>" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Old password">Mobile</label>
                        <input type="number" id="mobile" value="<?php echo $row['mobile']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="button" id="updateprofile" value="Update" class="form-control btn btn-success">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>

    <!--End of update profile  -->


    <!--Total expences -->
    <?php
    $some_q = " SELECT SUM(total_fair) AS `count_col` FROM tbl_ride where customer_user_id='$pndUser' and status=2";
    $result = $conn->query($some_q);
    $sum = 0;
    $n = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
        $sum = $row['count_col'];
    }
    ?>
    <!--End of Total expences -->

    <div class="container my-3" id="tabs" style="min-height: 520px;">
        <div class="row">
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Pending Rides</h4>
                        <p class="card-text"><?php echo $n1; ?></p>
                        <button type="button" id="showpendingride" class="btn btn-outline-info">Pending Rides</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Completed Rides</h4>
                        <p class="card-text"><?php echo $n2; ?></p>
                        <button type="button" id="showcr" class="btn btn-outline-info">Completed Rides</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Cancel Rides</h4>
                        <p class="card-text"><?php echo $n3; ?></p>
                        <button type="button" id="showallride" class="btn btn-outline-info">Cancel Rides</button>

                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Total Expences</h4>
                        <p class="card-text"><?php echo $sum; ?></p>
                        <button type="button" class="btn btn-outline-info">Total Expences</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    



    <?php include("footer.php");  ?>


    <script>
        $(document).ready(function() {
            $("#showpendingride").click(function() {
                $("#pendingridetbl").show();
                $("#allride").hide();
                $("#cpasswsection").hide();
                $("#compRide").hide();
                $("#changeprofile").hide();
                $("#tabs").css("display", "none");
            });

            $("#showcr").click(function() {
                $("#compRide").show();
                $("#allride").hide();
                $("#cpasswsection").hide();
                $("#pendingridetbl").hide();
                $("#changeprofile").hide();
                $("#tabs").css("display", "none");
            });
            $("#showallride").click(function() {
                $("#allride").show();
                $("#compRide").hide();
                $("#cpasswsection").hide();
                $("#pendingridetbl").hide();
                $("#changeprofile").hide();
                $("#tabs").css("display", "none");
            });
            $("#showChangepass").click(function() {
                $("#cpasswsection").show();
                $("#pendingridetbl").hide();
                $("#allride").hide();
                $("#compRide").hide();
                $("#changeprofile").hide();
                $("#tabs").css("display", "none");
            });
            $("#swupdateprofile").click(function(){
                $("#changeprofile").show();
                $("#cpasswsection").hide();
                $("#pendingridetbl").hide();
                $("#allride").hide();
                $("#compRide").hide();
                $("#tabs").css("display", "none");

            })

            $("#changePass").click(function() {
                var pass = $("#oldpass").val();
                var npass = $("#npass").val();
                var cpass = $("#cpass").val();
                console.log(pass);
                console.log(npass);
                console.log(cpass);
                $.ajax({
                    url: "changepassword.php",
                    method: "post",
                    data: {
                        pass: pass,
                        npass: npass,
                        cpass: cpass
                    },
                    success: function(data, status) {
                        alert(data);

                    }

                })
            })

            $("#updateprofile").click(function(){
                var name=$("#name").val();
                var mbl=$("#mobile").val();
                console.log(name);
                console.log(mbl);
                
                $.ajax({
                    url:"updateprofile.php",
                    method:"post",
                    data:{name:name,mobile:mbl},
                    success:function(data,status){
                        alert(data);
                    }
                })
            });
            
        });
    </script>
</body>

</html>