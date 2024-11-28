<?php
include("conf/connection.php");
// Auth
include("conf/login-auth.php");
include("conf/admin-auth.php");

// Logics
if ($_GET["user_id"] == "") {
    echo '<script>location.href = "user.php"</script>';
} else {
    $user_sql = $sql->prepare("SELECT * FROM `users` WHERE `user_id` = ?");
    $user_sql->bind_param('s', $_GET["user_id"]);
    $user_sql->execute();
    $user_result = $user_sql->get_result();
    $user = $user_result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- // Head file >>>>> -->
    <?php include("partials/head.php"); ?>
    <script src="js/select2.js"></script>
</head>

<body>
    <div class="main-sec">
        <!-- // Sidebar file >>>> -->
        <?php include("partials/sidebar.php"); ?>
        <!-- // Content >>>> -->
        <div class="content-sec">
            <!-- --Sidebar toggle-- -->
            <img src="images/caret-right-fill.svg" alt="sidebar-menu-btn" class="sidebar-menu-btn">
            <!-- --content area-- -->
            <div class="content-area">
                <!-- // Alert area >>>> -->
                <div class="alert-area">
                    <!-- --Alerts will be here-- -->
                </div>
                <!-- // Top bar >>>> -->
                <div class="top-bar">
                    <div class="top-bar-area">
                        <div class="top-bar-title-area">
                            <h1 class="top-bar-title font-size-medium font-weight-medium color-black">Edit User</h1>
                            <p class="top-bar-title-desc font-size-regular font-weight-regular color-black"><a href="user.php">Users</a> >> Edit User</p>
                        </div>
                    </div>
                </div>
                <!-- // Form >>>> -->
                <?php
                # Check for current user
                if ($_GET["user_id"] == $_SESSION["user_id"]) {
                    ?>
                    <div class="form-error-area">
                        <p class="form-err-p font-size-regular font-weight-medium input-label" style="color: red;">Changes on the sidebar for user details will be visible after refreshing the page.</p>
                    </div>
                    <?php
                }
                ?>
                <?php
                # Form handeling
                $location2 = $user["user_img"];
                if (isset($_POST["submit"])) {
                    $fname = $_POST["fname"];
                    $mname = $_POST["mname"];
                    $lname = $_POST["lname"];
                    $dob = $_POST["dob"];
                    $gender = $_POST["gender"];
                    $email = $_POST["email"];
                    $mobile = $_POST["mobile"];
                    $department = $_POST["department"];
                    $year = $_POST["year"];
                    $prn = $_POST['prn'];
                    $status = (isset($_POST['status']))?($_POST['status']):"1";  
                    $role = $_POST["role"];
                    $password = $_POST["password"];
                    $c_password = $_POST["c_password"];                   
                    # Value check
                    if (empty($prn) || empty($fname) || empty($mname) || empty($lname) || empty($dob) || empty($gender) || empty($email) || empty($mobile) || empty($department) || empty($year) || empty($role)) { ?>
                        <div class="fail-alert-box alert-box">
                            <img src="images/fail.png" alt="Failed" class="alert-box-img">
                            <div class="alert-box-details">
                                <h1 class="alert-box-title font-size-regular font-family-medium">Operation failed</h1>
                                <p class="alert-box-desc font-size-regular font-family-regular color-black">All * fields are required.</p>
                            </div>
                            <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
                            <script>
                                // Default Hide alert
                                setTimeout(function hideAlert() {
                                    $(".alert-box").fadeOut(1000);
                                }, 10000);
                                // Click hide alert
                                $(".alert-box-close-img").click(function() {
                                    $(this).parent(".alert-box").fadeOut(400);
                                })
                            </script>
                        </div>
                        <?php
                    } else {
                        if ($password == $c_password) {
                            #password hash
                            $password = password_hash($password, PASSWORD_BCRYPT);
                            # File handeling
                            $location;
                            if (empty($_FILES['image']['name'])) {
                                $location =  $location2;
                            } else {
                                $filename = $_FILES['image']['name'];
                                $name_file = md5(date('Y-m-d H:i:s:u'));
                                $location = "uploads/images/" . $name_file . $filename;
                                if (file_exists($location)) {
                                    $name_file = md5(date('Y-m-d H:i:s:u'));
                                    $location = "uploads/images/" . $name_file . $filename;
                                }
                            }
                            # File Upload function
                            function compressImage($source, $destination, $quality)
                            {
                                $info = getimagesize($source);
                                if ($info['mime'] == 'image/jpeg')
                                    $image = imagecreatefromjpeg($source);
                                elseif ($info['mime'] == 'image/gif')
                                    $image = imagecreatefromgif($source);
                                elseif ($info['mime'] == 'image/png')
                                    $image = imagecreatefrompng($source);
                                imagejpeg($image, $destination, $quality);
                            }
                            # Email check
                            $email_check_sql = $sql->prepare("SELECT user_id FROM users WHERE email = ? AND user_id != ?");
                            $email_check_sql->bind_param('ss', $email, $_GET["user_id"]);
                            $email_check_sql->execute();
                            $email_check_result = $email_check_sql->get_result();
                            if ($email_check_result->num_rows > 0) {
                                ?>
                                <div class="fail-alert-box alert-box">
                                    <img src="images/fail.png" alt="Success" class="alert-box-img">
                                    <div class="alert-box-details">
                                        <h1 class="alert-box-title font-size-regular font-family-medium">Operation failed</h1>
                                        <p class="alert-box-desc font-size-regular font-family-regular color-black"> Email already exists.</p>
                                    </div>
                                    <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
                                    <script>
                                        // Default Hide alert
                                        setTimeout(function hideAlert() {
                                            $(".alert-box").fadeOut(1000);
                                        }, 10000);
                                        // Click hide alert
                                        $(".alert-box-close-img").click(function() {
                                            $(this).parent(".alert-box").fadeOut(400);
                                        })
                                    </script>
                                </div>
                            <?php } else {
                                    # Inserting
                                if ($_POST["password"] == '') {
                                    $update_info_sql = $sql->prepare("UPDATE `users` SET 
                                    `f_name`=?, `m_name`=?, `l_name`=?, `user_img`=?, `dob`=?, `gender`=?, `mobile`=?, 
                                    `email`=?, `dept_id`=?, `PRN`=?, `year_id`=?, `status`=?, 
                                    `role`=? WHERE `user_id` = ?");

                                    $update_info_sql->bind_param('sssssssssssssi', $fname, $mname, $lname, $location, $dob, $gender, $mobile, $email, $department, $prn, $year, $status, $role,$_GET["user_id"]);
                                } else {
                                    $update_info_sql = $sql->prepare("UPDATE `users` SET 
                                        `f_name`=?, `m_name`=?, `l_name`=?, `user_img`=?, `dob`=?, `gender`=?, `mobile`=?, 
                                        `email`=?, `dept_id`=?, `PRN`=?, `year_id`=?, `password`=?, `status`=?, 
                                        `role`=? WHERE `user_id` = ?");

                                    $update_info_sql->bind_param('ssssssssssssssi', $fname, $mname, $lname, $location, $dob, $gender, $mobile, $email, $department, $prn, $year, $password, $status, $role,$_GET["user_id"]);
                                }
                                $update_info_sql->execute();
                                $update_info = $update_info_sql->get_result();
                                if ($update_info_sql->affected_rows > 0) {
                                        # File upload
                                    if (!empty($_FILES['image']['name'])) {
                                        move_uploaded_file($_FILES['image']['tmp_name'], $location);
                                        $location2 = $location;
                                    }
                                    ?>
                                    <div class="succ-alert-box alert-box">
                                        <img src="images/succ.png" alt="Success" class="alert-box-img">
                                        <div class="alert-box-details">
                                            <h1 class="alert-box-title font-size-regular font-family-medium">Operation completed</h1>
                                            <p class="alert-box-desc font-size-regular font-family-regular color-black">User updated successfully.</p>
                                        </div>
                                        <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
                                        <script>
                                                // Default Hide alert
                                                setTimeout(function hideAlert() {
                                                    $(".alert-box").fadeOut(1000);
                                                    window.location.replace("./user.php");
                                                }, 1000);
                                                // Click hide alert
                                                $(".alert-box-close-img").click(function() {
                                                    $(this).parent(".alert-box").fadeOut(400);
                                                })
                                                // Delete row
                                            </script>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <div class="fail-alert-box alert-box">
                                    <img src="images/fail.png" alt="Success" class="alert-box-img">
                                    <div class="alert-box-details">
                                        <h1 class="alert-box-title font-size-regular font-family-medium">Operation Failed</h1>
                                        <p class="alert-box-desc font-size-regular font-family-regular color-black"> Password and confirm password should be same.</p>
                                    </div>
                                    <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
                                    <script>
                                    // Default Hide alert
                                    setTimeout(function hideAlert() {
                                        $(".alert-box").fadeOut(1000);
                                    }, 10000);
                                    // Click hide alert
                                    $(".alert-box-close-img").click(function() {
                                        $(this).parent(".alert-box").fadeOut(400);
                                    })
                                </script>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data" class="form-area">
                    <!-- --Image select-- -->
                    <div class="single-input">
                        <p class="input-label font-size-regular font-weight-regular color-black">Profile picture <span class="font-size-regular font-weight-regular color-light-black">(Optional)</span></p>
                        <div class="image-input-area">
                            <div class="image-input-preview-img-area">
                                <img src="<?php echo $location2; ?>" alt="Image" class="image-input-preview-img" id="image-input-preview-img">
                            </div>
                            <div class="image-input-title-area">
                                <p class="image-input-title font-size-regular font-weight-regular color-black">Upload a profile picture.</p>
                            </div>
                            <input type="file" name="image" class="image-input" id="image-input" accept="image/png, image/gif, image/jpeg, .svg" hidden />
                            <button type="button" class="secondary-btn image-input-btn" id="image-input-btn">Browse files</button>
                        </div>
                        <script>
                            $("#image-input-btn").click(function() {
                                $("#image-input").click();
                            });
                            $("#image-input").change(function() {
                                var image = $(this).get(0).files[0];
                                if (image) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        $("#image-input-preview-img").attr("src", reader.result);
                                    }
                                    reader.readAsDataURL(image);
                                }
                            });
                        </script>
                    </div>
                    <div class="dual-input">
                            <div class="single-input">
                                <label for="fname" class="input-label font-size-regular font-weight-regular color-black">First Name<span class="mendatory-star">*</span></label>
                                <input type="text" name="fname" class="input-field" id="fname" placeholder="Vivek" value="<?php echo $user['f_name']; ?>">
                            </div>
                            <div class="single-input">
                                <label for="mname" class="input-label font-size-regular font-weight-regular color-black">Middle Name<span class="mendatory-star">*</span></label>
                                <input type="text" name="mname" class="input-field" id="mname" placeholder="Janardan" value="<?php echo $user['m_name']; ?>">
                            </div>
                        </div>
                        <div class="dual-input">
                            <div class="single-input">
                                <label for="lname" class="input-label font-size-regular font-weight-regular color-black">Last Name<span class="mendatory-star">*</span></label>
                                <input type="text" name="lname" class="input-field" id="lname" placeholder="Mahajan" value="<?php echo $user['l_name']; ?>">
                            </div>
                            <div class="single-input">
                                <label for="email" class="input-label font-size-regular font-weight-regular color-black">Email<span class="mendatory-star">*</span></label>
                                <input type="email" name="email" class="input-field" id="email" placeholder="ex@example.com" value="<?php echo $user['email']; ?>">
                            </div>
                        </div>
                        <div class="dual-input">
                            <div class="single-input">
                                <label for="mobile" class="input-label font-size-regular font-weight-regular color-black">Mobile<span class="mendatory-star">*</span></label>
                                <input type="number" name="mobile" class="input-field" id="mobile" placeholder="1234567890" value="<?php echo $user['mobile']; ?>">
                            </div>
                            <div class="single-input">
                                <label for="dob" class="input-label font-size-regular font-weight-regular color-black">Date of Birth<span class="mendatory-star">*</span></label>
                                <input type="text" name="dob" class="input-field" id="dob" placeholder="DD/MM/YYYY" value="<?php echo $user['dob']; ?>">
                            </div>
                        </div>
                        <div class="single-input">
                            <label for="enrollment" class="input-label font-size-regular font-weight-regular color-black">Enrollment Id</label>
                            <div class="checkbox-input checkbox-input-white">
                            <p class="font-size-regular font-weight-regular color-light-black"><?php echo $user['enrollment_id']; ?></p>
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
                                        <option value="<?php echo $gender_data["id"]; ?>" <?php echo ($user['gender'] == $gender_data["id"])?"selected":"" ?>>
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
                                <input type="text" name="prn" class="input-field" id="prn" placeholder="72191212X" value="<?php echo $user['PRN']; ?>">
                            </div>
                        </div>
                        
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
                                    <option value="<?php echo $department_data["id"]; ?>" <?php echo ($user['dept_id'] == $department_data["id"])?"selected":"" ?>>
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
                                    <option value="<?php echo $year_data["id"]; ?>" <?php echo ($user['year_id'] == $year_data["id"])?"selected":"" ?>>
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

                        <div class="single-input">
                            <p class="input-label font-size-regular font-weight-regular color-black">Status</p>
                            <div class="checkbox-input checkbox-input-white">
                                <?php
                                    # To prevent blocking self
                                if ($_GET["user_id"] == $_SESSION["user_id"]) {
                                    ?>
                                    <p class="font-size-regular font-weight-regular color-light-black">You can't block yourself.</p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="font-size-regular font-weight-regular color-black">Active</p>
                                    <div class="checkbox-toggle">
                                        <input type="hidden" name="status" value="0" hidden>
                                        <input name="status" type="checkbox" value="1" id="status" <?php if ($user['status'] == 1) {
                                            echo "checked";
                                        } ?> />
                                        <label class="checkbox-label" for="status">Toggle</label>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="single-input">
                            <p class="font-size-regular font-weight-regular color-black">Role<span class="mendatory-star">*</span></p>
                            <?php
                            $role_sql = $sql->prepare("SELECT * FROM `roles`");
                            $role_sql->execute();
                            $role_result = $role_sql->get_result();
                            ?>
                            <select name="role" id="role" class="select-box role-select-box" style="width: 100%;">
                                <option></option>
                                <?php
                                while ($role_data = $role_result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $role_data["id"]; ?>" <?php echo ($user['role'] == $role_data["id"])?"selected":"" ?>>
                                        <?php echo $role_data["role_name"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <script>
                                $('.role-select-box').select2({
                                    placeholder: "Select a role",
                                    allowClear: true,
                                    searchInputPlaceholder: 'Search role'
                                });
                            </script>
                        </div>
                        <div class="dual-input">
                            <div class="single-input">
                                <label for="password" class="input-label font-size-regular font-weight-regular color-black">Password</label>
                                <input type="password" name="password" class="input-field" id="password" placeholder="XXXXXX">
                            </div>
                            <div class="single-input">
                                <label for="c_password" class="input-label font-size-regular font-weight-regular color-black">Confirm password</label>
                                <input type="password" name="c_password" class="input-field" id="c_password" placeholder="XXXXXX">
                            </div>
                        </div>
                        <div class="single-input">
                            <button type="submit" name="submit" class="primary-btn form-submit-btn">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- // Footer file >>>> -->
        <?php include("partials/footer.php"); ?>
    </body>

    </html>