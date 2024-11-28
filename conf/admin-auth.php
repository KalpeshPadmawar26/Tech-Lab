<?php
if ($user_data["role"] != 1) {
    echo '<script>location.href = "./permission.php"</script>';
    exit();
}