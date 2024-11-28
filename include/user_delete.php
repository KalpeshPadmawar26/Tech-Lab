<?php
include("../partials/globle_restriction.php");
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $user_del_sql = $sql->prepare("DELETE FROM `users` WHERE user_id = ?");
    $user_del_sql->bind_param('s', $id);
    $user_del_sql->execute();
    if ($user_del_sql->affected_rows > 0) {
?>
        <div class="succ-alert-box alert-box">
            <img src="images/succ.png" alt="Success" class="alert-box-img">
            <div class="alert-box-details">
                <h1 class="alert-box-title font-size-regular font-family-medium">Operation completed</h1>
                <p class="alert-box-desc font-size-regular font-family-regular color-black">User deleted successfully.</p>
            </div>  
            <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
            <script>
                    // Default Hide alert
                    setTimeout(function hideAlert() {
                        $(".alert-box").fadeOut(1000);
                    }, 1000);
                    // Click hide alert
                    $(".alert-box-close-img").click(function() {
                        $(this).parent(".alert-box").fadeOut(400);
                    })
                    // Delete row
                </script>
            </div>
        <script>
            $("#<?php echo $id ?>").remove();
        </script>
    <?php } else { ?>
        <div class="fail-alert-box alert-box">
            <img src="images/fail.png" alt="Failed" class="alert-box-img">
            <div class="alert-box-details">
                <h1 class="alert-box-title font-size-regular font-family-medium">Operation Failed</h1>
                <p class="alert-box-desc font-size-regular font-family-regular color-black">Try again later.</p>
            </div>
            <img src="images/cross.png" alt="Cross" class="alert-box-close-img">
            <script>
                    // Default Hide alert
                    setTimeout(function hideAlert() {
                        $(".alert-box").fadeOut(1000);
                    }, 1000);
                    // Click hide alert
                    $(".alert-box-close-img").click(function() {
                        $(this).parent(".alert-box").fadeOut(400);
                    })
                    // Delete row
                </script>
            </div>
<?php }
}
?>