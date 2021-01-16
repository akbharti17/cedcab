<?php
session_start();
include("operation/connection.php");
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $password=md5($pass);
    $q = "select * from tbl_user where email_id='$email' and password='$password'";
    $result = $conn->query($q);
    $row = $result->fetch_assoc();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        if($row["status"]==0){
            echo "<script>alert('You are blocked by Admin');</script>";
        }else{
            if ($email == $row['email_id'] && md5($pass) == $row['password'] && $row["is_admin"] == 0) {
                echo "User login";
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['is_admin']=$row["is_admin"];
                setcookie('name',$row['name']);
                if(isset($_SESSION["booking"])){
                    header("location: operation/insertintbl_ride.php"); 
                }else{
                    header("location: User/userdashboard.php");
    
                }
                
            } else if ($email == $row['email_id'] && md5($pass) == $row['password'] && $row["is_admin"] == 1) {
                header("location: Admin/admindashboard.php");
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                echo "Admin login";
            }
        }
    } else {
        echo "<script>alert('Incorrect UserId and Password');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include("header.php"); ?>


    <div class="container">
        <div class="row my-4" style="height: 475px;">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="Enter password" id="pass" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success" value="Submit" name="login" id="signup">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>




    <footer>
        <?php include("footer.php");  ?>
    </footer>




</body>

</html>