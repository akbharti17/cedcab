<?php
include("../operation/connection.php");
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
    <div class="container-fluid" id="addnewloc">
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
                        <input type="text" name="name"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">Distance</label>
                        <input type="text" name="dist" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Id">isAvailable</label>
                        <input type="text" name="is_avail"  class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="edit" class="form-control btn btn-success">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dist = $_POST['dist'];
    $is_avail = $_POST['is_avail'];

    $q ="INSERT INTO `tbl_location`(`id`, `name`, `distance`, `is_available`)
     VALUES ('$id','$name','$dist','$is_avail')";
    if ($conn->query($q) === TRUE) {
        echo "<script>alert('Inserted successfully');</script>";

    } else {
        echo "Error: " . $q . "<br>" . $conn->error;
    }
    
}


?>