<?php
include("./conf/connection.php");
if (!isset($_SESSION)) {
    session_start();
}

// To check if user already signed in
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
    <script src="js/select2.js"></script>

</head>

<body style="overflow:hidden">
    <?php
    $error = '';

    // Function to generate a random 8-digit numeric enrollment ID
    function generateEnrollmentID() {
        return mt_rand(11111111, 99999999); // generates a random 8-digit number
    }
    if (isset($_POST["sign_up"]) && isset($_POST['fname']) && isset($_POST['mname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['otp']) && isset($_POST['dob']) && isset($_POST['mobile']) && isset($_POST['gender']) && isset($_POST['prn']) && isset($_POST['department']) && isset($_POST['year']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $otp = $_POST['otp'];
        $dob = $_POST['dob'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $prn = $_POST['prn'];
        $department = $_POST['department'];
        $year = $_POST['year'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $emailVerified = 0;
        // Create DateTime object from the provided date of birth
        $dobDateTime = DateTime::createFromFormat('Y-m-d', $dob);

        // Define the allowed date range
        $minDate = new DateTime('1995-01-01');
        $maxDate = new DateTime('2005-12-31');

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
                    $error = "Email Already Exist";
                } else {
                    $stmt = $sql->prepare("SELECT * FROM otp 
                        WHERE email = ? AND otp = ? 
                        AND id = (SELECT MAX(id) FROM otp WHERE email = ?)");
                    $stmt->bind_param("sss", $email, $otp, $email);
                    $stmt->execute();
                    $otp_check_result = $stmt->get_result();

                    if($otp_check_result->num_rows>0){
                        if($dobDateTime >= $minDate && $dobDateTime <= $maxDate){
                            if($password == $cpassword){
                                $password = password_hash($password, PASSWORD_BCRYPT);
                                $emailVerified = 1;
                                // Generate an initial enrollment ID
                                $enrollment = generateEnrollmentID();

                                // Check if the enrollment ID already exists in the users table
                                $enrollment_id_check_sql = $sql->prepare("SELECT user_id FROM users WHERE enrollment_id = ?");
                                $enrollment_id_check_sql->bind_param('i', $enrollment_id);

                                // Loop until a unique enrollment ID is generated
                                while (true) {
                                    $enrollment_id_check_sql->execute();
                                    $enrollment_id_check_result = $enrollment_id_check_sql->get_result();

                                    if ($enrollment_id_check_result->num_rows == 0) {
                                        // The enrollment ID is unique, break the loop
                                        break;
                                    } else {
                                        // Regenerate a new enrollment ID if it already exists
                                        $enrollment = generateEnrollmentID();
                                        $enrollment_id_check_sql->bind_param('i', $enrollment_id);
                                    }
                                }

                                $user_insert_sql = $sql->prepare("INSERT INTO `users`(`f_name`, `m_name`, `l_name`, `dob`, `gender`, `mobile`, `email`, `emailVerified`, `dept_id`, `year_id`, `enrollment_id`, `PRN`, `password`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                $user_insert_sql->bind_param("sssssssssssss", $fname,$mname,$lname,$dob,$gender,$mobile,$email,$emailVerified,$department,$year,$enrollment,$prn,$password);
                                if($user_insert_sql->execute()){
                                    ?>
                                    <script type="text/javascript">
                                        alert('Account created successfully.');
                                        window.location.replace('./');
                                    </script>
                                    <?php
                                }

                            }else{
                                $error = 'Password do not match';
                            }
                        }else{
                            $error = 'Invalid date of birth. Must be between 1/1/1995 and 1/1/2005';
                        }
                    }else{
                        $error = "Enter Valid OTP";
                    }
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
                <div class="sign-in-form-area" style="max-height:500px;overflow-y:scroll">
                    <h1 class="font-size-medium font-weight-medium color-black tgpx20" style="margin-bottom: -20px;">Please Sign in to access the
                    Dashboard.</h1>
                    <form action="#" method="post" enctype="multipart/form-data" class="form-area sign-in-form" id="sign-in-form">
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
                                <label for="fname" class="input-label font-size-regular font-weight-regular color-black">First Name<span class="mendatory-star">*</span></label>
                                <input type="text" name="fname" class="input-field" id="fname" placeholder="First Name" value="<?= $fname ?>" required>
                            </div>
                            <div class="single-input">
                                <label for="mname" class="input-label font-size-regular font-weight-regular color-black">Middle Name<span class="mendatory-star">*</span></label>
                                <input type="text" name="mname" class="input-field" id="mname" placeholder="Middle Name" value="<?= $mname ?>" required>
                            </div>
                            <div class="single-input">
                                <label for="lname" class="input-label font-size-regular font-weight-regular color-black">Last Name<span class="mendatory-star">*</span></label>
                                <input type="text" name="lname" class="input-field" id="lname" placeholder="Last Name" value="<?= $lname ?>" required>
                            </div>
                            <div class="single-input">
                                <label for="email" class="input-label font-size-regular font-weight-regular color-black">Email<span class="mendatory-star">*</span></label>
                                <input type="email" name="email" class="input-field" id="email" placeholder="Email" value="<?= $email ?>" required>
                            </div>
                            <div class="dual-input">
                                <div class="single-input">
                                    <button type="button" name="sendotp" class="secondary-btn otp-btn" style="display: flex;justify-content:center;gap:10px;">Send OTP</button>
                                </div>
                                <div class="single-input">
                                    <input type="number" name="otp" class="input-field" id="otp" placeholder="Enter Otp" value="<?= $otp ?>" required>
                                </div>
                            </div>
                            <div class="dual-input">
                                <div class="single-input">
                                    <label for="dob" class="input-label font-size-regular font-weight-regular color-black">Date of Birth<span class="mendatory-star">*</span></label>
                                    <input type="date" name="dob" class="input-field" id="dob" value="<?= $dob ?>"  required>
                                </div>
                                <div class="single-input">
                                    <label for="mobile" class="input-label font-size-regular font-weight-regular color-black">Mobile Number<span class="mendatory-star">*</span></label>
                                    <input type="tel" name="mobile" class="input-field" id="mobile" placeholder="Enter Mobile Number" value="<?= $mobile ?>"  required>
                                </div>
                            </div>

                            <div class="dual-input">
                                <div class="single-input">
                                    <p class="font-size-regular font-weight-regular color-black">Gender<span class="mendatory-star">*</span></p>
                                    <?php
                                    $gender_sql = $sql->prepare("SELECT * FROM `gender`");
                                    $gender_sql->execute();
                                    $gender_result = $gender_sql->get_result();
                                    ?>
                                    <select name="gender" id="gender" class="select-box gender-select-box" style="width: 100%;">
                                        <option></option>
                                        <?php
                                        while ($gender_data = $gender_result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $gender_data["id"]; ?>" <?php echo ($gender == $gender_data["id"])?"selected":"" ?>>
                                                <?php echo $gender_data["g_name"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <script>
                                        $('.gender-select-box').select2({
                                            placeholder: "Select a gender",
                                            allowClear: true,
                                            searchInputPlaceholder: 'Search gender'
                                        });
                                    </script>
                                </div>
                                <div class="single-input">
                                    <label for="prn" class="input-label font-size-regular font-weight-regular color-black">PRN Number<span class="mendatory-star">*</span></label>
                                    <input type="text" name="prn" class="input-field" id="prn" placeholder="72191212X" value="<?php echo $prn; ?>">
                                </div>
                            </div>
                            <div class="dual-input">
                                <div class="single-input">
                                    <p class="font-size-regular font-weight-regular color-black">Department<span class="mendatory-star">*</span></p>
                                    <?php
                                    $department_sql = $sql->prepare("SELECT * FROM `department`");
                                    $department_sql->execute();
                                    $department_result = $department_sql->get_result();
                                    ?>
                                    <select name="department" id="department" class="select-box department-select-box" style="width: 100%;">
                                        <option></option>
                                        <?php
                                        while ($department_data = $department_result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $department_data["id"]; ?>" <?php echo ($department == $department_data["id"])?"selected":"" ?>>
                                                <?php echo $department_data["d_name"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <script>
                                        $('.department-select-box').select2({
                                            placeholder: "Select a department",
                                            allowClear: true,
                                            searchInputPlaceholder: 'Search department'
                                        });
                                    </script>
                                </div>

                                <div class="single-input">
                                    <p class="font-size-regular font-weight-regular color-black">Year<span class="mendatory-star">*</span></p>
                                    <?php
                                    $year_sql = $sql->prepare("SELECT * FROM `year`");
                                    $year_sql->execute();
                                    $year_result = $year_sql->get_result();
                                    ?>
                                    <select name="year" id="year" class="select-box year-select-box" style="width: 100%;">
                                        <option></option>
                                        <?php
                                        while ($year_data = $year_result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $year_data["id"]; ?>" <?php echo ($year == $year_data["id"])?"selected":"" ?>>
                                                <?php echo "Year ".$year_data["year"]." / Sem ".$year_data["semester"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <script>
                                        $('.year-select-box').select2({
                                            placeholder: "Select an year",
                                            allowClear: true,
                                            searchInputPlaceholder: 'Search year'
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="single-input">
                                <label for="password" class="input-label font-size-regular font-weight-regular color-black">Password<span class="mendatory-star">*</span></label>
                                <input type="password" name="password" class="input-field" id="password" placeholder="XXXXXXXX" value="<?= $cpassword ?>" required>
                            </div>
                            <div class="single-input">
                                <label for="cpassword" class="input-label font-size-regular font-weight-regular color-black">Confirm Password<span class="mendatory-star">*</span></label>
                                <input type="password" name="cpassword" class="input-field" id="cpassword" placeholder="XXXXXXXX" value="<?= $cpassword ?>" required>
                            </div>
                            <div class="cf-turnstile" data-sitekey="0x4AAAAAAALCPSFk8Icu1gIy" data-callback="javascriptCallback" style="transform: scale(0.8);"></div>
                            <div class="single-input" style="margin-top: -20px;">
                                <button type="submit" name="sign_up" class="primary-btn form-submit-btn">Sign Up</button>
                            </div>
                            <div class="single-input" style="margin-top: -30px;margin-bottom:10px">
                                <button type="button" name="login" class="primary-btn" onclick="window.location.replace('./')">Login</button>
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