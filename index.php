<?php
session_start();
include_once("./PHP/Connection.php");
$msg='';

$row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `shethmaster`"));
if(isset($_COOKIE['rem']) && isset($_COOKIE["remusername"])  && $_COOKIE['rem']!="off")
{
    if($_COOKIE["remusername"]==$row['EMAIL'])
    {
        $_SESSION['SID']=$row['SID'];
        $_SESSION['EMAIL']=$row['EMAIL'];
        $_SESSION['NAME']=$row['NAME'];
        $_SESSION['BRAND']=$row['BRAND'];
        echo "<script>location.href='./home.php'</script>";
    }
    else
    {
        $_SESSION['SID']="";
    }
}
else
{
    if(isset($_POST['SubmitBtn']))
    {

    $uname=$_POST['email'];
    $pass=$_POST['password'];
    $result=mysqli_query($con,"SELECT * FROM `shethmaster` WHERE EMAIL='".$uname."'");
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
    if(password_verify($pass,$row['PASSWORD']) && $uname==$row['EMAIL'])
    {
           setcookie("remusername",$uname,time()+(365*24*60*60));
        if(isset($_POST['remember']))
        {
            
            setcookie("rem",$_POST['remember'],time()+(365*24*60*60),"./PHP");
        }
        $_SESSION['SID']=$row['SID'];
        $_SESSION['EMAIL']=$row['EMAIL'];
        $_SESSION['NAME']=$row['NAME'];
        $_SESSION['BRAND']=$row['BRAND'];
        echo "<script>location.href='./home.php'</script>";
    }
    else
    {
        $msg= " <script>Swal.fire({ icon: 'error', title: 'Oops...', text: 'Wrong Creadational Information!'})</script>";
    }
    }
    else
    {
        $msg= " <script>Swal.fire({ icon: 'error', title: 'Oops...', text: 'Wrong Creadational Information!'})</script>";
    }
    
}

}

$usercookie='';
$passcookie='';
if(isset($_COOKIE["remusername"]))
{
    $usercookie=$_COOKIE["remusername"];
    $passcookie="";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HalDhar</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Kadwa:wght@400;700&family=Keania+One&family=Poppins:wght@100;300;400;500;600&display=swap');

    * {
        font-family: 'Kadwa', serif;
        ;
    }




    input {
        background: none;
    }

    ::-webkit-input-placeholder,
    ::placeholder,
    ::-moz-placeholder {
        color: #6F0E7E;
    }

    input {
        color: #6F0E7E;
    }
    </style>
    <style>
    .popup-forgotpass,
    .popup-reset-pass,
    .popup-otp {
        position: absolute;
        top: 0;
        z-index: 10000000;
        height: 100vh;
        width: 100vw;
        background: rgba(0, 0, 0, .5);
        backdrop-filter: blur(5px);
        display: none;
        justify-content: center;
    }

    .popup {
        width: 370px;
        height: 400px;
        border-radius: 5px;
        background: #fff;
        transition: 2s;
    }


    .popup-forgotpass .popup {
        height: 300px;
    }

    .popup-otp .popup {
        height: 480px;
    }

    .popup form .input-group {
        border: 1px solid rgba(0, 0, 0, .2);
        padding: 8px;
        padding-left: 10px;
        border-radius: 5px;
        width: 80%;
        margin: 8px;
    }

    .popup form i {
        font-size: large;
        margin-right: 5px;
    }

    .popup form input,
    button {
        border: none;
        outline: none;

    }

    .popup-reset-pass .popup {
        height: 400px;

    }

    .popup form button {
        width: 80%;
        padding: 8px;
        border-radius: 5px;
        margin: 8px;
        background: #932e3e;
        color: #fff;
    }

    :root {
        --background-color: #fff;
        --active: #7f8084;
        --border: #b7b8bc;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .Avatar {
        height: 150px;
        width: 150px;
        border: 5px solid blueviolet;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    .Avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .dig {
        height: 40px;
        width: 40px;
        margin: 5px;
        border-radius: 5px;
        border: 1.5px solid var(--border);
        color: blueviolet;
        font-weight: bold;

    }

    .otp input {
        position: absolute;
        width: 300px;
        height: 40px;
        opacity: 0;
    }

    .verify-btn {
        margin-top: 10px;
        background: blueviolet;
        color: white;
        padding: 10px;
        width: 30%;
        border: none;
        border-radius: 5px;
    }

    .expire {
        color: darkred;
        font-size: small;
        text-align: end;
        width: 80%;
        margin: 5px;
    }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="main-panel w-100 " style="height: 100vh;">
            <div class="content-wrapper d-flex justify-content-center"
                style="background-size: cover;display:flex;align-items: center;justify-content: center;">
                <div class="stretch-card" style="width:800px;height: 500px;">
                    <div class="card overflow-hidden" style="border-radius: 15px;">

                        <div class="h-100 d-flex w-100 justify-content-center align-items-center"
                            style="min-width:400px ; flex-wrap: wrap-reverse;">
                            <div class="h-100 w-50" id="left">
                                <img src="./assets/images/Group 15.png" alt="" srcset=""
                                    style="height: 100%;width:100%;min-width: 400px;">
                            </div>
                            <div id="right"
                                class="w-50 h-100 d-flex flex-column justify-content-center align-items-center;"
                                style="padding-top: 30px;">
                                <h2
                                    style="font-family: 'Keania One', cursive;color: #6F0E7E;text-align: left;width:100% ;">
                                    Welcome
                                </h2>
                                <form id="form" class="form-sample w-100 d-flex flex-column" style=" margin-top: 30px;"
                                    method="post">
                                    <div class="d-flex p-0" style="margin: 2px;margin-bottom:20px;width: 80%;">
                                        <i class="mdi mdi-account"
                                            style="position: absolute; font-size:24px;color:#6F0E7E;"></i>
                                        <input type="email" name="email" id="LEMAIL" class=" w-100"
                                            value="<?php if(isset($usercookie)) echo $usercookie;?>"
                                            placeholder="abc@gmail.com"
                                            style="border: none;border-bottom:1px solid #6F0E7E  ;padding-left: 30px;padding-bottom:5px"
                                            required>
                                    </div>
                                    <div class="d-flex h-25 " style="width: 80%;">
                                        <i class="mdi mdi-lock"
                                            style="position: absolute;font-size:24px;color:#6F0E7E"></i>
                                        <input type="password" name="password" id="LPASS" class=" w-100"
                                            value="<?php if(isset($passcookie))  echo $passcookie;?>"
                                            placeholder=".........."
                                            style="border: none;border-bottom:1px solid #6F0E7E  ;padding-left: 30px;padding-bottom:6px"
                                            required>
                                    </div>
                                    <div id="Forgot"
                                        style=" width:80%;font-size: 14px;color: #6F0E7E;text-align: right;padding-top: 10px;">
                                        forgot
                                        password ?</div>
                                    <div style="width:80%;font-size: 14px;color: #6F0E7E;padding-top: 10px;">
                                        <input type="checkbox" name="remember" id="LREM"> Remember Me
                                    </div>
                                    <div style="margin-top: 15px; width:80%">
                                        <button class="btn btn-gradient-primary" name="SubmitBtn" type="submit">Log
                                            In</button>
                                    </div>
                                    <div class="separator d-flex justify-content-between"
                                        style="width:80%;margin-top: 20px;color: #6F0E7E; opacity: .9; ">
                                        <div
                                            style="border-bottom: 2px solid #6F0E7E;height:15px ; width:40% ;opacity:.7 ;">
                                        </div>
                                        OR
                                        <div
                                            style="border-bottom: 2px solid #6F0E7E;height:15px ; width:40% ;opacity:.7 ;">
                                        </div>
                                    </div>
                                    <div class="social d-flex justify-content-around"
                                        style="width: 80%;margin-top:15px">
                                        <div class="google d-flex flex-column justify-content-center align-items-center"
                                            style="color: #8B130C;font-weight: 700;"> <i
                                                class="mdi mdi-google d-flex justify-content-center align-items-center"
                                                style="width: 46px;height:45px; background:#8B130C;border-radius:10px;color:white;font-size: 24px;text-align: center;"></i>Google
                                        </div>
                                        <div class="google d-flex flex-column justify-content-center align-items-center"
                                            style="color: #1958A0;font-weight: 700;text-align: center;padding-left: 20px;">
                                            <i class="mdi mdi-facebook d-flex justify-content-center align-items-center"
                                                style="width: 46px;height:45px; background:#1958A0;border-radius:10px;color:white;font-size: 24px;text-align: center;"></i>facebook
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <div class="popup-forgotpass">
        <div class="popup">
            <i class="mdi mdi-close " id="close" aria-hidden="true"
                style="float:right ;margin:5px;margin-right:10px;font-weight: bold;cursor: pointer;"></i>
            <form action="" id="send-otp"
                style="height:100%;width: 100%;display: flex;flex-direction: column;justify-content: center;align-items: center;">
                <h2
                    style="color: rgba(0, 0, 0, .8);font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                    Forgot Password</h2>
                <br>
                <div class="input-group">
                    <i class="fa-solid fa-user"></i>
                    <input type="email" id="REMAIL" placeholder="Enter your Email"
                        value="<?php if(isset($usercookie)) echo $usercookie;?>" required>
                </div>

                <button type="submit" class="bg-gradient-primary">Send OTP</button>
            </form>


        </div>
    </div>
    <div class="popup-reset-pass">
        <div class="popup">
            <i class="mdi mdi-close " id="close" aria-hidden="true"
                style="float:right ;margin:5px;margin-right:10px;font-weight: bold;cursor: pointer;"></i>
            <form action="" id="reset-pass"
                style="height:100%;width: 100%;display: flex;flex-direction: column;justify-content: center;align-items: center;">
                <h2
                    style="color: rgba(0, 0, 0, .8);font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                    Change Password</h2>
                <br>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="text" id="NewPass" placeholder="New Password" required>
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="RePass" placeholder="Re-Type Password" required>
                </div>

                <button type="submit" class="bg-gradient-primary">Change Password</button>
            </form>


        </div>
    </div>
    <div class="popup-otp">
        <div class="popup">
            <i class="mdi mdi-close" id="close" aria-hidden="true"
                style="float:right ;margin:10px;color: rgba(0, 0, 0, .2);font-weight: bold;cursor: pointer;"></i>

            <form class="Verify-model-content" id="Verify-OTP-Form"
                style="height:100%;width:100%;display: flex;flex-direction:column;justify-content:center;align-items: center;">
                <div class="Avatar" dropzone="true">
                    <img src="./Avatar.jpg" alt="" srcset="">
                </div>
                <span
                    style="color:blueviolet;font-weight:bold;font-size:16px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;margin: 10px;">One
                    Time Password</span>

                <div class="otp center">
                    <input type="number" id="input" class="input" name="OTP" oninput="OTP_Verify()" pattern="[0-9]{6}"
                        required title="" />
                    <span class="dig center"></span>
                    <span class="dig center"></span>
                    <span class="dig center"></span>
                    <span class="dig center"></span>
                    <span class="dig center"></span>
                    <span class="dig center"></span>
                </div>
                <div class="expire">otp expire after 2:6</div>
                <button class="verify-btn" type="submit" style="background: blueviolet;">
                    Verify OTP
                </button>
            </form>
        </div>
    </div>


    <script>
    $("#Verify-OTP-Form").submit((e) => {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "./PHP/Verify_OTP.php",
            data: {
                UserOTP: $("#input").val()
            },
            success: function(response) {
                if (response == "Valid") {
                    $(".popup-reset-pass").css('display', 'flex');
                } else
                    alert(response)

            }
        });
        $(".popup-otp").css('display', 'none');


    });
    $("#reset-pass").submit((e) => {
        e.preventDefault();
        if ($("#NewPass").val() == $("#RePass").val()) {
            $.ajax({
                type: "post",
                url: "./PHP/ChangePassord.php",
                data: {
                    Pass: $("#NewPass").val(),
                    Email: $("#REMAIL").val()
                },
                success: function(response) {

                    if (response == "Password Changed...") {
                        Swal.fire(
                            'Good job!',
                            'Password Changed..',
                            'success'
                        )
                        $(".popup-reset-pass").css('display', 'none');
                    } else {
                        Swal.fire(
                            'Ohh!',
                            'Something Wen`t Wrong',
                            'error'
                        )
                    }
                }

            });
            $(".popup-reset-pass").css('display', 'none');
        } else {
            alert("Password Not Match...!!");
        }

    });
    $(document).ready(function() {
        if (screen.width <= "800") {
            $("#left").addClass('d-none');
            $("#right").removeClass('w-50');
            $("#right").css('width', "80%");
            $("h2").css("text-align", "center");
            $("#form").addClass('align-items-center');

        }


        /* popup Control*/
        /* popup Control*/
        $(".act5").click(() => {
            $(".popup-login").css('display', 'flex');
        });
        $("#close").click(() => {
            $(".popup-login").css('display', 'none');
            $(".popup-register").css('display', 'none');
            $(".popup-forgotpass").css('display', 'none');
            $(".popup-otp").css('display', 'none');
        });
        $("#new-user").click(() => {
            $(".popup-login").css('display', 'none');
            $(".popup-register").css('display', 'flex');
        })
        $("#old-user").click(() => {
            $(".popup-login").css('display', 'flex');
            $(".popup-register").css('display', 'none');
        });
        $("#Forgot").click((e) => {
            e.preventDefault();
            $(".popup-login").css('display', 'none');
            $(".popup-register").css('display', 'none');
            $(".popup-forgotpass").css('display', 'flex');
        });
        $("#send-otp").submit((e) => {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "./PHP/ChangePass.php",
                data: {
                    EMAIL: $("#REMAIL").val()
                },
                success: function(response) {
                    alert(response)
                }
            });
            $(".popup-forgotpass").css('display', 'none');
            $(".popup-otp").css('display', 'flex');



            /* OTP Expire */
            let expiretime = (new Date().getSeconds()) + 120;
            setInterval(() => {
                let curtime = new Date().getSeconds();
                if ((expiretime - curtime) > 0) {
                    $(".expire").text("OTP expire after: " + (expiretime - curtime) + "s");
                } else {
                    $(".expire").text("OTP expired...!!");
                    clearInterval();
                }

            }, 1000);
        })
    });
    </script>
    <script>
    /* OTP Verifier */
    $("#input").focus(() => {
        $(".dig").first().css({
            'border': "2px solid blueviolet"
        })

    })

    const OTP_Verify = () => {
        let Input = $("#input");
        let digit = $('.dig');
        let length = $('#input').val().length;
        let Char = Input.val().charAt(length - 1);
        if (length > 6)
            $('.input').val(Input.val().substr(0, 6));
        if (Input.val() == '') {
            digit.css('border', '1.5px solid #b7b8bc');
            digit.html('');
            digit.first().css('border', '2px solid blueviolet');

        } else {
            let digits = document.querySelectorAll('.dig');
            digits[length - 1].innerHTML = Char;


            for (let index = 0; index < digits.length; index++) {
                if (index > length - 1) {
                    digits[index].innerHTML = '';
                }
                if (index == length) {
                    digits[length].style.borderColor = "blueviolet";
                    digits[length].style.borderWidth = "2px";
                } else {
                    digits[index].style.borderColor = "#b7b8bc";
                    digits[index].style.borderWidth = "1.5px";
                }
            }
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
    <script src="./assets/js/Main.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
</body>

</html>

<?php
    echo $msg;
?>