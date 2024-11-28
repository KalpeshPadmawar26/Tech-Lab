<!-- // Sidebar >>>> -->
<div class="sidebar-sec">
    <div class="sidebar-area">
        <!-- --Sidebar logo-- -->
        <div class="sidebar-logo-area">
            <img src="images/logo.png" alt="Logo" class="sidebar-logo-img">
            <!-- <h1>Zip Cruise Tours</h1> -->
        </div>
        <!-- --Sidebar link-- -->
        <div class="sidebar-link-area">
            <div class="sidebar-action">
                <a href="./" class="sidebar-user-area">
                    <img src="<?php echo $user_data["user_img"]; ?>" alt="Image" class="sidebar-user-img">
                    <p class="font-size-regular font-weight-regular color-black">
                        <?php echo "Hello ". $user_data["f_name"]; ?></p>
                </a>
            </div>
            <?php
            if ($user_data["role"] == 1) {
            ?>
                <ul class="sidebar-link-ul">
                    <li class="sidebar-link-box">
                        <a href="dashboard.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "dashboard") !== false) {
                                                                                    echo 'sidebar-link-box-item-active';
                                                                                } ?>">
                            <img src="images/dashboard-line.svg" alt="Dashboard" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Dashboard</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="user.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "user") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/people.svg" alt="User" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Users</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="notes.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "notes") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/notes.svg" alt="Notes" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Notes</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="lab.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "lab") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/lab.svg" alt="Lab" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Lab Setup</p>
                        </a>
                    </li>

                    <li class="sidebar-link-box">
                        <a href="reports.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "reports") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/report.svg" alt="Report" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Reports</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="log-out.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "log-out") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/log-out.svg" alt="Log Out" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-bold color-danger">Log Out</p>
                        </a>
                    </li>
                </ul>
            <?php
            } elseif ($user_data["role"] == 2) {
            ?>
                <ul class="sidebar-link-ul">
                    <li class="sidebar-link-box">
                        <a href="dashboard.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "dashboard") !== false) {
                                                                                    echo 'sidebar-link-box-item-active';
                                                                                } ?>">
                            <img src="images/dashboard-line.svg" alt="Dashboard" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Dashboard</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="user-student.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "user-student") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/people.svg" alt="User" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Profile</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="notes-student.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "notes-student") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/notes.svg" alt="Notes" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Notes</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="lab-student.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "lab-student") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/lab.svg" alt="Lab" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Lab Attendance</p>
                        </a>
                    </li>

                    <li class="sidebar-link-box">
                        <a href="reports.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "reports") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/report.svg" alt="Report" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-regular color-black">Reports</p>
                        </a>
                    </li>
                    <li class="sidebar-link-box">
                        <a href="log-out.php" class="sidebar-link-box-item <?php if (strpos($_SERVER['SCRIPT_NAME'], "log-out") !== false) {
                                                                            echo 'sidebar-link-box-item-active';
                                                                        } ?>">
                            <img src="images/log-out.svg" alt="Log Out" class="sidebar-link-img">
                            <p class="sidebar-link-p font-size-regular font-weight-bold color-danger">Log Out</p>
                        </a>
                    </li>
                </ul>
            <?php
            }
            ?>
        </div>
        <!-- --Sidebar Actions-- -->
        <div class="sidebar-action-area">
            
            <h1 class="font-size-regular font-weight-regular color-black" style="margin-top: 10px;">Project by <br> <a href="./team.html" target="_blank">SKNCOE BE GROUP 93</a>
        </div>
    </div>
</div>