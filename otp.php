<?php
if (isset($_POST['otp'])) {
    session_start();
    $votp = $_POST['otp'];
    if ($_SESSION['otp'] == $votp) {
        include('dbcon.php');
        $sql = "INSERT INTO `user` (`Name`, `Phone`, `Email`, `Password`) VALUES ('" . $_SESSION['name'] . "','" . $_SESSION['phone'] . "','" . $_SESSION['email'] . "','" . $_SESSION['password'] . "'" . ");";
        if ($conn->query($sql) === true) {
            echo "<script>
            alert('User Verification Complete');
            window.location.href='login.php';
            </script>";
            session_destroy();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            session_destroy();
        }
    } else {
        echo "<script>
            alert('Verfication Failed');
            window.location.href='login.php';
            </script>";
        session_destroy();
    }
} else {
    session_start();
    $_SESSION['name']     = $_POST['name'];
    $_SESSION['phone']    = $_POST['phone'];
    $_SESSION['email']    = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $otp                  = rand(1000, 9999);
    $phone                = $_POST['phone'];
    $_SESSION['otp']      = $otp;
    $field                = array(
        "sender_id" => "FSTSMS",
        "language" => "english",
        "route" => "qt",
        "numbers" => $phone,
        "message" => "20722",
        "variables" => "{#AA#}",
        "variables_values" => "$otp"
    );
    $curl                 = curl_init();
    
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
}
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>OTP Validate</title>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
        />
        <style>
            body {
                background: #eee;
            }

            .bgWhite {
                background: white;
                box-shadow: 0px 3px 6px 0px #cacaca;
            }

            .title {
                font-weight: 600;
                margin-top: 20px;
                font-size: 24px;
            }

            .customBtn {
                border-radius: 0px;
                padding: 10px;
            }

            form input {
                display: inline-block;
                height: 50px;
                text-align: center;
            }
        </style>
        <script>
            let digitValidate = function (ele) {
                console.log(ele.value);
                ele.value = ele.value.replace(/[^0-9]/g, "");
            };

            let tabChange = function (val) {
                let ele = document.querySelectorAll("input");
                if (ele[val - 1].value != "") {
                    ele[val].focus();
                } else if (ele[val - 1].value == "") {
                    ele[val - 2].focus();
                }
            };
        </script>
<script>
// Feature detection
if ('OTPCredential' in window) {
  window.addEventListener('DOMContentLoaded', e => {
    const input = document.getElementById("otp");
    if (!input) return;
    console.log("input field found");
    const ac = new AbortController();
    const form = input.closest('form');
    if (form) {
      form.addEventListener('submit', e => {
        ac.abort();
      });
      
    }
    navigator.credentials.get({
      otp: { transport:['sms'] },
      signal: ac.signal
    }).then(otp => {
      console.log(otp);
      input.value = otp.code;
      if (form) form.submit();
    }).catch(err => {
      console.log(err);
    });
  });
}
</script>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6 text-center">
                    <div class="row">
                        <div class="col-sm-12 mt-5 bgWhite">
                            <div class="title">Verify OTP</div>
                            Verification code has been send to your phone 
                            <?php
echo $_POST["phone"];
?>
                           <form method="post" class="mt-5">
                               <input type="text" id="otp" autocomplete="one-time-code" inputmode="numeric" pattern="\d{4}" name="otp" required/>
                    
                                <hr class="mt-4" />
                                <input class="btn btn-primary btn-block mt-4 mb-4 customBtn" type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>