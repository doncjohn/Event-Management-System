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
                    <form action="resetotp.php" method="POST" class="sign-in-form">
                        <h3 class="title">Forgot Password</h3>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" name="email" placeholder="Email" />
                        </div>
                        <input type="submit" name="reset" value="Submit" class="btn solid" />
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