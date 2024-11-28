<?php
// Auth
include("conf/connection.php");
include("conf/login-auth.php");
include("conf/admin-auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
                            <h1 class="top-bar-title font-size-medium font-weight-medium color-black">reports</h1>
                            <p class="top-bar-title-desc font-size-regular font-weight-regular color-light-black">reports</p>
                        </div>
                        <form class="form-area" action="" style="margin-right:20px;display:flex;gap:20px;flex-wrap:wrap">
                            
                            <div class="single-input" style="min-width: 200px;margin-top:-14px">
                                <select name="year" id="year" class="select-box year-select-box">
                                <?php
                                $currentYear = date('Y');
                                $startYear = $currentYear - 4;
                                for ($i = $startYear; $i <= $currentYear; $i++) {
                                    $selected = ($i == $currentYear) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i</option>";
                                }
                                ?>
                                </select>
                                <script>
                                    $('.year-select-box').select2({
                                        placeholder: "Select a year",
                                        allowClear: true,
                                        searchInputPlaceholder: 'Search year'
                                    });
                                </script>
                            </div>
                            
                            <div class="single-input" style="min-width: 200px;margin-top:-14px">
                                <select name="month" id="month" class="select-box month-select-box">
                                    <?php
                                    $currentMonth = date('n');
                                    for ($i = 1; $i <= 12; $i++) {
                                        $selected = ($i == $currentMonth) ? 'selected' : '';
                                        echo "<option value='$i' $selected>" . date("F", mktime(0, 0, 0, $i, 1)) . "</option>";
                                    }
                                    ?>
                                </select>
                                <script>
                                    $('.month-select-box').select2({
                                        placeholder: "Select a month",
                                        allowClear: true,
                                        searchInputPlaceholder: 'Search month'
                                    });
                                </script>
                            </div>
                            <button class='secondary-btn' id='filter-reports-btn' type="button" style="max-height: 40px;">Filter</button>
                        </form>
                        <form class="top-bar-search" id="search_form">
                            <input class="input-field top-bar-search-input" type="text" name="search" id="search" placeholder="Search by Name, IP...">
                            <button type="submit" class="top-bar-search-btn" id="reports-search"><img src="images/search.svg" alt="search" class="top-bar-search-img"></button>
                        </form>
                        <div class="top-bar-action">
                            <a href="reports-download.php"><img src="images/download.svg" alt="Add" class="top-bar-action-img"></a>
                        </div>
                    </div>
                </div>
                <!-- Graph Data -->
                <div class="dashboard-number-box-area" style="display:flex;justify-content:center">
                    <div class="dashboard-number-box" style="width:80%">
                        <div id="entriesGraph" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                <!-- // Table >>>> -->
                <div class="table-area responsive">
                    <table class="tgpx20">
                        <thead>
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
                        </thead>
                        <tbody id="reports-table-data-body">

                        </tbody>
                    </table>
                </div>
                <!-- // Load more >>>> -->
                <div class="loading-sec">
                    <button class="secondary-btn loading-btn" id="reports-loading-btn">Load more</button>
                    <div class="loading loading" id="reports-loading" style="display: none;">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // Footer file >>>> -->
    <?php include("partials/footer.php"); ?>
    <script>
        $("#reports-loading-btn").click();
        
        // Reports Graph
        var entriesGraph = {
            subtitles: [{
                text: "Entries Per Month"
            }],
            animationEnabled: true,
            axisX: {
                title: "Month"
            },
            axisY: {
                title: "Total Entries"
            },
            data: [{
                type: "column",
                toolTipContent: "<b>{label}</b>: {y}",
                dataPoints: []
            }]
        };
        reportsGraphFilterLoad(2024);
    </script>
</body>

</html>
