<?php
if ($user_data["role"] != 1 && $user_data["role"] != 2) {
    echo '<script>location.href = "./permission.php"</script>';
    exit();
}