<?php
include("conf/connection.php");
// Auth
include("conf/login-auth.php");
include("conf/admin-auth.php");

// Logics
if ($_GET["notes_id"] == "") {
    echo '<script>location.href = "notes.php"</script>';
} else {
    $notes_sql = $sql->prepare("SELECT * FROM `notes` WHERE `id` = ?");
    $notes_sql->bind_param('s', $_GET["notes_id"]);
    $notes_sql->execute();
    $notes_result = $notes_sql->get_result();
    $note = $notes_result->fetch_assoc();
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
                            <h1 class="top-bar-title font-size-medium font-weight-medium color-black">Edit Notes</h1>
                            <p class="top-bar-title-desc font-size-regular font-weight-regular color-black"><a href="notes.php">Notes</a> >> Edit Notes</p>
                        </div>
                    </div>
                </div>
                <!-- // Form >>>> -->
                <?php
                # Form handeling
                $department = $note["department_id"];
                $subject = $note['subject_id'];
                $year = $note["year_sem_id"];
                $notes = $note["notes"];
                $file = $note["notes_file"];
                if (isset($_POST["submit"])) {
                    $department = $_POST["department"];
                    $subject = $_POST['subject'];
                    $year = $_POST["year"];
                    $notes = $_POST["notes_desc"];
                    $file = $_FILES['notes_file']['name'];
                    $name_file = md5(date('Y-m-d H:i:s:u'));
                    $location = "uploads/notes/" . $name_file . $file;
                    if (file_exists($location)) {
                        $name_file = md5(date('Y-m-d H:i:s:u'));
                        $location = "uploads/notes/" . $name_file . $file;
                    }
                    # Value check
                    if (empty($department) || empty($subject) || empty($year) || empty($file)) { ?>
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
                    } else {
                                # Updating
                                $update_notes_sql = $sql->prepare("UPDATE `notes` SET `year_sem_id`= ?,`department_id`= ?,`subject_id`= ?,`notes`= ?,`notes_file`= ? WHERE `id`= ?");
                                $update_notes_sql->bind_param('ssssss', $year, $department, $subject, $notes, $location, $_GET['notes_id']);
                                $update_notes_sql->execute();
                                $update_info = $update_notes_sql->get_result();
                                if ($update_notes_sql->affected_rows > 0) {
                                    # File Upload
                                    if (!empty($_FILES['notes_file']['name'])) {
                                        move_uploaded_file($_FILES['notes_file']['tmp_name'], $location);
                                    }
                                    ?>
                                    <div class="succ-alert-box alert-box">
                                        <img src="images/succ.png" alt="Success" class="alert-box-img">
                                        <div class="alert-box-details">
                                            <h1 class="alert-box-title font-size-regular font-family-medium">Operation completed</h1>
                                            <p class="alert-box-desc font-size-regular font-family-regular color-black">Notes updated successfully.</p>
                                        </div>
                                        <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
                                        <script>
                                            // Default Hide alert
                                            setTimeout(function hideAlert() {
                                                $(".alert-box").fadeOut(1000);
                                                window.location.replace("./notes.php");
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
                ?>
                <form action="" method="POST" enctype="multipart/form-data" class="form-area">
                    <!-- --Image select-- -->
                    <div class="single-input">
                        <p class="input-label font-size-regular font-weight-regular color-black">Notes File<span class="mendatory-star">*</span></p>
                        <div class="image-input-area">
                            <div class="image-input-title-area">
                                <p class="image-input-title font-size-regular font-weight-regular color-black notes-name"><?php echo $file; ?></p>
                            </div>
                            <input type="file" name="notes_file" class="image-input" id="file-input" hidden />
                            <button type="button" class="secondary-btn image-input-btn" id="file-input-btn">Browse files</button>
                        </div>
                        <script>
                            $("#file-input-btn").click(function() {
                                $("#file-input").click();
                            });
                            $("#file-input").change(function() {
                                $(".notes-name").html($(this).get(0).files[0].name);
                            });
                        </script>
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
                        <label for="notes_title" class="input-label font-size-regular font-weight-regular color-black">Notes Comment</label>
                        <textarea name="notes_desc" id="notes_desc" placeholder="Write comment here..."><?php echo  $notes; ?></textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#notes_desc'), {
                                    ckfinder: {
                                        uploadUrl: 'plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                                    },
                                })
                                .then(editor => {
                                    window.editor = editor;
                                })
                                .catch(error => {
                                    console.error('Oops, something went wrong!');
                                    console.error(error);
                                });
                        </script>
                    </div>
                        <div class="single-input">
                            <button type="submit" name="submit" class="primary-btn form-submit-btn">Update Notes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- // Footer file >>>> -->
        <?php include("partials/footer.php"); ?>
    </body>

    </html>