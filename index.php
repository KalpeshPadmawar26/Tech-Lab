<?php
include("./conf/connection.php");
if (!isset($_SESSION)) {
    session_start();
}

// To check if user already signed in
// $_SESSION["user_id"] = 1;
if (isset($_SESSION["user_id"])) {
    include("./conf/login-auth.php");
    if ($user_data["role"] == 1 || $user_data["role"] == 2) {
        echo '<script>location.href = "./dashboard.php"</script>';
    }else{
       echo '<script>location.href = "./permission.php"</script>';
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In : Classroom Admin Panel</title>
    <!-- --Head file-- -->
    <?php include("partials/head.php"); ?>
    <script src="js/panel.js"></script>

</head>

<body>
    <?php
    $error = '';
    if (isset($_POST["sign_in"]) && isset($_POST['password']) && isset($_POST['email'])) {
        $userLogin = $_POST['switch'];

        $password = mysqli_real_escape_string($sql,$_POST['password']);
        $email = mysqli_real_escape_string($sql,$_POST['email']);

        if (isset($_POST['cf-turnstile-response']) && !empty($_POST['cf-turnstile-response'])) {
                // reCAPTCHA response verification
            $data = [
                'secret' => "0x4AAAAAAALCPVPWRafrzX8Obdd0c_MGWXc",
                'response' => $_POST["cf-turnstile-response"],
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://challenges.cloudflare.com/turnstile/v0/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                             // Decode JSON data
            $response = json_decode(curl_exec($ch),true);     

            if ($response['success']) {

                $user_check_sql = $sql->prepare("SELECT * FROM users WHERE `email` = ?");
                $user_check_sql->bind_param("s", $email);
                $user_check_sql->execute();
                $user_check_result = $user_check_sql->get_result();
                if ($user_check_result->num_rows > 0) {
                    $user_check = $user_check_result->fetch_assoc();
                    if($user_check["status"] == "1"){
                        if($user_check["role"] == $userLogin){
                            if (password_verify($password, $user_check["password"])) {
                                if($user_check["isVerified"] == "1") {
                                    $_SESSION["user_id"] = $user_check["user_id"];
                                    $_SESSION["role"] = $user_check["role"];
                                    $_SESSION["full_name"] = $user_check["full_name"];
                                    $_SESSION["user_img"] = $user_check["user_img"];
                                    echo "<script>location.href = './dashboard.php'</script>";
                                }else{
                                    $error = "Not Verified.Check email for further updates.";
                                }
                            } else {
                                $error = "Please check your password :(";
                            }
                        }else{
                            $error = "Login through provided login panel.";
                        }
                    }else{
                        $error = "You are suspended.Please contact administrator.";
                    }
                } else {
                    $error = "No user found";
                }
            }else{
                $error = "You are a spammer";
            }
        }else{
            $error = "Recaptcha Failed. Check your internet connection and try again. Ensure you complete the recaptcha challenge correctly";
        }
    }
    ?>
        <!-- // Sign in >>>> -->
        <div class="sign-in-sec">
            <div class="sign-in-logo-area"><a href="./">
                <img src="images/logo.png" alt="Logo" class="sign-in-logo"></a>
            </div>
            <div class="sign-in-area">
                <div class="sign-in-form-area">
                    <h1 class="font-size-medium font-weight-medium color-black tgpx20" style="margin-bottom: -20px;">Please Sign in to access the
                    Dashboard.</h1>
                    <form action="" method="post" enctype="multipart/form-data" class="form-area sign-in-form" id="sign-in-form">
                            <div class="wrapper">
                                <input type="radio" name="switch" id="option-1" class="student-signin-btn" value="2" checked> 
                                <input type="radio" name="switch" id="option-2" class="admin-signin-btn" value="1">
                                <label for="option-1" class="option option-1">
                                    <span>Student Login</span>
                                    </label>
                                <label for="option-2" class="option option-2">
                                    <span>Admin login</span>
                                </label>
                            </div>
                        <?php
                        if ($error != "") {
                            ?>
                            <div class="form-error-area">
                                <p class="form-err-p font-size-regular font-weight-regular" style="color: red;">Error:
                                    <?php echo $error; ?></p>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="single-input">
                                <label for="email"
                                class="input-label font-size-regular font-weight-regular color-black">Email<span class="mendatory-star">*</span></label>
                                <input type="email" name="email" class="input-field" id="email"
                                placeholder="ex@example.com" value="<?= $email ?>" required>
                            </div>
                            <div class="single-input">
                                <label for="password"
                                class="input-label font-size-regular font-weight-regular color-black">Password<span class="mendatory-star">*</span></label>
                                <input type="password" name="password" class="input-field" id="password" placeholder="XXXXXXXX"
                                value="<?= $password ?>" required>
                            </div>
                            <div class="cf-turnstile" data-sitekey="0x4AAAAAAALCPSFk8Icu1gIy" data-callback="javascriptCallback" style="transform: scale(0.8);"></div>
                            <div class="single-input" style="margin-top: -20px;">
                                <button type="submit" name="sign_in" class="primary-btn form-submit-btn">Sign In</button>
                            </div>
                            <div class="single-input" style="margin-top: -30px;margin-bottom:10px">
                                <button type="button" name="register" class="primary-btn" onclick="window.location.replace('./sign-up.php');">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- // Footer file >>>> -->
            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
            <?php include("./partials/footer.php"); ?>
        </body>

        </html>