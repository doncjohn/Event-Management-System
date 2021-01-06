<?php
include 'dbcon.php';
session_start();
if (isset($_SESSION['id'])) {
    header("Location: dashboard/index.php");
    $sql    = "SELECT * FROM `user` WHERE `User_ID` = " . $_SESSION['id'];
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["Role"] == "ADMIN") {
            header("location: dashboard/index.php");
        } else {
            header("location: index.php");
        }
    } else {
        echo "0 results";
    }
}

if (isset($_POST['reset'])) {
    $sql    = "SELECT * FROM `user` WHERE `Email` = '" . $_POST['email'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row               = $result->fetch_assoc();
        $_SESSION['id']    = $row["User_ID"];
        $_SESSION['phone'] = $row["phone"];
        $otp               = rand(1000, 9999);
        $phone             = $row["phone"];
        $_SESSION['otp']   = $otp;
        $field             = array(
            "sender_id" => "FSTSMS",
            "language" => "english",
            "route" => "qt",
            "numbers" => $phone,
            "message" => "20722",
            "variables" => "{#AA#}",
            "variables_values" => "$otp"
        );
        $curl              = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($field),
            CURLOPT_HTTPHEADER => array(
                "authorization: API KEY",
                "cache-control: no-cache",
                "accept: */*",
                "content-type: application/json"
            )
        ));
        
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "OTP Sending Error";
        } else {
            echo "OTP Sended Successfully";
        }
        
    } else {
        echo "<script>
            alert('Sorry, No user detials found with provided email id');
            window.location.href='login.php';
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css" />
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form method="POST" action="checkotp.php" class="sign-in-form">
                        <h2 class="title">Set Password</h2>
                        <p class="social-text">Enter OTP sent to your Mobile no</p>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="text" placeholder="OTP" name="otp" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Enter Password" name="password1" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Re Enter Password" name="password2" />
                        </div>
                        <input type="submit" name="signup" class="btn" value="Submit" />
                    </form>
                </div>
            </div>

            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>New Here?</h3>
                        <p>Create your Account Now!</p>
                        <a href="login.php"><button class="btn transparent">Sign up</button></a>
                    </div>
                    <img src="img/log.svg" class="image" alt="" />
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <h3>One of us ?</h3>
                        <p>Login to Portal Now!</p>
                        <a href="login.php"><button class="btn transparent">Sign up</button></a>
                    </div>
                    <img src="img/register.svg" class="image" alt="" />
                </div>
            </div>
        </div>
        <script src="app.js"></script>
    </body>
</html>