<?php
   include("operation/connection.php");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include("header.php"); ?>


    <div class="container-fluid m1">

        <div class="container my-3">
            <h2 class="text-center font-weight-bold t2">Book a City Taxi to your destination in town</h1>
                <h3 class="text-center font-weight-bold t3">Choose from a range of categories and prices</h3>

                <div class="row r1">


                    <div class="col  border" id="bg">
                        <p class="text-center p-1 my-4 t1">City Taxi</p>
                        <h5 class="font-weight-bold text-center txt3">
                            Your everyday travel partner
                        </h5>
                        <p class="text-center">AC Cabs for point to point travel</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Pickup</span>
                            </div>
                            <select id="pickpt" class="form-control">
                                <option value="0">--Pickup location--</option>
                                <?php
                                 $q="SELECT * FROM `tbl_location` where is_available=1";
                                 $result = $conn->query($q);
                                 $n=$result->num_rows;
                                   for($i=0;$i<$n;$i++){
                                       $row=$result->fetch_assoc();
                                       ?>
                                       <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>

                                 <?php
                                   }
                                 ?>
                               
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Drop point</span>
                            </div>
                            <select id="droppt" class="form-control">
                                <option value="1">--Drop Location--</option>
                                <?php
                                 $q="SELECT * FROM `tbl_location` where is_available=1";
                                 $result = $conn->query($q);
                                 $n=$result->num_rows;
                                   for($i=0;$i<$n;$i++){
                                       $row=$result->fetch_assoc();
                                       ?>
                                       <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>

                                 <?php
                                   }
                                 ?>
            
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cab Type</span>
                            </div>
                            <select id="cabtype" class="form-control">
                                <option value="">--Cab Type--</option>
                                <option value="CedMicro">CedMicro</option>
                                <option value="CedMini">CedMini</option>
                                <option value="CedRoyal">CedRoyal</option>
                                <option value="CedSUV">CedSUV</option>
                            </select>

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">luggage</span>
                            </div>
                            <input type="number" id="wt" class="form-control" placeholder="luggage Weight in kg if any">

                        </div>
                        <div class="form-group">
                            <input type="button" class="form-control" id="click" value="Calculate Fair" data-toggle="modal" data-target="#myModal">
                        </div>
                    </div>
                    <!-- <div class="col-sm-8">&nbsp;</div> -->
                </div>
        </div>
    </div>


    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content text-center">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body text-center" id="data">
                </div>

                <div class="modal-footer">
                    <a class="btn btn-success" href="operation/insertintbl_ride.php">Book Now</a>
                    <button class="btn btn-danger" id="cancel" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>











    <footer>
        <?php include("footer.php");  ?>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var inputWt = document.getElementById("wt");
            var invalidChars = ["-", "+", "e", ];
            inputWt.addEventListener("input", function() {
                this.value = this.value.replace(/[e\+\-]/gi, "");
            });
            inputWt.addEventListener("keydown", function(e) {
                if (invalidChars.includes(e.key)) {
                    e.preventDefault();
                }
            });
            $('select').on('change', function() {
                var prevValue = $(this).data('previous');
                $('select').not(this).find('option[value="' + prevValue + '"]').show();
                var value = $(this).val();
                $(this).data('previous', value);
                $('select').not(this).find('option[value="' + value + '"]').hide();
            });
            $("#cabtype").change(function() {
                if ($("#cabtype").val() == "CedMicro") {
                    $("#wt").attr("placeholder", "carrige not available for cedMicro");
                    $("#wt").val("");
                    $("#wt").prop('disabled', true);
                } else {
                    $("#wt").attr("placeholder", "luggage Weight in kg if any");
                    $("#wt").prop('disabled', false);

                }
            });
            $("#click").click(function() {
                var pickpt = $("#pickpt").val();
                var droppt = $("#droppt").val();
                var cabtype = $("#cabtype").val();
                var wt = $("#wt").val();
                $("#wt").attr("value", "reset");
                if (wt < 0) {
                    $("#data").html("<h4>weight can't be negative</h4>");
                } else
                if (pickpt == '0') {
                    $("#data").html("<h4>please select Pickup point</h4>");
                } else if (droppt == '1') {
                    $("#data").html("<h4>please select Drop point</h4>");
                } else if (cabtype == '') {
                    $("#data").html("<h4>Please select cabtype</h4>");
                } else {
                    $.post("fairCal.php", {
                        pickpt: pickpt,
                        droppt: droppt,
                        cabtype: cabtype,
                        wt: wt
                    }, function(data, status) {

                        $("#data").html("<h2>Fair Amount & Distance</h2><br>" + "<h4>" + data + "</h4>");

                    })

                }

            });

            $("#book").click(function(){
                $.ajax({
                    url: "operation/inserittbl_ride",
                    success:function(data,status){

                    }
                })
            })

            
        })
    </script>

</body>

</html>