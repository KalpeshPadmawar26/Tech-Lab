<?php
// Auth
include("conf/connection.php");
include("conf/login-auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
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
                            <h1 class="top-bar-title font-size-medium font-weight-medium color-black">Notes</h1>
                            <p class="top-bar-title-desc font-size-regular font-weight-regular color-light-black">Notes</p>
                        </div>
                        <form class="top-bar-search" id="search_form">
                            <input class="input-field top-bar-search-input" type="text" name="search" id="search" placeholder="Search by department, subject ...">
                            <button type="submit" class="top-bar-search-btn" id="student-notes-search"><img src="images/search.svg" alt="search" class="top-bar-search-img"></button>
                        </form>
                    </div>
                </div>
                <!-- // Table >>>> -->
                <div class="table-area responsive">
                    <table class="tgpx20">
                        <thead>
                            <tr>
                                <th>Year / Sem</th>
                                <th>Department</th>
                                <th>Subject</th>
                                <th style="width: 500px;">Comments</th>
                                <th>Notes File</th>
                                <th>Mark Downloaded</th>
                                <th>Time</th>                           
                            </tr>
                        </thead>
                        <tbody id="student-notes-table-data-body">

                        </tbody>
                    </table>
                </div>
                <!-- // Load more >>>> -->
                <div class="loading-sec">
                    <button class="secondary-btn loading-btn" id="student-notes-loading-btn">Load more</button>
                    <div class="loading loading" id="student-notes-loading" style="display: none;">
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
        $("#student-notes-loading-btn").click();
    </script>
</body>

</html>
