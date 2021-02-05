<?php
include("../operation/connection.php");
$id = $_GET['id'];
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dist = $_POST['dist'];
    $is_avail = $_POST['is_avail'];

    $q = "UPDATE `tbl_location` SET 
    `name`='$name',`distance`='$dist',`is_available`='$is_avail' WHERE id='$id'";
    if ($conn->query($q) === TRUE) {
        echo "<script>alert('Updated successfully');</script>";
        // header("location: admindashboard.php");
        header('Refresh:0; url=admindashboard.php');

    } else {
        echo "Error: " . $q . "<br>" . $conn->error;
    }
    
}
$q = "select * from tbl_location where id='$id'";

$result = $conn->query($q);

$row = $result->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editlocation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include("header.php");  ?>
    <div class="container-fluid" style="min-height: 550px;">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="Id">Id</label>
                        <input type="text" name='id' value="<?php echo $row['id']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">Name</label>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">Distance</label>
                        <input type="text" name="dist" value="<?php echo $row['distance']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">isAvailable</label>
                        <input type="text" name="is_avail" value="<?php echo $row['is_available']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="edit" value="update" class="form-control btn btn-success">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <?php include("footer.php");  ?>
</body>

</html>

<!--  -->