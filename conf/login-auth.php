<?php
    // To check if user not signed in
    $user_check = $sql->prepare("SELECT * FROM users WHERE `status` = 1 AND `user_id` = ?");
    $user_check->bind_param('s', $_SESSION['user_id']);
    $user_check->execute();
    $user_check_result = $user_check->get_result();
    if ($user_check_result->num_rows == 0) {
        session_destroy();
        echo '<script>location.href = "./"</script>';
    }else{
        // To show info on sidebar
        $user_data = $user_check_result->fetch_assoc();
    }
?>