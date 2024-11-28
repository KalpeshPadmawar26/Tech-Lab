<?php
include("conf/connection.php");
// Auth
include("conf/login-auth.php");
include("conf/admin-auth.php");

// Logics
if ($_GET["lab_id"] == "") {
    echo '<script>location.href = "lab.php"</script>';
} else {
    $lab_sql = $sql->prepare("SELECT * FROM `lab` WHERE `id` = ?");
    $lab_sql->bind_param('s', $_GET["lab_id"]);
    $lab_sql->execute();
    $lab_result = $lab_sql->get_result();
    $lab = $lab_result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lab</title>
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
                            <h1 class="top-bar-title font-size-medium font-weight-medium color-black">Edit Lab</h1>
                            <p class="top-bar-title-desc font-size-regular font-weight-regular color-black"><a href="lab.php">Lab</a> >> Edit Lab</p>
                        </div>
                    </div>
                </div>
                <!-- // Form >>>> -->
                <?php
                # Form handeling
                $department = $lab["department_id"];
                $subject = $lab['subject_id'];
                $year = $lab["year_id"];
                $startTime = $lab["start_time"];
                $endTime = $lab["end_time"]; 
                if (isset($_POST["submit"])) {
                    $department = $_POST["department"];
                    $subject = $_POST['subject'];
                    $year = $_POST["year"];
                    $startTime = $_POST["start_time"];
                    $endTime = $_POST["end_time"];

                    if (empty($department) || empty($subject) || empty($year) ||  empty($startTime) || empty($endTime)) { ?>
                        <div class="fail-alert-box alert-box">
                            <img src="images/fail.png" alt="Success" class="alert-box-img">
                            <div class="alert-box-details">
                                <h1 class="alert-box-title font-size-regular font-family-medium">Operation failed</h1>
                                <p class="alert-box-desc font-size-regular font-family-regular color-black">All * fields are mendatory.</p>
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
                    } else if($startTime >= $endTime) {
                        ?>
                        <div class="fail-alert-box alert-box">
                            <img src="images/fail.png" alt="Success" class="alert-box-img">
                            <div class="alert-box-details">
                                <h1 class="alert-box-title font-size-regular font-family-medium">Operation failed</h1>
                                <p class="alert-box-desc font-size-regular font-family-regular color-black">Start time must be less than End time.</p>
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
                        # Check if the time slot is already booked
                        $check_slot_sql = $sql->prepare("SELECT * FROM `lab` WHERE `year_id` = ? AND `department_id` = ? AND `subject_id` = ? AND `id` <> ? AND NOT (? >= `end_time` OR ? <= `start_time`)");
                        $check_slot_sql->bind_param('ssssss', $year, $department, $subject, $_GET['lab_id'], $startTime, $endTime);
                        $check_slot_sql->execute();
                        $result = $check_slot_sql->get_result();

                        if ($result->num_rows > 0) {
                            # Display error message for overlapping time slots
                            ?>
                            <div class="fail-alert-box alert-box">
                                <img src="images/fail.png" alt="Failure" class="alert-box-img">
                                <div class="alert-box-details">
                                    <h1 class="alert-box-title font-size-regular font-family-medium">Operation failed</h1>
                                    <p class="alert-box-desc font-size-regular font-family-regular color-black">The time slot is already booked.</p>
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
                            # Updating
                            $update_lab_sql = $sql->prepare("UPDATE `lab` SET `department_id`= ?,`year_id`= ?,`subject_id`= ?,`start_time`= ?,`end_time`= ? WHERE `id`= ?");
                            $update_lab_sql->bind_param('ssssss', $department, $year, $subject, $startTime, $endTime, $_GET['lab_id']);
                            $update_lab_sql->execute();
                            $update_info = $update_lab_sql->get_result();
                            if ($update_lab_sql->affected_rows > 0) {
                                ?>
                                <div class="succ-alert-box alert-box">
                                    <img src="images/succ.png" alt="Success" class="alert-box-img">
                                    <div class="alert-box-details">
                                        <h1 class="alert-box-title font-size-regular font-family-medium">Operation completed</h1>
                                        <p class="alert-box-desc font-size-regular font-family-regular color-black">Lab upadated successfully.</p>
                                    </div>
                                    <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
                                    <script>
                                        // Default Hide alert
                                        setTimeout(function hideAlert() {
                                            $(".alert-box").fadeOut(1000);
                                            window.location.replace('./lab.php');
                                        }, 1000);
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
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data" class="form-area">                  
                            
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
    
                            <div class="single-input">
                                <p class="font-size-regular font-weight-regular color-black">Subject<span class="mendatory-star">*</span></p>
                                <?php
                                $subject_sql = $sql->prepare("SELECT * FROM `subject`");
                                $subject_sql->execute();
                                $subject_result = $subject_sql->get_result();
                                ?>
                                <select name="subject" id="subject" class="select-box subject-select-box" style="width: 100%;">
                                    <option></option>
                                    <?php
                                    while ($subject_data = $subject_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $subject_data["id"]; ?>" <?php echo ($subject == $subject_data["id"])?"selected":"" ?>>
                                            <?php echo $subject_data["s_name"]; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <script>
                                    $('.subject-select-box').select2({
                                        placeholder: "Select a subject",
                                        allowClear: true,
                                        searchInputPlaceholder: 'Search subject'
                                    });
                                </script>
                            </div>
    
                            <div class="single-input">
                                <p class="font-size-regular font-weight-regular color-black">Start Time<span class="mendatory-star">*</span></p>
                                <?php
                                $time_slot_arr = array("10.00","11.00","12.00","13.00","14.00","15.00","16.00","17.00","18.00");
                                ?>
                                <select name="start_time" id="start_time" class="select-box start-time-select-box" style="width: 100%;">
                                    <option></option>
                                    <?php
                                    foreach ($time_slot_arr as $index => $start_time) {
                                        ?>
                                        <option value="<?php echo $start_time; ?>" <?php echo ($startTime == $start_time)?"selected":"" ?>>
                                            <?php echo $start_time; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <script>
                                    $('.start-time-select-box').select2({
                                        placeholder: "Select a time slot",
                                        allowClear: true,
                                        searchInputPlaceholder: 'Search slot'
                                    });
                                </script>
                            </div>
    
                            <div class="single-input">
                                <p class="font-size-regular font-weight-regular color-black">End Time<span class="mendatory-star">*</span></p>
                                <select name="end_time" id="end_time" class="select-box end-time-select-box" style="width: 100%;">
                                    <option></option>
                                    <?php
                                    foreach ($time_slot_arr as $index => $end_time) {
                                        ?>
                                        <option value="<?php echo $end_time; ?>" <?php echo ($endTime == $end_time)?"selected":"" ?>>
                                            <?php echo $end_time; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <script>
                                    $('.end-time-select-box').select2({
                                        placeholder: "Select a time slot",
                                        allowClear: true,
                                        searchInputPlaceholder: 'Search slot'
                                    });
                                </script>
                            </div>
    
                            <div class="single-input">
                                <button type="submit" name="submit" class="primary-btn form-submit-btn">Update Lab</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <!-- // Footer file >>>> -->
        <?php include("partials/footer.php"); ?>
    </body>

    </html>