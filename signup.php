<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body onload="disable()">
    <?php include("header.php"); ?>

    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="row">
                        <div class="col-sm-9"><input type="text" class="form-control" placeholder="Enter Email" id="email" required></div>
                        <div class="col-sm-3"><input type="button" id="sendemailotp" class="btn btn-success" value="send otp"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9"><input type="text" class="form-control" placeholder="Enter otp" id="emailotpval" required></div>
                        <div class="col-sm-3"><input type="button" class="btn btn-success" id="verifyemail" value="verify"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Mobile</label>
                    <div class="row">
                        <div class="col-sm-9"><input type="number" class="form-control" placeholder="Enter mobile Number" id="mobile" required></div>
                        <div class="col-sm-3"><input type="button" id="sendmobotp" class="btn btn-success" value="send otp"></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-sm-9"><input type="text" class="form-control" placeholder="Enter otp" id="mobotpval" required></div>
                        <div class="col-sm-3"><input type="button" id="verifymob" class="btn btn-success" value="verify"></div>
                    </div>

                </div>
                <form id="myForm">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" placeholder="Enter Username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Password</label>
                        <input type="password" class="form-control" placeholder="Enter password" id="pass" required>
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control btn btn-primary" value="Signup" name="b1" id="signup">
                    </div>
                </form>

            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <footer><?php include("footer.php"); ?></footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function disable() {
            $("#myForm :input").prop("disabled", true);
            $("#mobile").prop("disabled", true);
            $("#mobotpval").prop("disabled", true);
            $("#sendmobotp").prop("disabled", true);
            $("#verifymob").prop("disabled", true);
        }

        $(document).ready(function() {
            $("#sendemailotp").click(function() {
                var email = $("#email").val();
                $.ajax({
                    url: "verfication/otpforemail.php",
                    method: "post",
                    beforeSend: function() {
                        $("#sendemailotp").prop("value", "sending..");
                        $("#sendemailotp").prop("disabled", true);
                    },
                    data: {
                        email: email
                    },
                    success: function(data, status) {
                        alert(data);
                        if(data=="Mail send"){
                            $("#sendemailotp").prop("value", "Resend");
                            $("#sendemailotp").prop("disabled", false); 
                        }else{
                            $("#sendemailotp").prop("value", "send otp");
                            $("#sendemailotp").prop("disabled", false);
                        }
                    }
                });
            })

            $("#verifyemail").click(function() {
                var emailotp = $("#emailotpval").val();
                console.log(emailotp);

                $.ajax({
                    url: "verfication/verifyemail.php",
                    method: "post",
                    
                    data: {
                        emailotp: emailotp
                    },
                    success: function(data, status) {
                        alert(data);
                        if (data == "verified") {
                            $("#mobile").prop("disabled", false);
                            $("#mobotpval").prop("disabled", false);
                            $("#sendmobotp").prop("disabled", false);
                            $("#verifymob").prop("disabled", false);
                            $("#verifyemail").prop("value", "verified");
                            $("#verifyemail").prop("disabled", true);
                            $("#sendemailotp").prop("disabled", true);
                        } else {
                            $("#mobile").prop("disabled", true);
                            $("#mobotpval").prop("disabled", true);
                            $("#sendmobotp").prop("disabled", true);
                            $("#verifymob").prop("disabled", true);

                        }
                    },
                });
            })

            $("#sendmobotp").click(function() {
                var mobile = $("#mobile").val();
                $.ajax({
                    url: "verfication/otpformob.php",
                    method: "post",
                    data: {
                        mobile: mobile
                    },
                    beforeSend: function() {
                        $("#sendmobotp").prop("value", "sending..");
                        $("#sendmobotp").prop("disabled", true);
                    },
                    success: function(data, status) {
                        alert(data);
                        if(data=="otp sent"){
                            $("#sendmobotp").prop("value", "done");
                            $("#sendmobotp").prop("disabled", true);

                        }else{
                            $("#sendmobotp").prop("value", "send otp");
                            $("#sendmobotp").prop("disabled", false);

                        }
                    },
                });
            })

            $("#verifymob").click(function() {
                var mobotp = $("#mobotpval").val();
                //  console.log(emailotp);

                $.ajax({
                    url: "verfication/verifymobotp.php",
                    method: "post",
                    data: {
                        mobotp: mobotp
                    },
                    success: function(data, status) {
                        alert(data);
                        if (data == "verified") {
                            $("#myForm :input").prop("disabled", false);
                            $("#verifymob").prop("disabled", true);
                            $("#verifymob").prop("value","verified");
                        } else {
                            $("#myForm :input").prop("disabled", true);
                            $("#verifymob").prop("disabled", false);
                            $("#verifymob").prop("disabled", false);
                            $("#verifymob").prop("value","verify");
                        }
                    }
                });
            })

            $("#signup").click(function() {
                var email = $("#email").val();
                var mobile = $("#mobile").val();
                var usrid = $("#username").val();
                var name = $("#name").val();
                var pass = $("#pass").val();
                console.log(email);

                $.ajax({
                    url: "operation/insert.php",
                    method: "post",
                    data: {
                        email: email,
                        mobile: mobile,
                        usrid: usrid,
                        name: name,
                        pass: pass
                    },
                    success: function(data, status) {
                        alert(data);

                    }
                });
            })


        })
    </script>

</body>

</html>