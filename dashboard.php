<?php
// Auth
include("conf/connection.php");
include("conf/login-auth.php");
include("conf/support-auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Lab - Dashboard</title>
    <!-- // Head file >>>>> -->
    <?php include("partials/head.php"); ?>
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
                            <h1 class="top-bar-title font-size-medium font-weight-medium color-black">Dashboard</h1>
                            <p class="top-bar-title-desc font-size-regular font-weight-regular color-light-black">Welcome to Tech-Lab Dashboard</p>
                        </div>
                    </div>
                </div>
                <!-- // Dashboard >>>> -->
                <div class="dashboard-number-box-area">
                    <?php if($user_data["role"] == 1){ ?>
                        <div class="dashboard-number-box">
                            <div id="attendanceContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                        <div class="dashboard-number-box">
                            <div id="notesContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                        <div class="dashboard-number-box">
                            <div id="studentsContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    <?php }else if($user_data["role"] == 2){ ?>
                        <div class="dashboard-number-box">
                            <div id="studentAttendanceContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                        <div class="dashboard-number-box">
                            <div id="studentNotesContainer" style="height: 300px; width: 100%;"></div>
                        </div>
<!--                         <div class="dashboard-number-box">
                            <div id="studentsContainer" style="height: 300px; width: 100%;"></div>
                        </div> -->
                    <?php } ?>
                </div>
                <!-- // Contact form >>>> -->
                <!-- // Table >>>> -->
                <?php if($user_data["role"] == 1){ ?>
                    <h1 class="font-size-medium font-weight-medium color-black" style="margin-top: 50px;">Today's Entries</h1>
                <?php }else if($user_data["role"] == 2){ ?> 
                    <h1 class="font-size-medium font-weight-medium color-black" style="margin-top: 50px;">Your Test</h1>
                <?php } ?>
                <div class="table-area responsive">
                    <table class="tgpx20">
                        <thead>
                            <?php if($user_data["role"] == 1){ ?>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>IP</th>
                                    <th>In Time</th> 
                                    <th>Out Time</th>
                                    <th>Total Time</th>
                                    <th>Attendance Marked</th>
                                    <th>Action</th>
                                </tr>
                            <?php }else if($user_data["role"] == 2){ ?>
                                <tr>
                                    <th>ID</th>
                                    <th>Year</th>
                                    <th>Department</th>
                                    <th>Subject</th>
                                    <th>Total Marks</th>
                                    <th>Achived Marks</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            <?php } ?>
                        </thead>
                        <?php if($user_data["role"] == 1){ ?>
                            <tbody id="entries-form-table-data-body"></tbody>
                        <?php }else if($user_data["role"] == 2){ ?>
                            <tbody id="student-entries-form-table-data-body"></tbody>
                        <?php } ?>
                    </table>
                </div>
                <!-- // Load more >>>> -->
                <div class="loading-sec">
                    <?php if($user_data["role"] == 1){ ?>
                        <button class="secondary-btn loading-btn" id="entries-form-loading-btn">Load more</button>
                        <div class="loading loading" id="entries-form-loading" style="display: none;">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    <?php }else if($user_data["role"] == 2){ ?>
                        <button class="secondary-btn loading-btn" id="student-entries-form-loading-btn">Coming Soon...</button>
                        <div class="loading loading" id="student-entries-form-loading" style="display: none;">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- // Footer file >>>> -->
    <?php include("partials/footer.php"); ?>
    <script>
        $("#entries-form-loading-btn").click();
        var attendanceOptions = {
            subtitles: [{
                text: "Today's Attendance"
            }],
            animationEnabled: true,
            data: [{
                type: "pie",
                startAngle: 270,
                toolTipContent: "<b>{label}</b>: {y}",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 13,
                indexLabel: "{label} - {y}",
                dataPoints: [
                { y: 100, label: "Attended Students"},
                { y: 20, label: "Absent Students", exploded: true },
                ]
            }]
        };
        var notesOptions = {
            subtitles: [{
                text: "Notes Downloaded"
            }],
            animationEnabled: true,
            data: [{
                type: "pie",
                startAngle: 270,
                toolTipContent: "<b>{label}</b>: {y}",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 13,
                indexLabel: "{label} - {y}",
                dataPoints: [
                { y: 35, label: "Pending Notes"},
                { y: 12, label: "Downloaded Notes", exploded: true },
                ]
            }]
        };
        var studentOptions = {
            subtitles: [{
                text: "Total Students"
            }],
            animationEnabled: true,
            data: [{
                type: "pie",
                startAngle: 270,
                toolTipContent: "<b>{label}</b>: {y}",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 13,
                indexLabel: "{label} - {y}",
                dataPoints: []
            }]
        };

        // STUDENT
        var studentAttendanceOptions = {
            subtitles: [{
                text: "Total Attendance"
            }],
            animationEnabled: true,
            data: [{
                type: "pie",
                startAngle: 270,
                toolTipContent: "<b>{label}</b>: {y}",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 13,
                indexLabel: "{label} - {y}",
                dataPoints: [
                { y: 12, label: "Attended"},
                { y: 2, label: "Absent", exploded: true },
                ]
            }]
        };
        var studentNotesOptions = {
            subtitles: [{
                text: "Notes Downloaded"
            }],
            animationEnabled: true,
            data: [{
                type: "pie",
                startAngle: 270,
                toolTipContent: "<b>{label}</b>: {y}",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 13,
                indexLabel: "{label} - {y}",
                dataPoints: [
                { y: 5, label: "Pending Notes"},
                { y: 10, label: "Downloaded Notes", exploded: true },
                ]
            }]
        };
        <?php if($user_data["role"] == 1) { ?>
            $("#attendanceContainer").CanvasJSChart(attendanceOptions);
            $("#notesContainer").CanvasJSChart(notesOptions);
        <?php }else{ ?>   
            $("#studentAttendanceContainer").CanvasJSChart(studentAttendanceOptions);
            $("#studentNotesContainer").CanvasJSChart(studentNotesOptions);
        <?php } ?>
        studentsChartLoad();
            // $("#studentsContainer").CanvasJSChart(studentOptions);

        </script>
        <script src="./js/canvas-jquery-1.11.1.min.js"></script>
        <script src="./js/jquery.canvasjs.min.js"></script>
    </body>

    </html>
