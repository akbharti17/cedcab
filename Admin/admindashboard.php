<?php
session_start();
include("../operation/connection.php");

if (!isset($_SESSION['email'])) // If session is not set then redirect to Login Page
{
    header("Location: ../logout.php");
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dist = $_POST['dist'];
    $is_avail = $_POST['is_avail'];

    $q = "INSERT INTO `tbl_location`(`id`, `name`, `distance`, `is_available`)
     VALUES ('$id','$name','$dist','$is_avail')";
    if ($conn->query($q) === TRUE) {
        echo "<script>alert('Inserted successfully');</script>";
    } else {
        echo "Error: " . $q . "<br>" . $conn->error;
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admindashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="./sorttable.js"></script>

    <script>
        $(function() {
            $("#dest").addSortWidget();
            $("#compTble").addSortWidget();
            $("#cancelTbl").addSortWidget();
            $("#allRideTbl").addSortWidget();
        });
    </script>

    <style>
        .bg1 {
            background-color: #46523C;
        }

        th {
            background-color: #333300;
            color: white;
        }

        /* table {
            min-height: 460px;
        } */

        #alluser,
        #cancelRide,
        #ridereq,
        #completedRide,
        #allRide,
        #blockuser,
        #unblockuser,
        #location,
        #addnewloc,
        #cpasswsection,
        #changeprofile {
            display: none;
        }
    </style>
</head>

<body>
    <?php include("header.php");  ?>

    <!-- All user Table -->
    <div class="container-fluid" id="alluser" style="min-height: 550px;">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>User_Id</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>DateOfSignUp</th>
                    <th>Mobile</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_user` where is_admin=0";
                $result = $conn->query($q);
                $n = $result->num_rows;
                for ($i = 0; $i < $n; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['email_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['dateofsignup']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>

                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>
    <!-- End of All user Table -->

    <!-- Ride Req Table -->
    <div class="container-fluid" id="ridereq" style="min-height: 550px;">
        <h1 class="text-center">Ride Requests</h1>
        <label>Filter By :</label>
        <input oninput="w3.filterHTML('#dest', '.item', this.value)" placeholder="Filter for names..">
        <table class="table table-striped text-center" id="dest">
            <thead>
                <tr>
                    <th>Ride_id</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Cabtype</th>
                    <th class="t1">Ride Date</th>
                    <th>Distance</th>
                    <th>Luggage</th>
                    <th class="t2">Total fair</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_ride` where status=1";
                $result = $conn->query($q);
                $pndreq = $result->num_rows;
                for ($i = 0; $i < $pndreq; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo $row['ride_id']; ?></td>
                        <td><?php echo $row['from']; ?></td>
                        <td><?php echo $row['to']; ?></td>
                        <td><?php echo $row['cab_type']; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['total_distance'] . " Km"; ?></td>
                        <td><?php echo $row['luggage']; ?></td>
                        <td><?php echo $row['total_fair']; ?></td>
                        <td><?php echo 'pending'; ?></td>
                        <td>
                            <a href='accept.php?id=<?php echo $row['customer_user_id']; ?>&ride_id=<?php echo $row['ride_id']; ?>' class="btn btn-outline-success">accept</a>
                            <a href='cancel.php?id=<?php echo $row['customer_user_id']; ?>&ride_id=<?php echo $row['ride_id']; ?>' class="btn btn-outline-danger">reject</a>
                        </td>
                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>
    <!--End of ride Req table -->

    <!--Completed Ride Table-->
    <div class="container-fluid" id="completedRide" style="min-height: 550px;">
        <h1 class="text-center">Completed Rides</h1>
        <label>Filter By :</label>
        <input oninput="w3.filterHTML('#compTble', '.item', this.value)" placeholder="Filter for names..">
        <table class="table table-striped text-center" id="compTble">
            <thead>
                <tr>
                    <th>Ride_id</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Cabtype</th>
                    <th class="t1">Ride Date</th>
                    <th>Distance</th>
                    <th>Luggage</th>
                    <th class="t2">Total fair</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_ride` where status=2";
                $result = $conn->query($q);
                $com = $result->num_rows;
                for ($i = 0; $i < $com; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo $row['ride_id']; ?></td>
                        <td><?php echo $row['from']; ?></td>
                        <td><?php echo $row['to']; ?></td>
                        <td><?php echo $row['cab_type']; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['total_distance'] . " Km"; ?></td>
                        <td><?php echo $row['luggage']; ?></td>
                        <td><?php echo $row['total_fair']; ?></td>
                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>
    <!--End completed Ride Table-->

    <!--Cancel Ride Table-->
    <div class="container-fluid" id="cancelRide" style="min-height: 550px;">
        <h1 class="text-center">Cancel Rides</h1>
        <label>Filter By :</label>
        <input oninput="w3.filterHTML('#cancelTbl', '.item', this.value)" placeholder="Filter for names..">
        <table class="table table-striped text-center" id="cancelTbl">
            <thead>
                <tr>
                    <th>Ride_id</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Cabtype</th>
                    <th class="t1">Ride Date</th>
                    <th>Distance</th>
                    <th>Luggage</th>
                    <th class="t2">Total fair</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_ride` where status=0";
                $result = $conn->query($q);
                $can = $result->num_rows;
                for ($i = 0; $i < $can; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo $row['ride_id']; ?></td>
                        <td><?php echo $row['from']; ?></td>
                        <td><?php echo $row['to']; ?></td>
                        <td><?php echo $row['cab_type']; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['total_distance'] . " Km"; ?></td>
                        <td><?php echo $row['luggage']; ?></td>
                        <td><?php echo $row['total_fair']; ?></td>
                        <td><?php echo "Canceled"; ?></td>
                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>
    <!--End cancel Ride Table-->

    <!--All Ride Table-->
    <div class="container-fluid" id="allRide" style="min-height: 550px;">
        <h1 class="text-center">All Rides</h1>
        <label>Filter By :</label>
        <input oninput="w3.filterHTML('#allRideTbl', '.item', this.value)" placeholder="Filter for names..">
        <table class="table table-striped text-center" id="allRideTbl">
            <thead>
                <tr>
                    <th>Ride_id</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Cabtype</th>
                    <th class="t1">Ride Date</th>
                    <th>Distance</th>
                    <th>Luggage</th>
                    <th class="t2">Total fair</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_ride`";
                $result = $conn->query($q);
                $aride = $result->num_rows;
                for ($i = 0; $i < $aride; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo $row['ride_id']; ?></td>
                        <td><?php echo $row['from']; ?></td>
                        <td><?php echo $row['to']; ?></td>
                        <td><?php echo $row['cab_type']; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['total_distance'] . " Km"; ?></td>
                        <td><?php echo $row['luggage']; ?></td>
                        <td><?php echo $row['total_fair']; ?></td>
                        <td><?php if ($row['status'] == 0) {
                                echo "canceled";
                            } else if ($row['status'] == 1) {
                                echo "pending";
                            } elseif ($row['status'] == 2) {
                                echo "completed";
                            } ?></td>
                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>
    <!--End All Ride Table-->

    <!--Block user Table-->
    <div class="container-fluid" id='blockuser' style="min-height: 550px;">
        <h1 class="text-center">Block User</h1>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>User_Id</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>DateOfSignUp</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_user` where is_admin=0 and `status`=0";
                $result = $conn->query($q);
                $nbuser = $result->num_rows;
                for ($i = 0; $i < $nbuser; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr class="item">
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['email_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['dateofsignup']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>
                            <a href='blockuser.php?email=<?php echo $row['email_id']; ?>' class="btn btn-outline-danger">Block</a>
                            <a href='unblockuser.php?email=<?php echo $row['email_id']; ?>' class="btn btn-outline-success">Unblock</a>
                        </td>
                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>
    <!--End block user Table-->

    <!--Unblock user Table-->
    <div class="container-fluid" id='unblockuser' style="min-height: 550px;">
        <h1 class="text-center">Unblocked User</h1>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>User_Id</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>DateOfSignUp</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_user` where is_admin=0 and `status`=1";
                $result = $conn->query($q);
                $unbuser = $result->num_rows;
                for ($i = 0; $i < $unbuser; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['email_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['dateofsignup']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>
                            <a href='blockuser.php?email=<?php echo $row['email_id']; ?>' class="btn btn-outline-danger">Block</a>
                            <a href='unblockuser.php?email=<?php echo $row['email_id']; ?>' class="btn btn-outline-success">Unblock</a>
                        </td>
                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>
    <!--End Unblock user Table-->

    <!--Service Location-->
    <div class="container-fluid" id='location' style="min-height: 550px;">
        <h1 class="text-center">Service Locations</h1>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Distance</th>
                    <th>isAvailable</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM `tbl_location`";
                $result = $conn->query($q);
                $nloc = $result->num_rows;
                for ($i = 0; $i < $nloc; $i++) {
                    $row = $result->fetch_assoc();
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['distance']; ?></td>
                        <td><?php echo $row['is_available']; ?></td>
                        <td>
                            <a href='editlocation.php?id=<?php echo $row['id']; ?>' class="btn btn-outline-success">Edit</a>
                            <a href='deletelocation.php?id=<?php echo $row['id']; ?>' class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                <?php  }

                ?>

            </tbody>
        </table>
    </div>

    <!--Service Location End-->

    <!--add new Location-->
    <div class="container-fluid" id="addnewloc" style="min-height: 550px;">
        <h1 class="text-center">Add New Location</h1>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="Id">Id</label>
                        <input type="text" name='id' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">Distance</label>
                        <input type="text" name="dist" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">isAvailable</label>
                        <input type="text" name="is_avail" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="edit" class="form-control btn btn-success">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <!-- end of add new location-->

    <!-- Change Password-->
    <div class="container-fluid" id="cpasswsection" style="min-height: 550px;">
        <h1 class="text-center">Change Your Password</h1>
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
    <!--End of change password-->

    <!--Update profile -->

    <?php
    $query = "select * from tbl_user where email_id='admin@gmail.com'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    ?>

    <div class="container-fluid" id="changeprofile" style="min-height: 550px;">
        <h1 class="text-center">Update Profile</h1>
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


    <div class="container" id="home" style="min-height: 550px;">
        <div class="row">
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Ride Requests</h4>
                        <p class="card-text"><?php echo $pndreq; ?></p>
                        <button type="button" id="showridereq" class="btn btn-outline-info">Ride Requests</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Completed Rides</h4>
                        <p class="card-text"><?php echo $com; ?></p>
                        <button type="button" id="showComRide" class="btn btn-outline-info">Completed Rides</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Cancel Rides</h4>
                        <p class="card-text"><?php echo $can; ?></p>
                        <button type="button" id="showCancelride" class="btn btn-outline-info">Cancel Rides</button>

                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">All Rides</h4>
                        <p class="card-text"><?php echo $aride; ?></p>
                        <button type="button" id="showAllride" class="btn btn-outline-info">Total Rides</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Blocked User</h4>
                        <p class="card-text"><?php echo $nbuser; ?></p>
                        <button type="button" id="showblkuser" class="btn btn-outline-info">Blocked User</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Unblocked User</h4>
                        <p class="card-text"><?php echo $unbuser; ?></p>
                        <button type="button" id="showunblkuser" class="btn btn-outline-info">Unblocked User</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">All Users</h4>
                        <p class="card-text"><?php echo $n; ?></p>
                        <button type="button" id="auser" class="btn btn-outline-info">All Users</button>

                    </div>
                </div>
            </div>
            <div class="col-sm-3 py-2 text-center">
                <div class="card h-100 border-primary bg1">
                    <div class="card-body">
                        <h4 class="card-title">Services Location</h4>
                        <p class="card-text"><?php echo $nloc; ?></p>
                        <button type="button" id="showloc" class="btn btn-outline-info">Services Location</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        //  $q="SELECT SUM(total_fair) FROM tbl_ride where customer_user_id='$pndUser'";
        $some_q = " SELECT SUM(total_fair) AS `count_col` FROM tbl_ride where status=2";
        $result = $conn->query($some_q);
        $sum = 0;
        $n = $result->num_rows;
        while ($row = $result->fetch_assoc()) {
            $sum = $row['count_col'];
        }



        ?>
        <div class="py-2 text-center" style="width: 40%; margin:0 auto; height:fit-content">
            <div class="card h-100 border-primary bg1">
                <div class="card-body">
                    <h4 class="card-title">Total Earning</h4>
                    <p class="card-text"><?php echo $sum . " Rs"; ?></p>
                    <button type="button" id="" class="btn btn-outline-info">Total Earning</button>
                </div>
            </div>
        </div>
    </div>

    <!--Current Request-->

    <!--End of current Request    -->









    <?php include("footer.php");  ?>
    
    <script>
        $(document).ready(function() {
            $("#auser").click(function() {
                $("#alluser").show();
                $("#home").hide();
            });
            $("#showridereq,#navridereq").click(function() {
                $("#home").hide();
                $("#ridereq").css("display", "block");
                $("#completedRide").css("display", "none");
                $("#cancelRide").css("display", "none");
                $("#allRide").css("display", "none");
                $("#location").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
                $("#addnewloc").css("display", "none");
                $("#cpasswsection").css("display", "none");
                $("#changeprofile").css("display", "none");
            })
            $("#showComRide,#navcomride").click(function() {
                $("#home").hide();
                $("#completedRide").css("display", "block");
                $("#ridereq").css("display", "none");
                $("#cancelRide").css("display", "none");
                $("#allRide").css("display", "none");
                $("#location").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
                $("#addnewloc").css("display", "none");
                $("#cpasswsection").css("display", "none");
                $("#changeprofile").css("display", "none");
            })
            $("#showCancelride,#navcancelride").click(function() {
                $("#home").hide();
                $("#cancelRide").css("display", "block");
                $("#completedRide").css("display", "none");
                $("#ridereq").css("display", "none");
                $("#allRide").css("display", "none");
                $("#location").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
                $("#addnewloc").css("display", "none");
                $("#cpasswsection").css("display", "none");
                $("#changeprofile").css("display", "none");
            });
            $("#showAllride,#navallride").click(function() {
                $("#home").hide();
                $("#allRide").css("display", "block");
                $("#cancelRide").css("display", "none");
                $("#completedRide").css("display", "none");
                $("#ridereq").css("display", "none");
                $("#location").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
                $("#addnewloc").css("display", "none");
                $("#cpasswsection").css("display", "none");
                $("#changeprofile").css("display", "none");
            });
            $("#showblkuser").click(function() {
                $("#home").hide();
                $("#blockuser").css("display", "block");
            })
            $("#showunblkuser").click(function() {
                $("#home").hide();
                $("#unblockuser").css("display", "block");
            })
            $("#showloc,#navloclist").click(function() {
                $("#home").hide();
                $("#location").css("display", "block");
                $("#allRide").css("display", "none");
                $("#cancelRide").css("display", "none");
                $("#completedRide").css("display", "none");
                $("#ridereq").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
                $("#addnewloc").css("display", "none");
                $("#cpasswsection").css("display", "none");
                $("#changeprofile").css("display", "none");
            })
            $("#showaddloc").click(function() {
                $("#home").hide();
                $("#addnewloc").css("display", "block");
                $("#location").css("display", "none");
                $("#allRide").css("display", "none");
                $("#cancelRide").css("display", "none");
                $("#completedRide").css("display", "none");
                $("#ridereq").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
                $("#cpasswsection").css("display", "none");
                $("#changeprofile").css("display", "none");
            })
            $("#showpasswsec").click(function() {
                $("#home").hide();
                $("#cpasswsection").css("display", "block");
                $("#addnewloc").css("display", "none");
                $("#location").css("display", "none");
                $("#allRide").css("display", "none");
                $("#cancelRide").css("display", "none");
                $("#completedRide").css("display", "none");
                $("#ridereq").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
                $("#changeprofile").css("display", "none");
            });
            $("#showcprofile").click(function() {
                $("#home").hide();
                $("#changeprofile").css("display", "block");
                $("#cpasswsection").css("display", "none");
                $("#addnewloc").css("display", "none");
                $("#location").css("display", "none");
                $("#allRide").css("display", "none");
                $("#cancelRide").css("display", "none");
                $("#completedRide").css("display", "none");
                $("#ridereq").css("display", "none");
                $("#blockuser").css("display", "none");
                $("#unblockuser").css("display", "none");
                $("#alluser").hide();
            });

            $("#changePass").click(function() {
                var pass = $("#oldpass").val();
                var npass = $("#npass").val();
                var cpass = $("#cpass").val();

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

            $("#updateprofile").click(function() {
                var name = $("#name").val();
                var mbl = $("#mobile").val();
                console.log(name);
                console.log(mbl);
                $.ajax({
                    url: "profilechange.php",
                    method: "post",
                    data: {
                        name: name,
                        mobile: mbl
                    },
                    success: function(data, status) {
                        alert(data);
                    }
                })
            })

        })
    </script>

</body>

</html>